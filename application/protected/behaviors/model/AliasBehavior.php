<?
class AliasBehavior extends CActiveRecordBehavior
{
    public $source_attribute = 'title';
    public $destination_attribute = 'alias';

    public function beforeSave($event)
    {
        if (empty($this->getOwner()->{$this->destination_attribute}))
        {
            $this->getOwner()->{$this->destination_attribute} = Text::to_param(Text::transliterate($this->getOwner()->{$this->source_attribute}));
        }
    }

}