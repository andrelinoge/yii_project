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
     * @param BaseTestimonial $testimonial
     * @param BaseTestimonialAnswer $answer
     * @return mixed
     */
    public function answer_for_testimonial(BaseTestimonial $testimonial, BaseTestimonialAnswer $answer)
    {
        $this->message->setSubject( _('Ответ на отзыв о') . ' ' . $testimonial->getProduct()->getTitle() );
        $this->message->view = 'testimonial_answer';
        $this->message->setBody(
            array(
                'testimonial' => $testimonial,
                'answer' => $answer
            ),
            'text/html'
        );

        $this->message->setTo( $testimonial->author_email );

        return Yii::app()->mail->send($this->message);
    }

    /**
     * @param Order $order
     * @return mixed
     */
    public function submitted_order_for_managers(Order $order)
    {
        $this->message->setSubject( _('Новый заказ - №') .$order->id );
        $this->message->view = 'new_order';
        $this->message->setBody(
            array(
                'order' => $order,
            ),
            'text/html'
        );

        $receivers = User::getEmailsByRole(WebUser::ROLE_ADMIN);

        $this->message->setTo( $receivers );
        return Yii::app()->mail->send($this->message);
    }

    /**
     * @param Order $order
     * @return mixed
     */
    public function submitted_order(Order $order)
    {
        $this->message->setSubject( _('Покупка на сайте KIDSLAND') );
        $this->message->view = 'submitted_order';
        $this->message->setBody(
            array(
                'order' => $order,
            ),
            'text/html'
        );

        $this->message->setTo( $order->user_email );

        return Yii::app()->mail->send($this->message);
    }

    /**
     * @param ContactMessage $message
     */
    public function new_contact_message_notification(ContactMessage $message)
    {
        $this->message->setSubject( _('Контактное сообщение') );
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
}