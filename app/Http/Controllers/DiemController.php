<?php
//update
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Diem;
use App\Models\SinhVien;
use App\Models\MonHoc;
use Illuminate\Support\Facades\Auth;

class DiemController extends Controller
{
    // 1. Hiện form nhập điểm
    public function hienFormNhap() {
        $dsSinhVien = SinhVien::all();
        $dsMonHoc = MonHoc::all();
        
        return view('admin.diem.nhap', [
            'sinhvien' => $dsSinhVien,
            'monhoc' => $dsMonHoc
        ]);
    }

    // 2. Lưu điểm vào CSDL
    public function luuDiem(Request $request) {

        $request->validate([
            'SinhVienID' => 'required',
            'MonHocID' => 'required',
            'DiemSo' => 'required|numeric|min:0|max:10',
        ]);

        $diemCu = Diem::where('SinhVienID', $request->SinhVienID)
                      ->where('MonHocID', $request->MonHocID)
                      ->first();

        if ($diemCu) {
            $diemCu->update(['DiemSo' => $request->DiemSo]);
            $thongBao = 'Đã cập nhật điểm thành công!';
        } else {
            Diem::create([
                'SinhVienID' => $request->SinhVienID,
                'MonHocID' => $request->MonHocID,
                'DiemSo' => $request->DiemSo,
                'HocKy' => 'HK1' 
            ]);
            $thongBao = 'Đã nhập điểm mới thành công!';
        }

        return redirect('/admin/diem/nhap')->with('success', $thongBao);
    }
    // 3. Sinh viên xem điểm của chính mình
    public function xemDiemCaNhan() {
       $user = Auth::user();

        $sinhVien = SinhVien::where('NguoiDungID', $user->id)->first();

        if (!$sinhVien) {
            return redirect('/')->withErrors(['msg' => 'Bạn không có hồ sơ sinh viên!']);
        }

        $bangDiem = Diem::where('SinhVienID', $sinhVien->id)
                        ->with('monHoc') 
                        ->get();

        return view('sinhvien.diem', ['bangDiem' => $bangDiem]);
    }
}