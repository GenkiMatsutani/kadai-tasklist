<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\TasksController;
use App\Http\Middleware\CheckTaskAccess;

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

Route::get('/', [TasksController::class, 'index']);

Route::get('/dashboard', [TasksController::class, 'index'])->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::group(['middleware' => ['auth']], function () {
    Route::resource('users', UsersController::class, ['only' => ['index', 'show']]);
    Route::resource('tasks', TasksController::class, ['only' => ['store', 'destroy']]);
});       

Route::get('/', [TasksController::class, 'index']);
Route::resource('tasks', TasksController::class);
Route::get('/tasks/{task}', 'TaskController@show')->middleware('check.task.access');
Route::group(['middleware' => [CheckTaskAccess::class]], function () {
    Route::get('/tasks/{task}', 'TasksController@show');
});
Route::get('/tasks/{task}', [TasksController::class, 'show'])->middleware([CheckTaskAccess::class])->name('tasks.show');
// Route::get('/tasks/{task}/edit', [TasksController::class, 'edit'])->name('tasks.edit');
Route::get('/tasks/{task}/edit', 'App\Http\Controllers\TasksController@edit')->name('tasks.edit')->middleware('check.task.access');
Route::put('/tasks/{task}', [TasksController::class, 'update'])->name('tasks.update');