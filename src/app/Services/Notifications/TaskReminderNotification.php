<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\Task;

class TaskReminderNotification extends Notification
{
    use Queueable;

    public $task;

    public function __construct(Task $task)
    {
        $this->task = $task;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Przypomnienie o zadaniu: ' . $this->task->name)
            ->line('To przypomnienie o zadaniu, które musisz wykonać jutro:')
            ->line('Zadanie: ' . $this->task->name)
            ->line('Opis: ' . $this->task->description)
            ->line('Termin: ' . $this->task->due_date->format('Y-m-d'))
            ->action('Zobacz zadanie', route('tasks.show', $this->task->id))
            ->line('Powodzenia!');
    }

    public function toArray($notifiable)
    {
        return [
        ];
    }
}
