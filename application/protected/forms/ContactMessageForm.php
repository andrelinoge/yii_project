<?php

/**
 * ContactForm class.
 * ContactForm is the data structure for keeping contact form data.
 */
class ContactMessageForm extends CFormModel
{
	public $name;
	public $phone;
	public $content;
	public $verify_code;

    public function rules()
    {
        return array(
            array(
                'name, phone, content',
                'required',
                'message' => _('обязательное поле')
            ),

            array(
                'verify_code',
                'captcha',
                'allowEmpty'=>!CCaptcha::checkRequirements(),
                'captchaAction' => Yii::app()->createUrl( 'captcha/contactNew' ),
                'message' => _('неправильный код')
            ),
        );
    }

	/**
	 * Declares customized attribute labels.
	 * If not declared here, an attribute would have a label that is
	 * the same as its name with the first letter in upper case.
	 */
	public function attributeLabels()
	{
		return array(
			'verify_code' => _('код')
		);
	}

    public function populate(User $user)
    {
        $this->name = $user->getFullName();
        $this->phone = $user->getphone();
    }

    public function save()
    {
        $contact_message = new ContactMessage();

        $contact_message->name = $this->name;
        $contact_message->phone = $this->phone;
        $contact_message->content = $this->content;

        if ($contact_message->save())
        {
            $mailer = new ApplicationMailer();
            $mailer->new_contact_message_notification($contact_message);
        }
    }
}