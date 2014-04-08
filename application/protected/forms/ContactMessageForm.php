<?php

/**
 * ContactForm class.
 * ContactForm is the data structure for keeping contact form data.
 */
class ContactMessageForm extends CFormModel
{
	public $name;
	public $email;
    public $phone;
	public $content;
	public $verify_code;

    public function rules()
    {
        return array(
            array(
                'name, phone, content',
                'required',
            ),

            array(
                'email',
                'email'
            ),

            array(
                'verify_code',
                'captcha',
                'allowEmpty'    => !CCaptcha::checkRequirements(),
                'captchaAction' =>  'captcha/new'
            ),
        );
    }

	public function attributeLabels()
	{
		return array(
			'verify_code' => _('код')
		);
	}

    public function populate(User $user)
    {
        $this->name = $user->getFullName();
        $this->email = $user->getEmail();
    }

    public function save()
    {
        $contact_message = new ContactMessage();

        $contact_message->name    = $this->name;
        $contact_message->email   = $this->email;
        $contact_message->phone   = $this->phone;
        $contact_message->content = $this->content;
        $contact_message->save();

        // if ($contact_message->save())
        // {
        //     $mailer = new ApplicationMailer();
        //     $mailer->new_contact_message_notification($contact_message);
        // }
    }
}