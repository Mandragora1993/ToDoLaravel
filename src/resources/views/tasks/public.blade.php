@extends('app')

@section('title', 'Publiczny podgląd zadania')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card mt-4">
            <div class="card-header">
                <h2>{{ $task->name }}</h2>
            </div>
            <div class="card-body">
                @if($task->description)
                    <p><strong>Opis:</strong> {{ $task->description }}</p>
                @endif
                <p><strong>Priorytet:</strong> {{ ucfirst($task->priority) }}</p>
                <p><strong>Status:</strong> {{ ucfirst($task->status) }}</p>
                <p><strong>Termin:</strong> {{ \Illuminate\Support\Carbon::parse($task->due_date)->format('Y-m-d') }}</p>
            </div>
        </div>
    </div>
</div>
@endsection