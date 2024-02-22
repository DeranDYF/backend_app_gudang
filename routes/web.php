<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;

use App\Http\Controllers\BarangController;
use App\Http\Controllers\PengambilanBarangController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;

use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('login', [AuthController::class, 'index'])->name('login');
Route::get('register', [AuthController::class, 'register'])->name('register');
Route::post('proses_login', [AuthController::class, 'proses_login'])->name('proses_login');
Route::post('proses_register', [AuthController::class, 'proses_register'])->name('proses_register');


Route::group(['middleware' => ['auth']], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('pengambilan-barang', [PengambilanBarangController::class, 'index'])->name('pengambilan-barang');
    Route::get('get_all_pengambilan', [PengambilanBarangController::class, 'getAllPengambilan'])->name('get_all_pengambilan');
    Route::get('get_pengambilan_by_id/{id}', [PengambilanBarangController::class, 'getPengambilanById'])->name('get_pengambilan_by_id');
    Route::get('get_all_barang_pengambilan', [PengambilanBarangController::class, 'getAllBarang'])->name('get_all_barang_pengambilan');
    Route::get('get_all_barang', [BarangController::class, 'getAllBarang'])->name('get_all_barang');

    Route::group(['middleware' => ['auth', 'keeper']], function () {
    });

    Route::get('form-masuk', [BarangController::class, 'index_masuk'])->name('form-masuk');
    Route::get('get_all_masuk', [BarangController::class, 'getAllMasuk'])->name('get_all_masuk');
    Route::any('add_masuk', [BarangController::class, 'addMasuk'])->name('add_masuk');
    Route::get('get_masuk_by_id/{id}', [BarangController::class, 'getMasukById'])->name('get_masuk_by_id');
    Route::get('form-keluar', [BarangController::class, 'index_keluar'])->name('form-keluar');
    Route::get('get_all_keluar', [BarangController::class, 'getAllKeluar'])->name('get_all_keluar');
    Route::get('get_all_pengambilan_keluar', [BarangController::class, 'getAllPengambilanKeluar'])->name('get_all_pengambilan_keluar');
    Route::any('add_keluar', [BarangController::class, 'addKeluar'])->name('add_keluar');
    Route::get('get_keluar_by_id/{id}', [BarangController::class, 'getKeluarById'])->name('get_keluar_by_id');

    Route::any('update-persetujuan', [PengambilanBarangController::class, 'update_persetujuan'])->name('update-persetujuan');

    Route::group(['middleware' => ['auth', 'staff']], function () {

        // Pengajuan
        // pengambilan Barang
        Route::any('add_pengambilan', [PengambilanBarangController::class, 'addPengambilan'])->name('add_pengambilan');
        Route::any('edit_pengambilan', [PengambilanBarangController::class, 'editPengambilan'])->name('edit_pengambilan');
        Route::any('delete_pengambilan/{id}', [PengambilanBarangController::class, 'deletePengambilan'])->name('delete_pengambilan');
    });

    Route::group(['middleware' => ['auth', 'admin']], function () {

        Route::get('stok-barang', [BarangController::class, 'index_stok'])->name('stok-barang');
        Route::get('get_barang_by_id/{id}', [BarangController::class, 'getBarangById'])->name('get_barang_by_id');
        Route::any('add_barang', [BarangController::class, 'addBarang'])->name('add_barang');
        Route::any('edit_barang', [BarangController::class, 'editBarang'])->name('edit_barang');
        Route::any('delete_barang/{id}', [BarangController::class, 'deleteBarang'])->name('delete_barang');

        //User
        Route::get('user', [UserController::class, 'index'])->name('user');
        Route::get('get_all_user', [UserController::class, 'getAllUser'])->name('get_all_user');
        Route::get('get_user_by_id/{id}', [UserController::class, 'getUserById'])->name('get_user_by_id');
        Route::any('add_user', [UserController::class, 'addUser'])->name('add_user');
        Route::any('edit_user', [UserController::class, 'editUser'])->name('edit_user');
        Route::any('delete_user/{id}', [UserController::class, 'deleteUser'])->name('delete_user');

        //Role
        Route::get('role', [RoleController::class, 'index'])->name('role');
        Route::get('get_all_role', [RoleController::class, 'getAllRole'])->name('get_all_role');
        Route::get('get_role_by_id/{id}', [RoleController::class, 'getRoleById'])->name('get_role_by_id');
        Route::any('add_role', [RoleController::class, 'addRole'])->name('add_role');
        Route::any('edit_role', [RoleController::class, 'editRole'])->name('edit_role');
        Route::any('delete_role/{id}', [RoleController::class, 'deleteRole'])->name('delete_role');
    });

    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
});
