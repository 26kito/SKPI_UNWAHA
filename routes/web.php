<?php

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

Route::get('/login', [UserController::class, 'view'])->name('login');

Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return view('index');
    });
});

// Route::get('/page-lain', function () {
//     return view('lain');
// })->name('lain');