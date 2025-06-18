@extends('app')

@section('title', 'Nowe zadanie')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <h1>Dodaj zadanie</h1>
        <form method="POST" action="{{ route('tasks.store') }}">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Nazwa zadania</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control" required maxlength="255">
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Opis zadania</label>
                <textarea name="description" id="description" class="form-control">{{ old('description') }}</textarea>
            </div>
            <div class="mb-3">
                <label for="priority" class="form-label">Priorytet</label>
                <select name="priority" id="priority" class="form-select" required>
                    <option value="low">Niski</option>
                    <option value="medium">Średni</option>
                    <option value="high">Wysoki</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select name="status" id="status" class="form-select" required>
                    <option value="to-do">Do zrobienia</option>
                    <option value="in progress">W toku</option>
                    <option value="done">Zrobione</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="due_date" class="form-label">Termin</label>
                <input type="date" name="due_date" id="due_date" value="{{ old('due_date') }}" class="form-control" required>
            </div>
            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" name="is_important" id="is_important" value="1" {{ old('is_important') ? 'checked' : '' }}>
                <label class="form-check-label" for="is_important">
                    Ważne zadanie (dodaj do Google Kalendarza)
                </label>
            </div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-outline-success">Dodaj</button>
                <a href="{{ route('tasks.index') }}" class="btn btn-outline-secondary">Powrót</a>
            </div>
        </form>
    </div>
</div>
@endsection