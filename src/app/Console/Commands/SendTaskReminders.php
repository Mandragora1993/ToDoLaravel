<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Task;
use Carbon\Carbon;
use App\Notifications\TaskReminderNotification;

class SendTaskReminders extends Command
{
    protected $signature = 'tasks:send-reminders';
    protected $description = 'Wysyła powiadomienia e-mail o zadaniach na jutro';

    public function handle()
    {
        $tomorrow = Carbon::tomorrow()->toDateString();

        $tasks = Task::whereDate('due_date', $tomorrow)->get();

        foreach ($tasks as $task) {
            if ($task->user) {
                $task->user->notify((new TaskReminderNotification($task))->delay(now()->addSeconds(5)));
            }
        }

        $this->info('Powiadomienia wysłane.');
    }
}
