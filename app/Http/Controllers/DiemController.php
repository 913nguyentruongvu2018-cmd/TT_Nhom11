<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Diem;
use App\Models\SinhVien;
use App\Models\MonHoc;
use App\Models\LopHoc;
use Illuminate\Support\Facades\Auth;

class DiemController extends Controller
{
    //DANH SÁCH & QUẢN LÝ 
    public function index(Request $request)
    {
        $query = Diem::with(['sinhVien', 'monHoc']);
        if ($request->filled('sv_id')) {
            $query->where('SinhVienID', $request->sv_id);
        }
        if ($request->filled('mh_id')) {
            $query->where('MonHocID', $request->mh_id);
        }
        $dsDiem = $query->orderBy('DiemID', 'desc')->paginate(20);

    
        $dsSinhVien = SinhVien::all();
        $dsMonHoc = MonHoc::all();

        return view('admin.diem.index', [
            'dsDiem' => $dsDiem,
            'dsSinhVien' => $dsSinhVien,
            'dsMonHoc' => $dsMonHoc
        ]);
    }

    // NHẬP ĐIỂM
    public function hienFormNhap() {
        
        $dsLop = LopHoc::all();
        $dsMonHoc = MonHoc::all();
        $dsSinhVien = SinhVien::all(); 
        
        return view('admin.diem.nhap', [
            'dsLop' => $dsLop,
            'dsMonHoc' => $dsMonHoc,
            'dsSinhVien' => $dsSinhVien
        ]);
    }

    public function luuDiem(Request $request) {
        $request->validate([
            'SinhVienID' => 'required',
            'MonHocID' => 'required',
            'DiemSo' => 'required|numeric|min:0|max:10',
            'HocKy' => 'required'
        ]);

        $diemCu = Diem::where('SinhVienID', $request->SinhVienID)
                      ->where('MonHocID', $request->MonHocID)
                      ->first();

        if ($diemCu) {
            
            $diemCu->update([
                'DiemSo' => $request->DiemSo,
                'HocKy' => $request->HocKy 
            ]);
            $thongBao = 'Đã cập nhật điểm và học kỳ!';
        } else {
            Diem::create([
                'SinhVienID' => $request->SinhVienID,
                'MonHocID' => $request->MonHocID,
                'DiemSo' => $request->DiemSo,
                'HocKy' => $request->HocKy
            ]);
            $thongBao = 'Đã nhập điểm mới thành công!';
        }

        return redirect('/admin/diem')->with('success', $thongBao); 
    }

    //SỬA ĐIỂM 
    public function hienFormSua($id) {
        $diem = Diem::findOrFail($id);
        return view('admin.diem.sua', ['diem' => $diem]);
    }

    public function capNhat(Request $request, $id) {
        $request->validate([
            'DiemSo' => 'required|numeric|min:0|max:10',
        ]);

        $diem = Diem::findOrFail($id);
        $diem->update(['DiemSo' => $request->DiemSo]);

        return redirect('/admin/diem')->with('success', 'Đã cập nhật điểm số thành công!');
    }

    //XÓA ĐIỂM
    public function xoa($id) {
        Diem::destroy($id);
        return redirect('/admin/diem')->with('success', 'Đã xóa bản ghi điểm.');
    }

    // SINH VIÊN XEM ĐIỂM 
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