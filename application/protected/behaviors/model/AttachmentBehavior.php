<?
class AttachmentBehavior extends CActiveRecordBehavior
{
    public $attachment_path = '';
    public $attachment_field = '';

    public function beforeSave($event)
    {
        $file = CUploadedFile::getInstance($this->owner, $this->attachment_field);
        if ($file)
        {
            $this->delete_old_attachment();
            $file->saveAs($this->attachment_path . '/' . $file->name);
            $this->owner->{$this->attachment_field} = $file->name;
        }
    }

    public function get_attachment_url()
    {
        return $this->get_base_attachment_path() . $this->owner->{$this->attachment_field};
    }

    private function get_base_attachment_path()
    {
        return Yii::app()->request->baseUrl . '/' . $this->attachment_path . '/';
    }

    public function delete_old_attachment()
    {
        @unlink($this->attachment_path . '/' . $this->owner->{$this->attachment_field});
        $this->owner->{$this->attachment_field} = '';
    }

}