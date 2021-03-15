<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class WelcomeMail extends Notification
{
    use Queueable;
    
    public $first_name;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($first_name)
    {
        $this->first_name = $first_name;
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
                    ->greeting('Hello '.ucwords($this->first_name))
                    ->line('Welcome to TEN. You are now part of a community that helps you grow.')
                    ->line('Please do ensure to verify your phone so you can enjoy all the benefits of our platform.')
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
            'body' => 'Hurray!!! You have successfully created an account on TEN.',
            'icon' => '<div class="notify-icon bg-primary"><i class="mdi mdi-monitor-lock"></i></div>',
            'title' => 'Registration Successfull'
        ];
    }
}
