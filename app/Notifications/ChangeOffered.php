<?php

namespace App\Notifications;

use App\Change;
use App\Transformers\ChangeTransformer;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ChangeOffered extends Notification
{
    use Queueable;
    private $change;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Change $change)
    {
        $this->change = $change;
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
        return (new MailMessage)->markdown('mail.change.offered', ['source' => $this->change->source]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return fractal()->item($this->change, new ChangeTransformer())->parseIncludes(['source', 'target'])->toArray();
    }
}
