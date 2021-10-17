<?php

use App\Http\Controllers\Admin\TasksController;
use App\Http\Controllers\Admin\CommentsController;
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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::middleware(['role:admin'])->prefix('admin-panel')->group(function () {
    Route::get('test', [App\Http\Controllers\Admin\HomeController::class, 'test']);
    Route::get('/', [App\Http\Controllers\Admin\HomeController::class, 'index']);

    Route::resource('tasks', TasksController::class);

    // Comments
    Route::post('{task}/comments', [CommentsController::class, 'store'])->name('comments.store');
//    Route::get('/comments/{comment}/edit', [CommentsController::class, 'edit'])->name('comments.edit');
//    Route::put('/comments/{comment}', [CommentsController::class, 'update'])->name('comments.update');
    Route::delete('/comments/{comment}', [CommentsController::class, 'destroy'])->name('comments.destroy');
});

