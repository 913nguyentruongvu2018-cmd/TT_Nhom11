<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DangNhapController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DiemController;
use App\Http\Controllers\MonHocController;
use App\Http\Controllers\SinhVienController;
use App\Http\Controllers\GiangVienController;
use App\Http\Controllers\LopHocController;
use App\Http\Controllers\ThoiKhoaBieuController;
use App\Http\Controllers\NguoiDungController;
use App\Http\Controllers\ChuyenNganhController;


Route::get('/dang-nhap', [DangNhapController::class, 'hienForm'])->name('login');
Route::post('/dang-nhap', [DangNhapController::class, 'xuLyDangNhap']);
Route::post('/dang-xuat', [DangNhapController::class, 'dangXuat']);


Route::middleware(['auth'])->group(function () {

    Route::get('/admin/dashboard', [AdminController::class, 'index']);


    Route::get('/admin/diem', [DiemController::class, 'index'])->name('admin.diem.index');
    Route::get('/admin/diem/nhap', [DiemController::class, 'hienFormNhap'])->name('admin.diem.nhap');
    Route::post('/admin/diem/nhap', [DiemController::class, 'luuDiem']);
    Route::get('/admin/diem/chi-tiet/{sv_id}', [DiemController::class, 'xemChiTiet'])->name('admin.diem.chitiet');
    Route::get('/admin/diem/sua/{id}', [DiemController::class, 'hienFormSua'])->name('admin.diem.sua');
    Route::post('/admin/diem/sua/{id}', [DiemController::class, 'capNhat']);
    Route::get('/admin/diem/xoa/{id}', [DiemController::class, 'xoa']);


    Route::get('/admin/mon-hoc', [MonHocController::class, 'index']);
    Route::get('/admin/mon-hoc/them', [MonHocController::class, 'hienFormThem']);
    Route::post('/admin/mon-hoc/them', [MonHocController::class, 'luuMonHoc']);
    Route::get('/admin/mon-hoc/sua/{id}', [MonHocController::class, 'hienFormSua']);
    Route::post('/admin/mon-hoc/sua/{id}', [MonHocController::class, 'capNhat']);
    Route::get('/admin/mon-hoc/xoa/{id}', [MonHocController::class, 'xoa']);

    Route::get('/admin/sinh-vien', [SinhVienController::class, 'index']);
    Route::get('/admin/sinh-vien/them', [SinhVienController::class, 'hienFormThem']);
    Route::post('/admin/sinh-vien/them', [SinhVienController::class, 'luuSinhVien']);
    Route::get('/admin/sinh-vien/sua/{id}', [SinhVienController::class, 'hienFormSua']);
    Route::post('/admin/sinh-vien/sua/{id}', [SinhVienController::class, 'capNhat']);
    Route::get('/admin/sinh-vien/xoa/{id}', [SinhVienController::class, 'xoa']);

    Route::get('/admin/giang-vien', [GiangVienController::class, 'index']);
    Route::get('/admin/giang-vien/them', [GiangVienController::class, 'hienFormThem']);
    Route::post('/admin/giang-vien/them', [GiangVienController::class, 'luuGiangVien']);
    Route::get('/admin/giang-vien/sua/{id}', [GiangVienController::class, 'hienFormSua']);
    Route::post('/admin/giang-vien/sua/{id}', [GiangVienController::class, 'capNhat']);
    Route::get('/admin/giang-vien/xoa/{id}', [GiangVienController::class, 'xoa']);

    Route::get('/admin/lop-hoc', [LopHocController::class, 'index']);
    Route::get('/admin/lop-hoc/them', [LopHocController::class, 'hienFormThem']);
    Route::post('/admin/lop-hoc/them', [LopHocController::class, 'luuLopHoc']);
    Route::get('/admin/lop-hoc/sua/{id}', [LopHocController::class, 'hienFormSua']);
    Route::post('/admin/lop-hoc/sua/{id}', [LopHocController::class, 'capNhat']);
    Route::get('/admin/lop-hoc/xoa/{id}', [LopHocController::class, 'xoa']);

    Route::get('/admin/tkb', [ThoiKhoaBieuController::class, 'index']);
    Route::get('/admin/tkb/them', [ThoiKhoaBieuController::class, 'hienFormThem']);
    Route::post('/admin/tkb/them', [ThoiKhoaBieuController::class, 'luuTKB']);
    Route::get('/admin/tkb/xoa/{id}', [ThoiKhoaBieuController::class, 'xoa']);
    Route::get('/admin/tkb/sua/{id}', [ThoiKhoaBieuController::class, 'hienFormSua']);
    Route::post('/admin/tkb/sua/{id}', [ThoiKhoaBieuController::class, 'capNhat']);

    Route::get('/admin/nguoi-dung', [NguoiDungController::class, 'index']);
    Route::get('/admin/nguoi-dung/them', [NguoiDungController::class, 'hienFormThem']);
    Route::post('/admin/nguoi-dung/them', [NguoiDungController::class, 'luuNguoiDung']);
    Route::get('/admin/nguoi-dung/sua/{id}', [NguoiDungController::class, 'hienFormSua']);
    Route::post('/admin/nguoi-dung/sua/{id}', [NguoiDungController::class, 'capNhat']);
    Route::get('/admin/nguoi-dung/xoa/{id}', [NguoiDungController::class, 'xoa']);

    Route::get('/admin/chuyen-nganh', [ChuyenNganhController::class, 'index']);
    Route::get('/admin/chuyen-nganh/them', [ChuyenNganhController::class, 'hienFormThem']);
    Route::post('/admin/chuyen-nganh/them', [ChuyenNganhController::class, 'luuChuyenNganh']);
    Route::get('/admin/chuyen-nganh/sua/{id}', [ChuyenNganhController::class, 'hienFormSua']);
    Route::post('/admin/chuyen-nganh/sua/{id}', [ChuyenNganhController::class, 'capNhat']);
    Route::get('/admin/chuyen-nganh/xoa/{id}', [ChuyenNganhController::class, 'xoa']);


    Route::get('/', function () {
        return redirect('/dang-nhap');
    });
});
