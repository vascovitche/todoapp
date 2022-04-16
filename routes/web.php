<?php

use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
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

Route::redirect('/', 'tasks');
Route::resource('tasks', TaskController::class);
Route::get('/search', [TaskController::class, 'search'])->name('tasks.search');
Route::get('/sort', [TaskController::class, 'sort'])->name('tasks.sort');


