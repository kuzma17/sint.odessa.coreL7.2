<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class CreatedOrder extends Notification
{
    use Queueable;

    private $order;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($order)
    {
        $this->order = $order;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Новый заказ № '.$this->order->id)
            ->greeting('Здравствуйте, '.$this->order->user->name.'!')
            ->line('Вы оформили заказ № '.$this->order->id.'.')
            ->line('В ближайшее время Ваш заказ поступит в обработку')
            ->line('Детали заказа:')
            ->line('Тип услуги: '.$this->order->type_order->name.'.')
            ->line('Телефон: '.$this->order->phone.'.')
            ->line('Адрес доставки: '.$this->order->address.'.')
            ->line('Комментарий: '.$this->order->comment.'.')
            ->action('Перейти на сайт', url('/'))
            ->line('Как с нами связаться:');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
