@extends('app')

@section('title', 'Edycja zadania')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h1>Edycja zadania</h1>
            <form method="POST" action="{{ route('tasks.update', $task) }}">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="name" class="form-label">Nazwa zadania</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $task->name) }}"
                        class="form-control" required maxlength="255">
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Opis zadania</label>
                    <textarea name="description" id="description" class="form-control">{{ old('description', $task->description) }}</textarea>
                </div>
                <div class="mb-3">
                    <label for="priority" class="form-label">Priorytet</label>
                    <select name="priority" id="priority" class="form-select" required>
                        <option value="low" {{ $task->priority == 'low' ? 'selected' : '' }}>Niski</option>
                        <option value="medium" {{ $task->priority == 'medium' ? 'selected' : '' }}>Średni</option>
                        <option value="high" {{ $task->priority == 'high' ? 'selected' : '' }}>Wysoki</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select name="status" id="status" class="form-select" required>
                        <option value="to-do" {{ $task->status == 'to-do' ? 'selected' : '' }}>Do zrobienia</option>
                        <option value="in progress" {{ $task->status == 'in progress' ? 'selected' : '' }}>W toku</option>
                        <option value="done" {{ $task->status == 'done' ? 'selected' : '' }}>Zrobione</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="due_date" class="form-label">Termin</label>
                    <input type="date" name="due_date" id="due_date"
                        value="{{ old('due_date', $task->due_date->format('Y-m-d')) }}" class="form-control" required>
                </div>
                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" name="is_important" id="is_important" value="1"
                        {{ old('is_important', $task->is_important) ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_important">
                        Ważne zadanie (dodaj do Google Kalendarza)
                    </label>
                </div>
                <div class="d-flex gap-2 align-items-center">
                    <button type="submit" class="btn btn-outline-primary">Zapisz zmiany</button>
                    <a href="{{ route('tasks.index') }}" class="btn btn-outline-secondary ms-auto">Powrót</a>
                </div>
            </form>
            <div class="d-flex gap-2 mt-2">
                <form action="{{ route('tasks.destroy', $task) }}" method="POST"
                    onsubmit="return confirm('Na pewno usunąć zadanie?')" class="m-0 p-0">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-outline-danger" type="submit">Usuń zadanie</button>
                </form>
            </div>
        </div>
    </div>
@endsection