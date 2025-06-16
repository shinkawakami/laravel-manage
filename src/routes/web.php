<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ScheduleController;

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
});