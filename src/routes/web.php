<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\PublicTaskController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Auth;

use Spatie\GoogleCalendar\Event;

Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('tasks.index');
    }
    return redirect()->route('login');
});

// Autoryzacja
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Publiczny widok zadania
Route::get('task/public/{token}', [PublicTaskController::class, 'show'])->name('tasks.public');

// Tylko dla zalogowanych użytkowników
Route::middleware(['auth'])->group(function() {
    Route::get('/tasks/calendar', [TaskController::class, 'calendar'])->name('tasks.calendar');
    Route::post('/tasks/{task}/public-link', [TaskController::class, 'generatePublicLink'])->name('tasks.generatePublicLink');
    Route::resource('tasks', TaskController::class);
});