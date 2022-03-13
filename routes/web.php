<?php

use App\Http\Controllers\AdminClassController;
use App\Http\Controllers\AdminStudentController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\PasswordController;
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
        Route::get('/students/create', [AdminStudentController::class, 'create'])->name('create');
        Route::post('/students', [AdminStudentController::class, 'store'])->name('store');
        Route::get('/students/{student:slug}', [AdminStudentController::class, 'show'])->name('{student:slug}');
        Route::get('/students/{student:slug}/edit', [AdminStudentController::class, 'edit'])->name('edit');
        Route::patch('/students/{student:slug}', [AdminStudentController::class, 'update'])->name('update');
        Route::delete('/students/{student:slug}', [AdminStudentController::class, 'destroy'])->name('delete');
    });

Route::prefix('admin')
    ->name('admin.users.')
    ->group(function() {
        Route::get('/users', [AdminUserController::class, 'index'])->name('index');
        Route::get('/users/create', [AdminUserController::class, 'create'])->name('create');
        Route::post('/users', [AdminUserController::class, 'store']);
        Route::get('/users/{user}', [AdminUserController::class, 'show'])->name('{user}');
        Route::get('/users/{user}/edit', [AdminUserController::class, 'edit'])->name('edit');
        Route::patch('/users/{user}', [AdminUserController::class, 'update']);
        Route::delete('/users/{user}', [AdminUserController::class, 'destroy']);
    });

Route::get('/password/{user}/edit', [PasswordController::class, 'edit'])->name('password_create')->middleware('signed');
Route::patch('/password/{user}', [PasswordController::class, 'update']);

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
