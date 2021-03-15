<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class BeneficiaryNotification extends Notification
{
    use Queueable;

    public $message,$title,$name,$icon;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($message,$title,$name,$icon)
    {
        $this->message = $message;
        $this->title = $title;
        $this->name = $name;
        $this->icon = $icon;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database'];
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
                    ->subject($this->title)
                    ->greeting('Dear '.ucwords($this->name).',')
                    ->line($this->message);
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
            'body' => $this->message,
            'icon' => $this->icon,
            'title'=>$this->title,
        ];
    }
}
