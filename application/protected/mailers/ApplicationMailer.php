<?php
class ApplicationMailer
{
    /** @var \YiiMailMessage  */
    public $message;

    public function __construct()
    {
        Yii::import('application.extensions.yii-mail.YiiMailMessage');

        $this->message = new YiiMailMessage();
        $this->message->from = Yii::app()->params['emails']['notification_sender'];
    }

    /**
     * @param ContactMessage $message
     */
    public function new_contact_message_notification(ContactMessage $message)
    {
        $this->message->setSubject( _('Контактне повідомлення') );
        $this->message->view = 'contact_message';
        $this->message->setBody(
            array(
                'message' => $message
            ),
            'text/html'
        );

        $settings = SiteSetting::model()->find();
        $this->message->setTo( Yii::app()->params['emails']['contact_messages_receiver'] );

        return Yii::app()->mail->send($this->message);
    }
}