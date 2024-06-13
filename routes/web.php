<?php

use App\Http\Controllers\SkpiController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::get('/login', [UserController::class, 'loginView'])->name('login');
Route::post('/action-login', [UserController::class, 'login'])->name('action-login');
Route::get('/register', [UserController::class, 'registerView'])->name('register');
Route::post('/register', [UserController::class, 'register'])->name('action-register');
Route::post('/logout', [UserController::class, 'logout'])->name('logout');

Route::middleware('custom-login')->group(function () {
    Route::get('/', function () {
        return view('index');
    })->name('home');

    Route::get('/input/skpi', [SkpiController::class, 'view'])->name('view-input-skpi');
    Route::post('/input/skpi', [SkpiController::class, 'insert'])->name('insert-input-skpi');
    Route::get('/data/skpi', [SkpiController::class, 'getSKPI']);
    Route::get('/download/portofolio/skpi/{fileName}', [SkpiController::class, 'downloadFile']);
});