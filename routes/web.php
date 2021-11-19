<?php

use App\Http\Controllers\Admin\FinanceController;
use App\Http\Controllers\Admin\MoneyboxController;
use App\Http\Controllers\Admin\TasksController;
use App\Http\Controllers\Admin\CommentsController;
use App\Http\Controllers\Admin\ExpenseController;
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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Route::middleware(['role:admin'])->prefix('admin-panel')->group(function () {
Route::middleware('auth')->group(function () {
    Route::get('test', [App\Http\Controllers\Admin\HomeController::class, 'test']);
    Route::get('/', [App\Http\Controllers\Admin\HomeController::class, 'index']);

    Route::resource('tasks', TasksController::class);
    Route::put('tasks/complete/{id}', [TasksController::class, 'complete'])->name('tasks.complete');
    Route::put('tasks/updateStatus/{id}/{status}', [TasksController::class, 'updateStatus'])->name('tasks.updateStatus');

    // Comments
    Route::post('{task}/comments', [CommentsController::class, 'store'])->name('comments.store');
//    Route::get('/comments/{comment}/edit', [CommentsController::class, 'edit'])->name('comments.edit');
//    Route::put('/comments/{comment}', [CommentsController::class, 'update'])->name('comments.update');
    Route::delete('/comments/{comment}', [CommentsController::class, 'destroy'])->name('comments.destroy');

    // finances
    Route::get('finances', [FinanceController::class, 'index'])->name('finances.index');
    Route::post('finances', [FinanceController::class, 'store'])->name('finances.store');

    // expenses
    Route::post('expenses', [ExpenseController::class, 'store'])->name('expenses.store');

//     moneybox
    Route::get('moneybox', [MoneyboxController::class, 'index'])->name('moneybox.index');
    Route::post('moneybox', [MoneyboxController::class, 'store'])->name('moneybox.store');
    Route::put('moneybox', [MoneyboxController::class, 'update'])->name('moneybox.update');
    Route::delete('moneybox', [MoneyboxController::class, 'destroy'])->name('moneybox.destroy');

});

