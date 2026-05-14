<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    if (auth()->user()->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }
    return redirect()->route('intern.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

use App\Http\Controllers\AdminController;

// Admin Routes
Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', function() { return redirect()->route('admin.dashboard'); });
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/interns', [AdminController::class, 'interns'])->name('interns');
    Route::get('/alumni', [AdminController::class, 'alumni'])->name('alumni');
    Route::post('/interns/{user}/approve', [AdminController::class, 'approve'])->name('interns.approve');
    Route::post('/interns/{user}/reject', [AdminController::class, 'reject'])->name('interns.reject');
    Route::get('/attendances', [AdminController::class, 'attendances'])->name('attendances');
    Route::get('/journals', [AdminController::class, 'journals'])->name('journals');
    Route::get('/evaluations', [AdminController::class, 'evaluations'])->name('evaluations');
    Route::post('/evaluations/{user}', [AdminController::class, 'storeEvaluation'])->name('evaluations.store');
});

use App\Http\Controllers\InternController;

// Intern Routes
Route::middleware(['auth', 'verified'])->prefix('intern')->name('intern.')->group(function () {
    Route::get('/dashboard', [InternController::class, 'dashboard'])->name('dashboard');
    Route::get('/card', [InternController::class, 'card'])->name('card');
    Route::post('/card/photo', [InternController::class, 'updatePhoto'])->name('card.photo');
    Route::get('/card/print', [InternController::class, 'printCard'])->name('card.print');
    Route::get('/attendance', [InternController::class, 'attendance'])->name('attendance');
    Route::post('/attendance', [InternController::class, 'storeAttendance'])->name('attendance.store');
    Route::get('/attendance/print', [InternController::class, 'printAttendance'])->name('attendance.print');
    Route::get('/journals', [InternController::class, 'journals'])->name('journals');
    Route::post('/journals', [InternController::class, 'storeJournal'])->name('journals.store');
    Route::get('/journals/print', [InternController::class, 'printJournals'])->name('journals.print');
    Route::get('/evaluation', [InternController::class, 'evaluation'])->name('evaluation');
    Route::get('/evaluation/print', [InternController::class, 'printEvaluation'])->name('evaluation.print');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
