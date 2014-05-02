<?
class AliasBehavior extends CActiveRecordBehavior
{
    public $source_attribute = 'title';
    public $alias_attribute = 'alias';

    public function beforeSave($event)
    {
        if (empty($this->getOwner()->{$this->alias_attribute}))
        {
            $this->getOwner()->{$this->alias_attribute} = Text::to_param(Text::transliterate($this->getOwner()->{$this->source_attribute}));
        }
    }

}