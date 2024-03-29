<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\Controller;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Auth;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::group(['middleware' => ['web']], function () {

    Route::get('/', function () {
        return view('welcome');
    })->middleware('guest');

    
    Route::get('/tasks', [TaskController::class, 'index']);
    Route::post('/task', [TaskController::class, 'store']);
    Route::delete('/task/{task}', [TaskController::class, 'destroy']);
    Route::get('/search', [TaskController::class, 'search']);
    Auth::routes();

});

