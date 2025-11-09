<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TimeEntryController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Project routes
    Route::resource('projects', ProjectController::class);
    
    // Task routes
    Route::resource('tasks', TaskController::class);
    Route::get('/tasks/create/project/{project}', [TaskController::class, 'create'])->name('tasks.create.project');
    
    // Time Entry routes
    Route::resource('time-entries', TimeEntryController::class);
    Route::get('/time-tracking', [TimeEntryController::class, 'index'])->name('time-tracking.index');
});

require __DIR__.'/auth.php';
