<?php

use App\Http\Controllers\AdminClassController;
use App\Http\Controllers\ClassroomController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')
    ->name('admin.classrooms.')
    ->group(function() {
    Route::get('/classrooms', [AdminClassController::class, 'index'])->name('index');
    Route::get('/classrooms/create', [AdminClassController::class, 'create'])->name('create');
    Route::post('/classrooms', [AdminClassController::class, 'store'])->name('store');
    Route::get('/classrooms/{classroom:slug}/edit', [AdminClassController::class, 'edit'])->name('edit');
    Route::patch('/classrooms/{classroom:slug}', [AdminClassController::class, 'update'])->name('update');
});

Route::get('classes/{classroom:class}', [ClassroomController::class, 'show']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
