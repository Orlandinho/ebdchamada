<?php

use App\Http\Controllers\AdminClassController;
use App\Http\Controllers\AdminStudentController;
use App\Http\Controllers\ClassroomController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')
    ->name('admin.classrooms.')
    ->group(function() {
    Route::get('/classrooms', [AdminClassController::class, 'index'])->name('index');
    Route::get('/classrooms/create', [AdminClassController::class, 'create'])->name('create');
    Route::post('/classrooms', [AdminClassController::class, 'store'])->name('store');
    Route::get('/classrooms/{classroom:slug}', [AdminClassController::class, 'show'])->name('{classroom:slug}');
    Route::get('/classrooms/{classroom:slug}/edit', [AdminClassController::class, 'edit'])->name('edit');
    Route::patch('/classrooms/{classroom:slug}', [AdminClassController::class, 'update'])->name('update');
    Route::delete('/classrooms/{classroom:slug}', [AdminClassController::class, 'destroy'])->name('delete');
});

Route::prefix('admin')
    ->name('admin.students.')
    ->group(function() {
        Route::get('/students', [AdminStudentController::class, 'index'])->name('index');
    });

Route::get('admin/dashboard', function(){
    return view('admin.dashboard');
});

Route::get('classes/{classroom:slug}', [ClassroomController::class, 'show']);

Route::get('/', function(){
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
