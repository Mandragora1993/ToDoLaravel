@extends('app')

@section('title', 'Publiczny podgląd zadania')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mt-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center gap-2">
                        <h2 class="mb-0">{{ $task->name }}</h2>
                    </div>
                    <div class="d-flex gap-2">
                        @can('update', $task)
                            <a href="{{ route('tasks.edit', $task) }}" class="btn btn-sm btn-outline-primary">Edytuj</a>
                        @endcan
                        @can('delete', $task)
                            <form action="{{ route('tasks.destroy', $task) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger"
                                    onclick="return confirm('Na pewno usunąć zadanie?')">Usuń</button>
                            </form>
                        @endcan
                        <button type="button" class="btn btn-sm btn-outline-success btn-public-link"
                            data-task-id="{{ $task->id }}">Udostępnij</button>
                        <a href="{{ route('tasks.index') }}" class="btn btn-sm btn-outline-secondary">
                            &larr; Powrót do listy
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    @if ($task->description)
                        <p><strong>Opis:</strong> {{ $task->description }}</p>
                    @endif
                    <p><strong>Priorytet:</strong> {{ ucfirst($task->priority) }}</p>
                    <p><strong>Status:</strong> {{ ucfirst($task->status) }}</p>
                    <p><strong>Termin:</strong> {{ \Illuminate\Support\Carbon::parse($task->due_date)->format('Y-m-d') }}
                    </p>
                </div>
            </div>

            <div class="card mt-4">
                <div class="card-header">
                    <h4>{{ __('tasks.history') }}</h4>
                </div>
                <div class="card-body">
                    @if ($taskHistories->count())
                        <ul class="list-group">
                            @foreach ($taskHistories as $history)
                                <li class="list-group-item">
                                    <div>
                                        <strong>{{ $history->created_at->format('Y-m-d H:i') }}</strong>
                                        {{ __('tasks.by') }}
                                        <strong>{{ $history->causer ? $history->causer->name : 'System' }}</strong>
                                        ({{ __('tasks.' . $history->description) ?? $history->description }})
                                    </div>
                                    <div class="mt-2">
                                        @php
                                            $old = $history->properties['old'] ?? [];
                                            $new = $history->properties['attributes'] ?? [];
                                        @endphp
                                        @foreach ($old as $field => $oldValue)
                                            @if (isset($new[$field]) && $oldValue !== $new[$field])
                                                <div>
                                                    <strong>{{ __('tasks.' . $field) ?? ucfirst($field) }}:</strong>
                                                    <span class="text-danger">{{ $oldValue }}</span>
                                                    &rarr;
                                                    <span class="text-success">{{ $new[$field] }}</span>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p>{{ __('tasks.no_history') }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection
