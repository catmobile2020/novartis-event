<?php

namespace App\Notifications;

use DouglasResende\FCM\Messages\FirebaseMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class SendStatusNotification extends Notification
{
    use Queueable;

    public $data;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }


    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return $this->data;
    }

//    public function toFcm($notifiable)
//    {
//        return (new FirebaseMessage())->setMeta([
//            $this->data
//        ])->setContent($this->data['title'], $this->data['message']);
//    }
}
