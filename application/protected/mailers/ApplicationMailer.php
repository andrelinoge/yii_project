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

        $this->message->setTo( Yii::app()->params['emails']['contact_messages_receiver'] );

        return Yii::app()->mail->send($this->message);
    }

    public function new_sizer_request(SizerRequest $request)
    {
        $this->message->setSubject( _('Виклик замірника') );
        $this->message->view = 'sizer_request';
        $this->message->setBody(
            array(
                'request' => $request
            ),
            'text/html'
        );

        $this->message->setTo( Yii::app()->params['emails']['contact_messages_receiver'] );

        return Yii::app()->mail->send($this->message);
    }

    public function new_calc_request_notification(CalcRequest $request)
    {
        $this->message->setSubject( _('Розрахунок від користувача') );
        $this->message->view = 'calc_request';
        $this->message->setBody(
            array(
                'request' => $request
            ),
            'text/html'
        );

        $this->message->setTo( Yii::app()->params['emails']['contact_messages_receiver'] );

        return Yii::app()->mail->send($this->message);
    }
}