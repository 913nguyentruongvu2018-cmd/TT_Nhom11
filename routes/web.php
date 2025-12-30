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
use App\Http\Controllers\GiangVienPanelController;
use App\Http\Controllers\SinhVienPanelController;
use App\Http\Controllers\QuenMatKhauController; 


Route::get('/dang-nhap', [DangNhapController::class, 'hienForm'])->name('login');
Route::post('/dang-nhap', [DangNhapController::class, 'xuLyDangNhap']);
Route::post('/dang-xuat', [DangNhapController::class, 'dangXuat']);
//quenmk
Route::get('/quen-mat-khau', [QuenMatKhauController::class, 'hienFormQuenMK']);
Route::post('/quen-mat-khau', [QuenMatKhauController::class, 'guiMaXacNhan']);
Route::get('/nhap-ma', [QuenMatKhauController::class, 'hienFormNhapMa']);
Route::post('/xac-nhan-doi-pass', [QuenMatKhauController::class, 'xacNhanDoiPass']);

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


});
Route::middleware(['auth'])->prefix('giang-vien')->group(function () {
    Route::get('/dashboard', [GiangVienPanelController::class, 'index']);
    Route::get('/lich-day', [GiangVienPanelController::class, 'xemLichDay']);
    Route::get('/lop-chu-nhiem', [GiangVienPanelController::class, 'xemLopChuNhiem']);
    Route::get('/lop-chu-nhiem/diem/{id}', [GiangVienPanelController::class, 'xemDiemLop']);
    Route::get('/lop-giang-day', [GiangVienPanelController::class, 'xemLopGiangDay']);
    Route::get('/xem-lop-day/{lop_id}/{mon_hoc_id}', [GiangVienPanelController::class, 'xemDanhSachLopDay']);
    Route::get('/xem-diem-sinh-vien/{id}', [GiangVienPanelController::class, 'xemChiTietDiem']);
    Route::get('/ho-so', [GiangVienPanelController::class, 'hoSo']);
    Route::post('/doi-mat-khau', [GiangVienPanelController::class, 'doiMatKhau']);
});
Route::prefix('sinh-vien')->middleware(['auth'])->group(function () {
    Route::get('/dashboard', [SinhVienPanelController::class, 'index'])->name('sv.dashboard');
    Route::get('/lich-hoc', [SinhVienPanelController::class, 'xemLichHoc'])->name('sv.lichhoc');
    Route::get('/bang-diem', [SinhVienPanelController::class, 'xemBangDiem'])->name('sv.bangdiem');
    Route::get('/lop-cua-toi', [SinhVienPanelController::class, 'xemLopCuaToi'])->name('sv.lopcuatoi');
    Route::get('/ho-so', [SinhVienPanelController::class, 'xemHoSo'])->name('sv.hoso');
    Route::post('/doi-mat-khau', [SinhVienPanelController::class, 'doiMatKhau'])->name('sv.doimatkhau');
});
