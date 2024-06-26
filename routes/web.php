<?php

use Mews\Captcha\Facades\Captcha;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\dosenProdiController;
use App\Http\Controllers\KualifikasiController;
use App\Http\Controllers\PortofolioController;

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

Route::get('/refresh-captcha', function () {
    return response()->json(['url' => Captcha::src('default')]);
});

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

    // Mahasiswa
    Route::get('/list/mahasiswa', [dosenProdiController::class, 'listMahasiswa'])->name('list-mahasiswa');
    Route::get('/get-data/mahasiswa', [dosenProdiController::class, 'getDataMahasiswa']);
    Route::post('/update/mahasiswa/status', [dosenProdiController::class, 'updateStatusMahasiswa']);
    Route::get('/add/mahasiswa', [dosenProdiController::class, 'addMahasiswaView'])->name('add-mahasiswa');
    Route::get('/add/mahasiswa/bulk', [dosenProdiController::class, 'addMahasiswaBulkView'])->name('add-mahasiswa-bulk');
    Route::post('/add/mahasiswa/bulk', [UserController::class, 'registerBulk'])->name('action-register-bulk');

    // Kualifikasi
    Route::get('/list/kualifikasi', [KualifikasiController::class, 'listKualifikasi'])->name('list-kualifikasi');
    Route::get('/get-data/kualifikasi', [KualifikasiController::class, 'getDataKualifikasi']);
    Route::get('/add/kualifikasi', [KualifikasiController::class, 'addKualifikasiView'])->name('add-kualifikasi');
    Route::post('/add/kualifikasi', [KualifikasiController::class, 'insertKualifikasi'])->name('insert-kualifikasi');
    Route::get('/edit/kualifikasi/{id}', [KualifikasiController::class, 'editKualifikasiView'])->name('edit-kualifikasi');
    Route::post('/update/kualifikasi/{id}', [KualifikasiController::class, 'updateKualifikasi'])->name('update-kualifikasi');
    Route::post('/delete/kualifikasi', [KualifikasiController::class, 'deleteKualifikasi']);

    Route::get('/list/portofolio', [dosenProdiController::class, 'listPortofolio'])->name('list-portofolio');
    Route::get('/list/skpi', [dosenProdiController::class, 'listSkpi'])->name('list-skpi');
    Route::get('/validate/skpi', [dosenProdiController::class, 'validateSkpi'])->name('validate-skpi');
    Route::post('/validate/skpi', [dosenProdiController::class, 'actionValidateSkpi'])->name('action-validate-skpi');
    Route::post('/update/skpi/status', [PortofolioController::class, 'updateStatusSKPI']);

    Route::get('/download/template/mahasiswa', [HomeController::class, 'downloadFile'])->name('download-template-mahasiswa');
    Route::get('/download/portofolio/{fileName}', [PortofolioController::class, 'downloadFile']);
    Route::get('/print/skpi/qr/{skpiID}', [PortofolioController::class, 'getQR']);
});
