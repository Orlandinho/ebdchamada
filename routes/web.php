<?php

use App\Http\Controllers\AdminClassController;
use App\Http\Controllers\ClassroomController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('admin')
    ->name('admin.classrooms.')
    ->group(function() {
    Route::get('/classrooms', [AdminClassController::class, 'index'])->name('index');
    Route::get('/classrooms/create', [AdminClassController::class, 'create'])->name('create');
    Route::post('/classrooms', [AdminClassController::class, 'store'])->name('store');
    Route::get('/classrooms/{classroom}/edit', [AdminClassController::class, 'edit'])->name('edit');
    Route::get('/classrooms/{classroom}', [AdminClassController::class, 'update'])->name('update');
});

Route::get('classes/{classroom:class}', [ClassroomController::class, 'show']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
