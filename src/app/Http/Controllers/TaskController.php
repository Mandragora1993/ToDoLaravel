<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Spatie\GoogleCalendar\Event;
use Carbon\Carbon;

class TaskController
{
    use AuthorizesRequests;
    public function index(Request $request)
    {
        $query = Task::where('user_id', Auth::id());

        if ($request->priority) {
            $query->where('priority', $request->priority);
        }
        if ($request->status) {
            $query->where('status', $request->status);
        }
        if ($request->due_date) {
            $query->whereDate('due_date', $request->due_date);
        }

        $tasks = $query->orderBy('due_date')->get();
        return view('tasks.index', compact('tasks'));
    }

    public function store(TaskRequest $request)
    {
        $validated = $request->validated();
        $validated['user_id'] = Auth::id();
        $validated['is_important'] = $request->has('is_important');

        $task = Task::create($validated);

        if ($task->is_important) {
            $googleEvent = Event::create([
                'name' => $task->name,
                'description' => $task->description,
                'startDateTime' => Carbon::parse($task->due_date)->startOfDay(),
                'endDateTime' => Carbon::parse($task->due_date)->endOfDay(),
            ]);

            $task->google_event_id = $googleEvent->id;
            $task->save();
        }

        return redirect()->route('tasks.index')->with('success', 'Zadanie utworzone' . ($task->is_important ? ' i dodane do Google Kalendarza!' : '!'));
    }

    public function update(TaskRequest $request, Task $task)
    {
        $this->authorize('update', $task);
        $task->update($request->validated());
        return redirect()->route('tasks.index')->with('success', 'Zadanie zaktualizowane!');
    }

    public function destroy(Task $task)
    {
        $this->authorize('delete', $task);
        $task->delete();
        return redirect()->route('tasks.index')->with('success', 'Zadanie usunięte!');
    }

    public function generatePublicLink(Task $task)
    {
        $this->authorize('view', $task);
        $token = bin2hex(random_bytes(32));
        $expiresAt = now()->addHours(24);

        $task->publicLinks()->create([
            'token' => $token,
            'expires_at' => $expiresAt,
        ]);
        $publicLink = url("/task/public/{$token}");
        return redirect()->route('tasks.show', $task)
            ->with('success', "Publiczny link do zadania został wygenerowany! <a href=\"{$publicLink}\" target=\"_blank\">{$publicLink}</a>");
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function edit(Task $task)
    {
        $this->authorize('update', $task);
        return view('tasks.edit', compact('task'));
    }

    public function show(Task $task)
    {
        $this->authorize('view', $task);
        $taskHistories = $task->activities()->latest()->get();

        return view('tasks.show', compact('task', 'taskHistories'));
    }

    public function calendar()
    {
        $tasks = Task::where('user_id', Auth::id())->orderBy('due_date')->get();

        $events = $tasks->map(function ($task) {
            return [
                'title' => $task->name,
                'start' => $task->due_date->format('Y-m-d'),
                'url' => route('tasks.show', $task),
                'color' => $task->priority === 'high' ? '#dc3545'
                    : ($task->priority === 'medium' ? '#ffc107' : '#28a745'),
            ];
        });

        return view('tasks.calendar', [
            'tasks' => $tasks,
            'events' => $events,
        ]);
    }
}
