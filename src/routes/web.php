<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\TaskController;

Route::get('/', [LoginController::class, 'showForm']);

Route::get('/register', [RegisterController::class, 'showForm']);
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/login', [LoginController::class, 'showForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return 'ログイン成功！ダッシュボード表示';
    });
    Route::get('/calendar', function () {
        return view('schedules.calendar');
    })->name('calendar');
    Route::resource('schedules', ScheduleController::class)->except(['show']);
    Route::get('/schedules/{schedule}', [ScheduleController::class, 'show'])->name('schedules.show');
    Route::get('/schedules/{schedule_id}/tasks/create', [TaskController::class, 'create'])->name('tasks.create');
    Route::post('/schedules/{schedule_id}/tasks/create', [TaskController::class, 'store'])->name('tasks.store');
    Route::get('schedules/{schedule_id}/tasks/{task}', [TaskController::class, 'edit'])->name('tasks.edit');
    Route::put('schedules/{schedule_id}/tasks/{task}', [TaskController::class, 'update'])->name('tasks.update');
    Route::delete('schedules/{schedule_id}/tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');
});