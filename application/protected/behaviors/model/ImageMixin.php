<?php
/**
 * @author Andriy Tolstokorov
 */

trait ImageMixin
{
    // for inner using
    protected $root_path = '/application';


    protected $initial_image = null;
    protected $thumbs_settings = array();
    protected $upload_folder = '';
    protected $temp_folder = '/public/uploads/temp/';

    protected $minimal_height = 0;
    protected $minimal_width = 0;
    
    protected $maximal_height = 0;
    protected $maximal_width = 0;

    protected $allowed_file_extensions = array( 'jpg', 'jpeg', 'png' );
    protected $file_size_limit = 10485760;

    // for model
    public $image = null;

    /**
     * @param string $folder
     * @return mixed
     * @throws CException
     */
    public function set_upload_folder( $folder )
    {
        if ( !is_writable( dirname(Yii::app()->basePath) . $folder ) )
        {
            throw new CException( 'Image folder is not writable or does not exists. Folder: ' . $folder );
        }

        return $this->upload_folder = $folder;
    }

    /**
     * @return string
     * @throws CException
     */
    public function get_upload_folder( $use_full_path = FALSE, $without_path_modifier = FALSE )
    {
        if ( !empty( $this->upload_folder ) )
        {
            if ( $use_full_path )
            {
                return Yii::app()->basePath . DIRECTORY_SEPARATOR . '..' . $this->upload_folder;
            }
            else
            {
                if ($without_path_modifier)
                {
                    return $this->upload_folder;
                }
                else
                {
                    return $this->root_path . $this->upload_folder;
                }
            }
        }
        else
        {
            throw new CException( 'Image folder is not set!' );
        }
    }

    /**
     * @param string $folder
     * @return mixed
     * @throws CException
     */
    public function set_temp_folder( $folder )
    {
        if ( !is_writable( Yii::app()->basePath . DIRECTORY_SEPARATOR . '..' . $folder ) )
        {
            throw new CException( 'Image folder is not writable or does not exists. Folder: ' . $folder );
        }

        return $this->temp_folder = $folder;
    }

    /**
     * @return string
     * @throws CException
     */
    public function get_temp_folder( $use_full_path = FALSE )
    {
        if ( !empty( $this->temp_folder ) )
        {
            if ( $use_full_path )
            {
                return Yii::app()->basePath . DIRECTORY_SEPARATOR . '..' . $this->temp_folder;
            }
            else
            {
                return $this->temp_folder;
            }
        }
        else
        {
            throw new CException( 'Temporary folder for images is not set!' );
        }
    }

    /**
     * @param $maximal_height integer
     */
    public function set_max_height($maximal_height)
    {
        $this->maximal_height = $maximal_height;
    }

    /**
     * @param $maximal_width integer
     */
    public function set_max_width($maximal_width)
    {
        $this->maximal_width = $maximal_width;
    }

    /**
     * @param $minimal_height integer
     */
    public function set_min_height($minimal_height)
    {
        $this->minimal_height = $minimal_height;
    }

    /**
     * @param $minimal_width integer
     */
    public function set_min_width($minimal_width)
    {
        $this->minimal_width = $minimal_width;
    }

    /**
     * Settings for thumbs. Format: array( $thumbPrefix => array( $thumbsWidth, $thumbHeight ) )
     * @param array $thumbs_settings
     * @throws CException
     */
    public function set_thumbnails_options( $thumbs_settings )
    {
        if ( !is_array( $thumbs_settings ) )
        {
            throw new CException( 'Settings for thumbs must be an array. Array format: $prefix => array( $width, $height )');
        }
        else
        {
            $this->thumbs_settings = $thumbs_settings;
        }
    }

    /**
     * Settings for thumbs. Format: array( $thumbPrefix => array( $thumbsWidth, $thumbHeight ) )
     * @return array
     */
    public function get_thumbnails_options()
    {
        return $this->thumbs_settings;
    }

    /**
     * Copy image from temporary folder to proper destination and create thumbnails
     */
    public function save_image()
    {
        if ( $this->initial_image != $this->image )
        {
            $this->delete_old_image();

            $imageHandler = new CImageHandler();
            $imageHandler->load( $this->get_temp_folder( TRUE ) . $this->image );
            $imageHandler->save( $this->get_upload_folder( TRUE ) . $imageHandler->getBaseFileName() );

            @unlink( $this->get_temp_folder( TRUE ) . $this->image );

            $settings = $this->get_thumbnails_options();

            if ( !empty( $settings ) )
            {
                $imageHandler->load( $this->get_upload_folder( TRUE ) . $this->image );

                foreach( $settings as $prefix => $dimensions )
                {
                    list( $width, $height ) = $dimensions;
                    $imageHandler
                        ->squareThumb( $width, $height )
                        ->save( $this->get_upload_folder( TRUE ) . $prefix . $imageHandler->getBaseFileName() );
                }
            }

            return TRUE;

        }
        return FALSE;
    }

    /**
     * @return null|string path to original image for src attribute
     */
    public function get_original_image()
    {
        if ( !empty( $this->image ) )
        {
            return $this->root_path . $this->upload_folder . $this->image;
        }
        else
        {
            return null;
        }
    }

    /**
     * @return null|string path to small thumbnail for src attribute
     */
    public function get_thumbnail($prefix)
    {
        if ( !empty( $this->image ) )
        {
            return $this->root_path . $this->upload_folder . $prefix . $this->image;
        }
        else
        {
            return null;
        }
    }

    protected function delete_old_image()
    {

        if ( file_exists( $this->get_upload_folder( TRUE ) . $this->initial_image ) )
        {
            @unlink( $this->get_upload_folder( TRUE ) . $this->initial_image );

            if ( !empty( $this->thumbs_settings ) )
            {
                foreach( $this->thumbs_settings as $prefix => $dimension )
                {
                    @unlink( $this->get_upload_folder( TRUE ) . $prefix . $this->initial_image );
                }
            }
        }
    }


    public function upload()
    {
        // folder for uploaded files
        $temp_folder = Yii::app()->basePath . DIRECTORY_SEPARATOR . '..' . $this->temp_folder;

        if (!is_writable( $temp_folder ) )
        {
            throw new CException( 'temporary folder is not exists or not writable. Path:' . $temp_folder );
        }

        $uploader = new FileUploader(
            $this->allowed_file_extensions,
            $this->file_size_limit
        );

        $result = $uploader->handleUpload( $temp_folder );

        if ( !isset( $result['error'] ) )
        {
            $imageHandler = new CImageHandler();

            $imageHandler->load( $temp_folder . $result['filename'] );

                // if min/max width/height are set - check those conditions
                $this->validate_image_dimensions(
                    $imageHandler->getWidth(),
                    $imageHandler->getHeight()
                );

                $this->image = $imageHandler->getBaseFileName();

                return [
                    'file_name' => $imageHandler->getBaseFileName(),
                    'image_src' => $this->root_path . $this->temp_folder . $imageHandler->getBaseFileName()
                ];
        }
        else
        {
            throw new CException($result[ 'error' ]);
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
        if ( (int)$this->minimal_width > 0 )
        {
            if ( $width < $this->minimal_width )
            {
                throw new CException(
                    _( 'Image width is too small. Minimal is' ) . $this->minimal_width . 'px'
                );
            }
        }

        if ( (int)$this->maximal_width > 0 )
        {
            if ( $width > $this->maximal_width )
            {
                throw new CException(
                    _( 'Image width is too big. Maximal is' ) . $this->maximal_width . 'px'
                );
            }
        }

        if ( (int)$this->minimal_height > 0 )
        {
            if ( $height < $this->minimal_height )
            {
                throw new CException(
                    _( 'Image height is too small. Minimal is' ) . $this->minimal_height . 'px'
                );
            }
        }

        if ( (int)$this->maximal_height > 0 )
        {
            if ( $height > $this->maximal_height )
            {
                throw new CException(
                    _( 'Image height is too big. Maximal is' ) . $this->maximal_height . 'px'
                );
            }
        }
    }

}