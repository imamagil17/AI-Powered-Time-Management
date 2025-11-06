<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('/projects', function () {
        $projects = [
            [
                'id' => 1,
                'name' => 'AI: Analisis Sentimen Pasar',
                'status' => 'In Progress',
                'progress' => 60, // Persentase progres
                'due_date' => '2025-12-30'
            ],
            [
                'id' => 2,
                'name' => 'Web Manajemen Waktu (Internal)',
                'status' => 'Pending',
                'progress' => 10,
                'due_date' => '2026-02-15'
            ],
            [
                'id' => 3,
                'name' => 'Desain Landing Page Klien',
                'status' => 'Completed',
                'progress' => 100,
                'due_date' => '2025-11-01'
            ]
        ];

        return view('projects.index', [
            'projects' => $projects
        ]);
    })->name('projects.index');
});

require __DIR__.'/auth.php';
