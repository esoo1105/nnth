<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


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
Route::group(['middleware' => 'checkQuyen:Admin'], function () {
    // User
    Route::get('user-add', [\App\Http\Controllers\UserController::class, 'create']);
    Route::get('user/{id}', [\App\Http\Controllers\UserController::class, 'edit'])->name('updateuser');
    Route::delete('user/{id}', [\App\Http\Controllers\UserController::class, 'destroy'])->name('deleteuser');
    Route::resource('user', \App\Http\Controllers\UserController::class)->middleware('auth');

    // Loại khóa học
    Route::get('loaikhoahoc-add', [\App\Http\Controllers\LoaiKhoaHocController::class, 'create']);
    Route::get('loaikhoahoc/{id}', [\App\Http\Controllers\LoaiKhoaHocController::class, 'edit'])->name('updateloaikhoahoc');
    Route::delete('loaikhoahoc/{id}', [\App\Http\Controllers\LoaiKhoaHocController::class, 'destroy'])->name('deleteloaikhoahoc');
    Route::resource('loaikhoahoc', \App\Http\Controllers\LoaiKhoaHocController::class)->middleware('auth');

    // Khóa học
    Route::resource('khoahoc', \App\Http\Controllers\KhoahocController::class)->middleware('auth');
    Route::get('themkhoahoc', [\App\Http\Controllers\KhoahocController::class, 'create']);
    Route::get('capnhatkhoahoc/{id}', [\App\Http\Controllers\KhoahocController::class, 'edit'])->name('capnhatkhoahoc');
    Route::delete('khoahoc/{id}', [\App\Http\Controllers\KhoahocController::class, 'destroy'])->name('xoakhoahoc');

    // Chi tiết khóa học
    Route::resource('chitietkhoahoc', \App\Http\Controllers\ChitietkhoahocController::class)->middleware('auth');
    Route::get('themchitietkhoahoc', [\App\Http\Controllers\ChitietkhoahocController::class, 'create']);
    Route::get('hienthichitietkhoahoc/{id}', [\App\Http\Controllers\ChitietkhoahocController::class, 'show'])->name('hienthichitietkhoahoc');
    Route::get('capnhatchitietkhoahoc/{id}', [\App\Http\Controllers\ChitietkhoahocController::class, 'edit'])->name('capnhatchitietkhoahoc');
    Route::delete('chitietkhoahoc/{id}', [\App\Http\Controllers\ChitietkhoahocController::class, 'destroy'])->name('xoachitietkhoahoc');

    // Danh sách lớp
    Route::resource('danhsachlop', \App\Http\Controllers\DanhsachlopController::class)->middleware('auth');
    Route::get('themdanhsachlop', [\App\Http\Controllers\DanhsachlopController::class, 'create']);
    Route::get('capnhatdanhsachlop/{id}', [\App\Http\Controllers\DanhsachlopController::class, 'edit'])->name('capnhatdanhsachlop');
    Route::delete('danhsachlop/{id}', [\App\Http\Controllers\DanhsachlopController::class, 'destroy'])->name('xoadanhsachlop');
    Route::post('import_csv', [\App\Http\Controllers\DanhsachlopController::class, 'import_csv'])->name('import_csv');
    Route::get('/export-dsl', [\App\Http\Controllers\DanhsachlopController::class, 'exportDSL']);
    Route::get('chitietdssvcdk/{id}', [\App\Http\Controllers\DanhsachlopController::class, 'chitietdssvcdk'])->name('chitietdssvcdk');
    Route::get('sinhvienchuadangky', [\App\Http\Controllers\DanhsachlopController::class, 'sinhvienchuadangky'])->name('sinhvienchuadangky');

    // Sinh viên
    Route::resource('sinhvien', \App\Http\Controllers\SinhVienController::class)->middleware('auth');
    Route::get('search-sinhvien', [\App\Http\Controllers\SinhVienController::class, 'search']);
    Route::get('themsinhvien', [\App\Http\Controllers\SinhVienController::class, 'create']);
    Route::get('capnhatsinhvien/{id}', [\App\Http\Controllers\SinhVienController::class, 'edit'])->name('capnhatsinhvien');
    Route::delete('sinhvien/{id}', [\App\Http\Controllers\SinhVienController::class, 'destroy'])->name('xoasinhvien');
    Route::post('_import_csv', [\App\Http\Controllers\SinhVienController::class, '_import_csv'])->name('_import_csv');
    Route::get('/export-sv', [\App\Http\Controllers\SinhVienController::class, 'exportSV']);


    // Kết quả
    Route::resource('ketqua', \App\Http\Controllers\KetQuaController::class)->middleware('auth');
    Route::get('themketqua', [\App\Http\Controllers\KetQuaController::class, 'create']);
    Route::get('capnhatketqua/{id}', [\App\Http\Controllers\KetQuaController::class, 'edit'])->name('capnhatketqua');
    Route::delete('ketqua/{id}', [\App\Http\Controllers\KetQuaController::class, 'destroy'])->name('xoaketqua');
});
// Auth User
Route::get('login', function () {
    if (Auth::check()) {
        return redirect('/lichdayhoc');
    }
    return view('login');
})->name('login');
Route::post('login', '\App\Http\Controllers\UserController@login')->name('login');

Route::get('profile', [\App\Http\Controllers\UserController::class, 'profile']);
Route::get('logout', [\App\Http\Controllers\UserController::class, 'logout']);
Route::get('lichdayhoc', [\App\Http\Controllers\HomeController::class, 'lichdayhoc']);
Route::get('/searchKH', [\App\Http\Controllers\HomeController::class, 'searchKH'])->name('searchKH');
Route::get('/searchLH', [\App\Http\Controllers\HomeController::class, 'searchLH'])->name('searchLH');
Route::resource('/', \App\Http\Controllers\HomeController::class);
Route::get('chitiet/{id}', [\App\Http\Controllers\HomeController::class, 'chitiet'])->name('chitiet'); // Route
Route::get('lichhoc', [\App\Http\Controllers\HomeController::class, 'lichhoc']);
Route::get('tracuudiem', [\App\Http\Controllers\HomeController::class, 'tracuudiem'])->name('tracuudiem');
Route::post('/sendotp', [\App\Http\Controllers\OtpController::class, 'sendOtp']);
Route::post('/verifyotp', [\App\Http\Controllers\OtpController::class, 'verifyOtp'])->name('verifyotp');
// Route::get('chitietdanhsachlop/{id}', [\App\Http\Controllers\HomeController::class, 'chitietdanhsachlop'])->name('chitietdanhsachlop');
Route::get('chitietdssv/{id}', [\App\Http\Controllers\HomeController::class, 'chitietdssv'])->name('chitietdssv');
