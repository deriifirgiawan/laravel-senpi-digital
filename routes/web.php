<?php

use App\Http\Controllers\approver\PersetujuanController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\staffit\AkunController;
use App\Http\Controllers\staffit\LaporanController;
use App\Http\Controllers\staffit\PersonilController;
use App\Http\Controllers\staffit\WeaponController;
use App\Http\Controllers\staffit\UploadTestController;
use App\Http\Controllers\user\KartuController;
use App\Http\Controllers\user\PengajuanController;
use App\Http\Controllers\user\ProfileController;
use App\Http\Controllers\user\UserController;
use App\Models\Personil;
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

Route::get('/', [IndexController::class, 'index'])->name('index')->middleware('auth');


Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::post('/login', [AuthController::class, 'login'])->name('loginPost');


Route::post('/register', [AuthController::class, 'register'])->name('registerPost');
Route::get('/search-nrp', [AuthController::class, 'searchNrp'])->name('search-nrp');

Route::get('/forgot-password', [AuthController::class, 'showCheckEmailForm'])->name('forgot-password');
Route::post('/forgot-password-send', [AuthController::class, 'sendEmailForgot'])->name('send-forgot-password');
Route::get('/forgot-password/change-password', [AuthController::class, 'showChangePasswordForm'])->name('forgot-password.change-password');
Route::post('/forgot-password/change-password', [AuthController::class, 'updatePassword'])->name('forgot-password.change-password-update-password');

Route::get('/profile', [ProfileController::class, 'Index'])->name('profile')->middleware('auth');
Route::put('/profile', [ProfileController::class, 'Update'])->name('profile.update')->middleware('auth');


// Staff-IT Routes
Route::middleware(['auth', 'role:staff-it'])->prefix('staff-it')->group(function () {
    // route home
    Route::get('/', [IndexController::class, 'indexStaffIT'])->name('staff-it-index');
    // akun
    Route::get('/akun', [AkunController::class, 'index'])->name('staff-it-akun.index');
    Route::post('/akun', [AkunController::class, 'store'])->name('staff-it-akun.post');
    Route::get('/akun/{id}/edit', [AkunController::class, 'edit'])->name('staff-it-akun.edit');
    Route::put('/akun/{id}/update', [AkunController::class, 'update'])->name('staff-it-akun.update');
    Route::delete('/akun/{id}/delete', [AkunController::class, 'destroy'])->name('staff-it-akun.delete');

    // personil
    Route::get('/personil', [PersonilController::class, 'index'])->name('staff-it-personil.index');
    Route::post('/personil', [PersonilController::class, 'store'])->name('staff-it-personil.post');
    Route::get('/personil/{id}/edit', [PersonilController::class, 'edit'])->name('staff-it-personil.edit');
    Route::put('/personil/{id}/update', [PersonilController::class, 'update'])->name('staff-it-personil.update');
    Route::delete('/personil/{id}/delete', [PersonilController::class, 'destroy'])->name('staff-it-personil.delete');

    // senjata api
    Route::resource('senjata-api', WeaponController::class)->names([
        'index' => 'staff-it-senjata-api.index',
        'create' => 'staff-it-senjata-api.create',
        'store' => 'staff-it-senjata-api.store',
        'show' => 'staff-it-senjata-api.show',
        'edit' => 'staff-it-senjata-api.edit',
        'update' => 'staff-it-senjata-api.update',
        'destroy' => 'staff-it-senjata-api.destroy',
    ]);

    // Upload Test
    Route::get('/upload-test', [UploadTestController::class, 'Index'])->name('staff-it-upload-test.index');
    Route::get('/upload-test/tambah', [UploadTestController::class, 'showFormAdd'])->name('staff-it-upload-test.add');
    Route::post('/upload-test/tambah', [UploadTestController::class, 'store'])->name('staff-it-upload-test.post');
    Route::get('/upload-test/{id}/edit', [UploadTestController::class, 'edit'])->name('staff-it-upload-test.edit');
    Route::put('/upload-test/{id}/update', [UploadTestController::class, 'update'])->name('staff-it-upload-test.update');
    Route::delete('/upload-test/{id}/delete', [UploadTestController::class, 'destroy'])->name('staff-it-upload-test.delete');

    // laporan
    Route::get('/laporan', [LaporanController::class, 'index'])->name('staff-it-laporan');
    Route::get('/cetak-laporan', [LaporanController::class, 'generateReport'])->name('staff-it-cetak-laporan');
});

// Approver
Route::middleware(['auth', 'role:approver'])->prefix('approver')->group(function () {
    // route home
    Route::get('/', [IndexController::class, 'indexStaffIT'])->name('approver-index');

    Route::get('/persetujuan', [PersetujuanController::class, 'Index'])->name('approver-persetujuan.index');
    Route::get('/persetujuan/setuju/{id}', [PersetujuanController::class, 'setuju'])->name('approver-persetujuan.setuju');
    Route::post('/persetujuan/tolak', [PersetujuanController::class, 'reject'])->name('approver-persetujuan.reject');
});

// User
Route::middleware(['auth', 'role:user'])->prefix('user')->group(function () {
    Route::get('/', [UserController::class, 'Index'])->name('user-index');

    // Pengajuan
    Route::get('/pengajuan', [PengajuanController::class, 'Index'])->name('pengajuan');
    Route::get('/pengajuan/tambah', [PengajuanController::class, 'formPengajuan'])->name('pengajuan.tambah');
    Route::post('/pengajuan', [PengajuanController::class, 'store'])->name('pengajuan.post');

    Route::get('/kartu', [KartuController::class, 'Index'])->name('kartu');
    Route::get('/kartu/{id}/detail', [KartuController::class, 'detail'])->name('kartu-detail');
});
