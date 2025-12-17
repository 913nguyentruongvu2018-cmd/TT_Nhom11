<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NguoiDung;
use App\Models\SinhVien;
use App\Models\GiangVien;
use Illuminate\Support\Facades\Hash;

class NguoiDungController extends Controller
{
    
    public function index(Request $request) {
        $query = NguoiDung::query();

        if ($request->filled('tu_khoa')) {
            $query->where(function($q) use ($request) {
                $q->where('HoTen', 'LIKE', '%' . $request->tu_khoa . '%')
                  ->orWhere('Email', 'LIKE', '%' . $request->tu_khoa . '%')
                  ->orWhere('TenDangNhap', 'LIKE', '%' . $request->tu_khoa . '%');
            });
        }
        if ($request->filled('vai_tro')) {
            $query->where('VaiTro', $request->vai_tro);
        }

        $dsNguoiDung = $query->orderBy('id', 'desc')->paginate(10);
        return view('admin.nguoidung.index', ['dsNguoiDung' => $dsNguoiDung]);
    }

    
    public function hienFormThem() {
        $svChuaCoTK = SinhVien::whereNull('NguoiDungID')->get();
        $gvChuaCoTK = GiangVien::whereNull('NguoiDungID')->get();
        
        return view('admin.nguoidung.them', [
            'svChuaCoTK' => $svChuaCoTK,
            'gvChuaCoTK' => $gvChuaCoTK
        ]);
    }

    
    public function luuNguoiDung(Request $request) {
        $request->validate([
            'Email'       => 'required|email|unique:nguoidung,Email',
            'MatKhau'     => 'required|min:6',
            'VaiTro'      => 'required',
        ]);

        $tenDangNhap = $request->TenDangNhap; 
        $hoTen = $request->HoTen;

        
        if ($request->VaiTro == 'SinhVien') {
            $request->validate(['SinhVienID' => 'required']);
            
            $sv = SinhVien::where('id', $request->SinhVienID)->first(); 
            if (!$sv) return back()->withErrors(['SinhVienID' => 'Lỗi ID sinh viên.']);
            
            $tenDangNhap = $sv->MaSV; 
            $hoTen = $sv->HoTen;
        } 
        elseif ($request->VaiTro == 'GiangVien') {
            $request->validate(['GiangVienID' => 'required']);
            
            $gv = GiangVien::where('GiangVienID', $request->GiangVienID)->first();
            if (!$gv) return back()->withErrors(['GiangVienID' => 'Lỗi ID giảng viên.']);

            $tenDangNhap = $gv->MaGV;
            $hoTen = $gv->HoTen;
        }

        
        if (NguoiDung::where('TenDangNhap', $tenDangNhap)->exists()) {
            return back()->withErrors(['TenDangNhap' => "Tài khoản $tenDangNhap đã tồn tại."]);
        }

        
        $user = NguoiDung::create([
            'TenDangNhap' => $tenDangNhap,
            'Email'       => $request->Email,
            'MatKhau'     => Hash::make($request->MatKhau),
            'HoTen'       => $hoTen,
            'VaiTro'      => $request->VaiTro
        ]);

        
        if ($request->VaiTro == 'SinhVien') {
            SinhVien::where('id', $request->SinhVienID)->update(['NguoiDungID' => $user->id]);
        } elseif ($request->VaiTro == 'GiangVien') {
            GiangVien::where('GiangVienID', $request->GiangVienID)->update(['NguoiDungID' => $user->id]);
        }

        return redirect('/admin/nguoi-dung')->with('success', "Đã cấp tài khoản thành công!");
    }

    
    public function hienFormSua($id) {
        $user = NguoiDung::find($id);
        return view('admin.nguoidung.sua', ['user' => $user]);
    }

    
    public function capNhat(Request $request, $id) {
        $request->validate([
            'Email' => 'required|email|unique:nguoidung,Email,'.$id,
        ]);

        $user = NguoiDung::find($id);
        
        
        
        $data = ['Email' => $request->Email];

        if ($request->filled('MatKhau')) {
            $data['MatKhau'] = Hash::make($request->MatKhau);
        }

        
        if ($user->VaiTro == 'Admin') {
            $data['HoTen'] = $request->HoTen;
        }

        $user->update($data);
        return redirect('/admin/nguoi-dung')->with('success', 'Cập nhật tài khoản thành công!');
    }

    
    public function xoa($id) {
        if (auth()->id() == $id) return back()->with('error', 'Không thể xóa chính mình!');
        
        
        SinhVien::where('NguoiDungID', $id)->update(['NguoiDungID' => null]);
        GiangVien::where('NguoiDungID', $id)->update(['NguoiDungID' => null]);

        NguoiDung::destroy($id);
        return redirect('/admin/nguoi-dung')->with('success', 'Đã xóa tài khoản.');
    }
}