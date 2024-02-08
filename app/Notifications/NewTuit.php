<?php

namespace App\Notifications;

use App\Models\Tuit;
use Illuminate\Support\Str;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewTuit extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(public Tuit $tuit)
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
        ->subject("Nuevo Tuit de {$this->tuit->user->name}")
        ->greeting("Nuevo Tuit de {$this->tuit->user->name}")
        ->line(Str::limit($this->tuit->message, 50))
         ->action('Ir a Tuiter', url('/'))
        ->line('Gracias por usar nustra aplicación!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
