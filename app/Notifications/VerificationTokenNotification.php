<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class VerificationTokenNotification extends Notification
{
    use Queueable;
    
    public $first_name, $token;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($first_name, $token)
    {
        $this->first_name = $first_name;
        $this->token = $token;
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
                    ->greeting('Hello '.ucwords($this->first_name))
                    ->line('Please enter the code below to proceed with your account authentication.')
                    ->line('<h2><center><b>'.$this->token.'</b></center></h2>')
                    ->line('This code will expire in 15minutes.')
                    ->line('Thank you for trusting us!');
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
        ];
    }
}
