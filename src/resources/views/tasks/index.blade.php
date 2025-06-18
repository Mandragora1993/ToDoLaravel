@extends('app')

@section('title', 'Lista zadań')

@section('content')
<div class="d-flex mb-3 justify-content-between align-items-center">
    <h1 class="mb-0">Twoje zadania</h1>
    <div>
        <a href="{{ route('tasks.create') }}" class="btn btn-primary me-2">Dodaj zadanie</a>
        <a href="{{ route('tasks.calendar') }}" class="btn btn-outline-secondary">Widok kalendarza</a>
    </div>
</div>

<form method="GET" class="row g-3 mb-4">
    <div class="col-md-3">
        <select name="priority" class="form-select">
            <option value="">Wszystkie priorytety</option>
            <option value="low" {{ request('priority') == 'low' ? 'selected' : '' }}>Niski</option>
            <option value="medium" {{ request('priority') == 'medium' ? 'selected' : '' }}>Średni</option>
            <option value="high" {{ request('priority') == 'high' ? 'selected' : '' }}>Wysoki</option>
        </select>
    </div>
    <div class="col-md-3">
        <select name="status" class="form-select">
            <option value="">Wszystkie statusy</option>
            <option value="to-do" {{ request('status') == 'to-do' ? 'selected' : '' }}>Do zrobienia</option>
            <option value="in progress" {{ request('status') == 'in progress' ? 'selected' : '' }}>W toku</option>
            <option value="done" {{ request('status') == 'done' ? 'selected' : '' }}>Zrobione</option>
        </select>
    </div>
    <div class="col-md-3">
        <input type="date" name="due_date" value="{{ request('due_date') }}" class="form-control">
    </div>
    <div class="col-md-3">
        <button class="btn btn-secondary w-100">Filtruj</button>
    </div>
</form>

@if($tasks->count())
<table class="table table-bordered align-middle">
    <thead>
        <tr>
            <th>Nazwa</th>
            <th>Priorytet</th>
            <th>Status</th>
            <th>Termin</th>
            <th>Akcje</th>
        </tr>
    </thead>
    <tbody>
    @foreach($tasks as $task)
        <tr>
            <td>
                <a href="{{ route('tasks.show', $task) }}" class="link-info link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">{{ $task->name }}</a>
            </td>
            <td>
                @if($task->priority == 'high')
                  <span class="badge bg-danger">Wysoki</span>
                @elseif($task->priority == 'medium')
                  <span class="badge bg-warning text-dark">Średni</span>
                @else
                  <span class="badge bg-success">Niski</span>
                @endif
            </td>
            <td>
                @if($task->status == 'done')
                  <span class="badge bg-success">Zrobione</span>
                @elseif($task->status == 'in progress')
                  <span class="badge bg-info text-dark">W toku</span>
                @else
                  <span class="badge bg-secondary">Do zrobienia</span>
                @endif
            </td>
            <td>{{ $task->due_date->format('Y-m-d') }}</td>
            <td>
                <a href="{{ route('tasks.edit', $task) }}" class="btn btn-sm btn-outline-primary">Edytuj</a>
                <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="d-inline"
                    onsubmit="return confirm('Na pewno usunąć zadanie?')">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-outline-danger">Usuń</button>
                </form>
                <button type="button" class="btn btn-sm btn-outline-success btn-public-link"
        data-task-id="{{ $task->id }}">Udostępnij</button>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

@else
    <div class="alert alert-info">Brak zadań.</div>
@endif

@endsection