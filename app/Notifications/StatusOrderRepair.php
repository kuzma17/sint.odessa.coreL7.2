<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class StatusOrderRepair extends Notification
{
    use Queueable;

    private $status;
    private $order;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($order, $status)
    {
        $this->status = $status;
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
            ->subject('Статус Вашего заказа № '.$this->order->id.' изменен')
            ->greeting('Здравствуйте, '.$this->order->user->name.'!')
            ->line('Статус Вашего заказа № '.$this->order->id.' изменен на "'.$this->status.'"')
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
