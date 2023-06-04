<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CoffeePriceController;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\KasController;
use App\Http\Controllers\JelajahController;
use App\Http\Controllers\OngkirController;
use App\Http\Controllers\PremiumController;
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
    return view('user/login');
});

Route::get('user/jelajah', [JelajahController::class, 'show'], function () {
    return view('user/jelajah');
})->middleware('auth:owner,supplier')->name('jelajah');

Route::get('register', [AuthController::class, 'register_user'])->name('register_user');
Route::post('register', [AuthController::class, 'register_action'])->name('register.action');
Route::get('reset-password', [AuthController::class, 'resetPassword'])->name('resetPassword');
Route::post('reset-password', [UserManagementController::class, 'createReset'])->name('createReset');

Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'login_action'])->name('login.action');

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// Route::get('user/home', function () {
//     return view('user/home');
// })->middleware('auth:owner,supplier')->name('home');

Route::get('user/home', [KasController::class, 'incomeTotal'])->middleware('auth:owner,supplier')->name('home');

Route::get('/cek-ongkir', [OngkirController::class, 'index'])->name('ongkir');
Route::post('/cek-ongkir', [OngkirController::class, 'cekOngkir'])->name('cekOngkir');

Route::get('/cek-resi', [ResiController::class, 'index'])->name('resi');
Route::post('/cek-resi', [ResiController::class, 'cekResi'])->name('cekResi');

Route::get('/harga-kopi', [CoffeePriceController::class, 'getPrice'])->middleware('auth:owner,supplier')->name('harga-kopi');

Route::resource('user/kas', KasController::class);
Route::resource('user/premium', PremiumController::class);
Route::get('admin/premium', [PremiumController::class, 'getTransaksi'])->middleware('auth:admin')->name('premium-manager');
Route::delete('admin/premium/{id}', [PremiumController::class, 'deleteTransaksi'])->middleware('auth:admin');
Route::put('admin/premium/owner/{id}', [PremiumController::class, 'accTransaksi'])->middleware('auth:admin');
Route::put('admin/premium/supplier/{id}', [PremiumController::class, 'accTransaksi'])->middleware('auth:admin');
Route::get('admin/deactive-premium', [PremiumController::class, 'getdecTransaksi'])->middleware('auth:admin')->name('deactive-premium');
Route::put('admin/premium/owner/deactive/{id}', [PremiumController::class, 'decTransaksi'])->middleware('auth:admin');
Route::put('admin/premium/supplier/deactive/{id}', [PremiumController::class, 'decTransaksi'])->middleware('auth:admin');
// Route::get('user/premium/create', PremiumController::class, 'pilihPaket');

// Route::get('/user/kas/index', [KasController::class, 'index'])->middleware('auth:owner,supplier')->name('kas');
// Route::get('/user/kas/create', [KasController::class, 'create'])->middleware('auth:owner,supplier')->name('create');
// Route::post('/user/kas/store', [KasController::class, 'store'])->middleware('auth:owner,supplier')->name('store');
// Route::get('/user/kas/edit', [KasController::class, 'edit{id}'])->middleware('auth:owner,supplier')->name('edit');
// Route::get('/user/pembukuan', function() {return view('user/pembukuan');})->middleware('auth:owner,supplier')->name('pembukuan');

Route::get('/user/profile', function() {return view('user/profile');})->middleware('auth:owner,supplier')->name('profile');

Route::get('/user/ubah-profile', [ProfileController::class, 'index'])->middleware('auth:owner,supplier')->name('ubah-profile');

Route::post('/user/ubah-profile-owner{id}', [ProfileController::class, 'editOwner'])->middleware('auth:owner,supplier');
Route::post('/user/ubah-profile-supplier{id}', [ProfileController::class, 'editSupplier'])->middleware('auth:owner,supplier');

Route::get('password', [ProfileController::class, 'password'])->name('password');
Route::post('password', [ProfileController::class, 'password_action'])->name('password.action');

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
Route::get('admin/reset-user', [UserManagementController::class, 'getResetUser'])->middleware('auth:admin')->name('reset-user');

Route::put('admin/reset-user/owner/{id}', [UserManagementController::class, 'accResetPassword'])->middleware('auth:admin');
Route::put('admin/reset-user/supplier/{id}', [UserManagementController::class, 'accResetPassword'])->middleware('auth:admin');

//edit
Route::match(['get', 'post'], 'admin/ownerManagement/edit{id}', [UserManagementController::class, 'editOwner']);
Route::match(['get', 'post'], 'admin/ownerManagement/password{id}', [UserManagementController::class, 'passwordOwner']);

Route::match(['get', 'post'], 'admin/supplierManagement/edit{id}', [UserManagementController::class, 'editSupplier']);
Route::match(['get', 'post'], 'admin/supplierManagement/password{id}', [UserManagementController::class, 'passwordSupplier']);

Route::get('admin/logout', [AdminController::class, 'logout'])->name('adminlogout');