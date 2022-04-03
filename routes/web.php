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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/tasks/', [TaskController::class, 'index']);
Route::get('/task/{taskId}/', [TaskController::class, 'getTask']);
Route::post('/tasks/create_task/', [TaskController::class, 'createNewTask']);
Route::put('/tasks/update_task/', [TaskController::class, 'updateTask']);
Route::delete('/tasks/delete_task/', [TaskController::class, 'deleteTask']);
Route::get('/tasks/search_by_status/', [TaskController::class, 'searchTaskByStatus']);
Route::get('/tasks/search_by_doer/', [TaskController::class, 'searchTaskByDoer']);

Route::get('/users/', [UserController::class, 'index']);
Route::get('/user/{userId}/', [UserController::class, 'getUser']);
Route::post('/users/create_user/', [UserController::class, 'createNewUser']);
Route::put('/users/update_user/', [UserController::class, 'updateUser']);
Route::delete('/user/delete_user/', [UserController::class, 'deleteUser']);


