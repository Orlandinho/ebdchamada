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

Route::get('/admin/classrooms', [AdminClassController::class, 'index']);
Route::get('/admin/classrooms/create', [AdminClassController::class, 'create']);

Route::get('classes/{classroom:class}', [ClassroomController::class, 'show']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
