<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PortofolioController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\dosenProdiController;
use App\Http\Controllers\HomeController;

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
    Route::get('/', [HomeController::class, 'home'])->name('home');

    Route::get('/input/portofolio', [PortofolioController::class, 'view'])->name('view-input-portofolio');
    Route::post('/input/portofolio', [PortofolioController::class, 'insert'])->name('insert-input-portofolio');
    Route::get('/data/all/portofolio', [PortofolioController::class, 'getAllPortofolio']);
    Route::get('/data/portofolio', [PortofolioController::class, 'getPortofolio']);
    Route::post('/update/portofolio/status', [PortofolioController::class, 'updateStatusPortofolio']);
    Route::get('/data/all/skpi', [PortofolioController::class, 'getAllSKPI']);
    Route::get('/profile/change', [UserController::class, 'editPassView'])->name('edit-profile');
    Route::post('/profile/change', [UserController::class, 'updatePass'])->name('update-profile');

    Route::get('/list/mahasiswa', [dosenProdiController::class, 'listMahasiswa'])->name('list-mahasiswa');
    Route::get('/get-data/mahasiswa', [dosenProdiController::class, 'getDataMahasiswa']);
    Route::post('/update/mahasiswa/status', [dosenProdiController::class, 'updateStatusMahasiswa']);
    Route::get('/add/mahasiswa', [dosenProdiController::class, 'addMahasiswaView'])->name('add-mahasiswa');
    Route::get('/add/mahasiswa/bulk', [dosenProdiController::class, 'addMahasiswaBulkView'])->name('add-mahasiswa-bulk');
    Route::post('/add/mahasiswa/bulk', [UserController::class, 'registerBulk'])->name('action-register-bulk');
    Route::get('/list/kualifikasi', [dosenProdiController::class, 'listKualifikasi'])->name('list-kualifikasi');
    Route::get('/get-data/kualifikasi', [dosenProdiController::class, 'getDataKualifikasi']);
    Route::get('/add/kualifikasi', [dosenProdiController::class, 'addKualifikasiView'])->name('add-kualifikasi');
    Route::post('/add/kualifikasi', [dosenProdiController::class, 'insertKualifikasi'])->name('insert-kualifikasi');
    Route::get('/list/portofolio', [dosenProdiController::class, 'listPortofolio'])->name('list-portofolio');
    Route::get('/list/skpi', [dosenProdiController::class, 'listSkpi'])->name('list-skpi');
    Route::get('/validate/skpi', [dosenProdiController::class, 'validateSkpi'])->name('validate-skpi');
    Route::post('/validate/skpi', [dosenProdiController::class, 'actionValidateSkpi'])->name('action-validate-skpi');
    Route::post('/update/skpi/status', [PortofolioController::class, 'updateStatusSKPI']);

    Route::get('/download/template/mahasiswa', [HomeController::class, 'downloadFile'])->name('download-template-mahasiswa');
    Route::get('/download/portofolio/{fileName}', [PortofolioController::class, 'downloadFile']);
    Route::get('/print/skpi/qr/{skpiID}', [PortofolioController::class, 'getQR']);
});
