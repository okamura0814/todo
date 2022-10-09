<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

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

Route::get('/login', function () {
    return view('auth.login');
});

Auth::routes(['verify' => true]);

Route::get('/verify', function () {
    return view('auth.verify');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/');
})->middleware(['auth', 'signed'])->name('verification.verify');

// 確認済みのユーザーのみがこのルートにアクセス可能
Route::group(['middleware' => 'verified'], function () {
    Route::get('/', [App\Http\Controllers\TodoController::class, 'index'])->name('home');
    Route::get('/todo/create', [App\Http\Controllers\TodoController::class, 'create'])->name('todo.create');
    Route::post('/todo/store', [App\Http\Controllers\TodoController::class, 'store'])->name('todo.store');
    Route::get('/todo/{book}/edit', [App\Http\Controllers\TodoController::class, 'edit'])->name('todo.edit');
    Route::post('todo/update/{id}', [App\Http\Controllers\TodoController::class, 'update'])->name('todo.update');
    Route::post('/todo/destroy/{todo}', [App\Http\Controllers\TodoController::class, 'destroy'])->name('todo.destroy');
});