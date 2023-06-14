<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiswaController; // Memangil controller yang ada dibuat sebelumnya
use App\Http\controllers\DashboardController;
use App\Http\controllers\StaffController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\DivisiController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\UserController;

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
    Alert::success('Selamat Datang');
    return view('welcome');
});

Route::get('/daftar_nilai', function (){
    return view('daftar_nilai');
});

// Mengarahkan routing ke controller
Route::get('/siswa', [SiswaController::class, 'dataSiswa']);
// Mengarahkan ke controller dasboardController
// Prefix atau group
Route::group(['middleware' => ['auth']], function(){
    Route::prefix('admin') -> name('admin.') -> group(function(){
Route::get('/dashboard', [DashboardController::class, 'index']) -> name('index');
Route::get('/staff', [StaffController::class, 'index']);

//Ini adalah route untuk pegawai
Route::get('/pegawai', [PegawaiController::class, 'index']);
Route::get('/pegawai/create', [PegawaiController::class, 'create']);
Route::post('/pegawai/store', [PegawaiController::class, 'store']);
Route::get('/pegawai/edit/{id}', [PegawaiController::class, 'edit']);
Route::post('/pegawai/update', [PegawaiController::class, 'update']);
Route::get('generate-pdf', [PegawaiController::class, 'generatePDF']);
Route::get('/pegawai/pegawaiPDF', [PegawaiController::class, 'PegawaiPDF']);
Route::get('/pegawai/exportexcel/', [PegawaiController::class, 'exportExcel']);
Route::post('/pegawai/importexcel', [PegawaiController::class, 'importExcel']);

// Ini adalah route untuk divisi
Route::get('/divisi', [DivisiController::class, 'index']);
Route::get('/divisi/create', [DivisiController::class, 'create']);
Route::post('/divisi/store', [DivisiController::class, 'store']);
Route::get('/divisi/edit/{id}', [DivisiController::class, 'edit']);
Route::post('/divisi/update', [DivisiController::class, 'update']);
Route::get('/divisi/show/{id}', [DivisiController::class, 'show']);
Route::get('/divisi/delete/{id}', [DivisiController::class, 'destroy']);


// Ini adalah route untuk jabatan
Route::get('/jabatan', [JabatanController::class, 'index']);
Route::get('/jabatan/create', [JabatanController::class, 'create']);
Route::post('/jabatan/store', [JabatanController::class, 'store']);
Route::get('/jabatan/edit/{id}', [JabatanController::class, 'edit']);
Route::post('/jabatan/update', [JabatanController::class, 'update']);

// Ini adalah route untuk User
Route::get('user', [UserController::class, 'index']);

});
});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
