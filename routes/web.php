<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JenisPemasukanController;
use App\Http\Controllers\JenisPengeluaranController;
use App\Http\Controllers\PemasukanController;
use App\Http\Controllers\PengeluaranController;
use App\Http\Controllers\LogController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::controller(AuthController::class)->group(function () {
    Route::get('/auth', 'index')->name('auth.index');
    Route::get('/auth/logout', 'logout')->name('auth.index');
    Route::match(['get', 'post'], '/auth/login', 'login')->name('auth.login');
});


Route::controller(DashboardController::class)->group(function () {
    Route::get('/dashboard', 'index');
});

Route::controller(UserController::class)->middleware('OnlySuperAdmin')->group(function () {
    Route::get('/user','index');
    Route::post('/user/tambah', 'store');
    Route::post('/user/{username}/edit', 'update');
    Route::delete('/user/{id}/hapus', 'delete');
});


Route::controller(PemasukanController::class)->group(function () {
    Route::get('/pemasukan', 'index');
    Route::post('/pemasukan/tambah', 'store');
    Route::post('/pemasukan/{id}/edit', 'update');
    Route::delete('/pemasukan/{id}/hapus', 'delete');
});

Route::controller(PengeluaranController::class)->group(function () {
    Route::get('/pengeluaran', 'index');
    Route::post('/pengeluaran/tambah', 'store');
    Route::post('/pengeluaran/{id}/edit', 'update');
    Route::delete('/pengeluaran/{id}/hapus', 'delete');
});

Route::controller(JenisPemasukanController::class)->group(function () {
        Route::get('/jenis_pemasukan', 'index');
        Route::post('/jenis_pemasukan/tambah', 'store');
        Route::post('/jenis_pemasukan/{id}/edit', 'store');
        Route::delete('/jenis_pemasukan/{id}/hapus', 'delete');
});

Route::controller(JenisPengeluaranController::class)->group(function () {
    Route::get('/jenis_pengeluaran', 'index');
    Route::post('/jenis_pengeluaran/tambah', 'store');
    Route::post('/jenis_pengeluaran/{id}/edit', 'store');
    Route::delete('/jenis_pengeluaran/{id}/hapus', 'delete');
});


Route::controller(LogController::class)->group(function () {
    Route::get('/log', 'index');
});
