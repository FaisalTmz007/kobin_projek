<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\JelajahController;
use App\Http\Controllers\OngkirController;
use App\Http\Controllers\ResiController;
use App\Http\Controllers\ProfileController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('user/jelajah', [JelajahController::class, 'show'], function () {
    return view('user/jelajah');
})->middleware('auth:owner,supplier')->name('jelajah');

Route::get('register', [AuthController::class, 'register_user'])->name('register_user');
Route::post('register', [AuthController::class, 'register_action'])->name('register.action');

Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'login_action'])->name('login.action');

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('user/home', function () {
    return view('user/home');
})->middleware('auth:owner,supplier')->name('home');

Route::get('/cek-ongkir', [OngkirController::class, 'index'])->middleware('auth:owner,supplier')->name('ongkir');
Route::post('/cek-ongkir', [OngkirController::class, 'cekOngkir'])->middleware('auth:owner,supplier')->name('cekOngkir');

Route::get('/cek-resi', [ResiController::class, 'index'])->middleware('auth:owner,supplier')->name('resi');
Route::post('/cek-resi', [ResiController::class, 'cekResi'])->middleware('auth:owner,supplier')->name('cekResi');

Route::get('/user/profile', function() {return view('user/profile');})->middleware('auth:owner,supplier')->name('profile');

Route::get('/user/ubah-profile', [ProfileController::class, 'index'])->middleware('auth:owner,supplier')->name('ubah-profile');

Route::post('/user/ubah-profile-owner{id}', [ProfileController::class, 'editOwner'])->middleware('auth:owner,supplier');
Route::post('/user/ubah-profile-supplier{id}', [ProfileController::class, 'editSupplier'])->middleware('auth:owner,supplier');

// Route::get('user/jelajah', [JelajahController::class, 'show']);


// Admin

Route::get('admin/login', [AdminController::class, 'login_admin'])->name('login_admin');
Route::post('admin/login', [AdminController::class, 'login_admin_action'])->name('login_admin.action');

Route::get('admin/home', function () {
    return view('admin/home');
})->middleware('auth:admin')->name('admin');

// Route::get('admin/userManagement', [UserManagementController::class, 'index']);
// Route::get('admin/userManagement', [UserManagementController::class, 'getUser'])->name('userManagement');
Route::get('admin/ownerManagement', [UserManagementController::class, 'getOwner'])->middleware('auth:admin')->name('ownerManagement');
Route::get('admin/supplierManagement', [UserManagementController::class, 'getSupplier'])->middleware('auth:admin')->name('supplierManagement');

//edit
Route::match(['get', 'post'], 'admin/ownerManagement/edit{id}', [UserManagementController::class, 'editOwner']);
Route::match(['get', 'post'], 'admin/supplierManagement/edit{id}', [UserManagementController::class, 'editSupplier']);

Route::get('admin/logout', [AdminController::class, 'logout'])->name('adminlogout');