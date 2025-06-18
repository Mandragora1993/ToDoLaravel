@extends('app')

@section('title', 'Kalendarz zadań')

@section('content')
<div class="d-flex mb-3 justify-content-between align-items-center">
    <h1 class="mb-0">Kalendarz zadań</h1>
    <a href="{{ route('tasks.index') }}" class="btn btn-outline-secondary">Lista zadań</a>
</div>

<div class="container d-flex justify-content-center">
    <div 
        id="calendar"
        class="bg-white p-4 rounded-3 shadow"
        style="max-width: 900px; width: 100%;"
    ></div>
</div>
@endsection

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.13/index.global.min.css" rel="stylesheet">
<style>
    #calendar a,
    #calendar a:visited,
    #calendar a:hover,
    #calendar a:active {
        color: inherit !important;
        text-decoration: none !important;
    }
    .container a {
        text-decoration: none;
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.13/index.global.min.js"></script>
<script>
    window.events = @json($events);
</script>
@endpush