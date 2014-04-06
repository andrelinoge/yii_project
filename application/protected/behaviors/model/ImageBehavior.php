<?
class ImageBehavior extends CActiveRecordBehavior
{
    public $image_folder;
    public $image_attribute;
    public $temp_folder;
    public $thumbnails = [];

    // this settings for validation in ajax-mode
    public $minimal_height = 0;
    public $minimal_width = 0;

    public $maximal_height = 0;
    public $maximal_width = 0;

    public $allowed_extensions = [ 'jpg', 'jpeg', 'png' ];
    public $size_limit = 10485760;

    public $is_ajax_upload = false;

    protected $initial_image = '';

    public function beforeSave($event)
    {
        $this->is_ajax_upload ? $this->ajax_upload() : $this->non_ajax_upload();
    }

    public function afterFind($event)
    {
        $this->initial_image = $this->owner->{$this->image_attribute};
    }

    public function afterSave()
    {
        if ( $this->initial_image != $this->owner->{$this->image_attribute} )
        {
            $this->initial_image = $this->owner->{$this->image_attribute};
        }
    }

    public function upload_to_temp_folder()
    {
        $temp_folder = $this->get_absolute_temp_path();
        $result = $this->upload($temp_folder);
    
        if ( !isset( $result['error'] ) )
        {
            $image_handler = new CImageHandler();

            $image_handler->load( $temp_folder . $result['filename'] );

            // if min/max width/height are set - check those conditions
            try 
            {
                $this->validate_image_dimensions(
                    $image_handler->getWidth(),
                    $image_handler->getHeight()
                );
            }
            catch (CException $e)
            {
                // TODO: delete invalid file from temp folder
                throw new CException($e->message);
            }

            $this->owner->{$this->image_attribute} = $image_handler->getBaseFileName();

            return [
                'file_name' => $image_handler->getBaseFileName(),
                'image_src' => '/application/' . $this->temp_folder . '/'. $image_handler->getBaseFileName()
            ];
        }
        else
        {
            throw new CException($result[ 'error' ]);
        }
    }

    protected function upload($folder)
    {
        if (!is_writable( $folder ) )
        {
            throw new CException( 'Folder is not exists or not writable. Path:' . $folder );
        }

        $uploader = new FileUploader(
            $this->allowed_extensions,
            $this->size_limit
        );

        return $uploader->handleUpload( $folder );
    }

    public function get_image_url($prefix = '')
    {
        if (!empty($prefix) && in_array($prefix, array_keys($this->thumbnails)))
        {
            return $this->get_base_image_path() . $prefix . $this->owner->{$this->image_attribute};
        }
        else
        {
            return $this->get_base_image_path() . $this->owner->{$this->image_attribute};
        }
    }

    private function get_base_image_path()
    {
        return Yii::app()->request->baseUrl . '/application/' . $this->image_folder . '/';
    }

    private function get_absolute_image_path()
    {
        return dirname(Yii::app()->basePath) . DIRECTORY_SEPARATOR . $this->image_folder . DIRECTORY_SEPARATOR;
    }

    private function get_absolute_temp_path()
    {
        return dirname(Yii::app()->basePath) . DIRECTORY_SEPARATOR . $this->temp_folder . DIRECTORY_SEPARATOR;
    }


    protected  function delete_old_image()
    {
        $image_path = $this->get_absolute_image_path();

        @unlink($image_path . $this->initial_image);
        if (is_array(array_keys($this->thumbnails)))
        {
            foreach(array_keys($this->thumbnails) as $prefix)
            {
                @unlink($image_path . $prefix .  $this->owner->initial_image);
            }
        }
        $this->initial_image = '';
    }

    protected function ajax_upload()
    {
        if (!empty($this->owner->{$this->image_attribute}))
        {
            $image_folder = $this->get_absolute_image_path();
            $temp_folder = $this->get_absolute_temp_path();

            if (!is_writable( $image_folder ) )
            {
                throw new CException( 'image folder is not exists or not writable. Path:' . $image_folder );
            }

            $this->delete_old_image();

            $image_handler = new CImageHandler();

            $image_handler->load( $temp_folder . $this->owner->{$this->image_attribute} );
            $image_handler->save( $image_folder . $image_handler->getBaseFileName() );

            @unlink( $temp_folder . $this->owner->{$this->image_attribute} );
            $this->create_thumbnails($image_handler->getBaseFileName());
        }
    }

    protected function non_ajax_upload()
    {
        $image = CUploadedFile::getInstance($this->owner, $this->image_attribute);
        if ($image)
        {
            $image_folder = $this->get_absolute_image_path();

            if (!is_writable( $image_folder ) )
            {
                throw new CException( 'image folder is not exists or not writable. Path:' . $image_folder );
            }

            $this->delete_old_image();
            $image->saveAs($image_folder . $image->name);

            $this->owner->{$this->image_attribute} = $image->name;
            $this->create_thumbnails($image->name);
        }
    }

    /**
     * @param string $file_name
     */
    protected function create_thumbnails($file_name)
    {
        if ( !empty( $this->thumbnails ) && is_array($this->thumbnails) )
        {
            $image_folder = $this->get_absolute_image_path();

            $image_handler = new CImageHandler();

            foreach( $this->thumbnails as $prefix => $dimensions )
            {
                $image_handler->load( $image_folder . $file_name );
                list( $width, $height ) = $dimensions;
                $image_handler
                    ->squareThumb( $width, $height )
                    ->save( $image_folder . $prefix . $file_name );
            }
        }
    }

    /**
     * If image width/height limits are set - check those conditions
     * @param int $width
     * @param int $height
     * @throws CException
     */
    protected function validate_image_dimensions( $width, $height )
    {
        if ( ((int)$this->minimal_width > 0) && ($width < $this->minimal_width) )
        {
            throw new CException(
                _( 'Image width is too small. Minimal is' ) . $this->minimal_width . 'px'
            );
        }

        if ( ((int)$this->maximal_width > 0) && ($width > $this->maximal_width) )
        {
            throw new CException(
                _( 'Image width is too big. Maximal is' ) . $this->maximal_width . 'px'
            );
        }

        if ( ((int)$this->minimal_height > 0) && ($height < $this->minimal_height) )
        {
            throw new CException(
                _( 'Image height is too small. Minimal is' ) . $this->minimal_height . 'px'
            );
        }

        if ( ($this->maximal_height > 0) && ($height > $this->maximal_height) )
        {
            throw new CException(
                _( 'Image height is too big. Maximal is' ) . $this->maximal_height . 'px'
            );
        }
    }
}