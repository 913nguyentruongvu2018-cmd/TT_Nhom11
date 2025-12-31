<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\GiangVien;
use App\Models\ThoiKhoaBieu;
use App\Models\LopHoc;
use App\Models\SinhVien;
use App\Models\NguoiDung;

class GiangVienPanelController extends Controller
{
    private function getLoggedGiangVien()
    {
        $userId = Auth::id();

        return GiangVien::where('NguoiDungID', $userId)->first();
    }

    public function index()
    {
        $gv = $this->getLoggedGiangVien();
        if (!$gv) return redirect('/')->with('error', 'Tài khoản này chưa liên kết hồ sơ giảng viên!');

        return view('giangvien.dashboard', compact('gv'));
    }

    public function xemLichDay()
    {
        $gv = $this->getLoggedGiangVien();
        if (!$gv) return back();

        $dsTKB = ThoiKhoaBieu::where('GiangVienID', $gv->GiangVienID)
            ->with(['lopHoc', 'monHoc'])
            ->orderByRaw("FIELD(ThuTrongTuan, 'Hai', 'Ba', 'Tu', 'Nam', 'Sau', 'Bay', 'CN')")
            ->orderBy('GioBatDau')
            ->get();

        return view('giangvien.lichday', compact('dsTKB', 'gv'));
    }

    public function xemLopChuNhiem()
    {
        $gv = $this->getLoggedGiangVien();
        if (!$gv) return back();

        $lop = LopHoc::where('GiangVienID', $gv->GiangVienID)->first();

        $dsSV = $lop ? SinhVien::where('LopID', $lop->LopID)->get() : collect([]);

        return view('giangvien.lop_chunhiem', compact('lop', 'dsSV', 'gv'));
    }
    public function xemChiTietDiem($svID)
    {
        $gv = $this->getLoggedGiangVien();

        $sv = SinhVien::with(['diems.monHoc', 'lopHoc'])->find($svID);

        if (!$sv) return back()->with('error', 'Không tìm thấy sinh viên!');

        return view('giangvien.chitiet_diem_sv', compact('sv', 'gv'));
    }
    public function xemDiemLop($idLop)
    {
        $gv = $this->getLoggedGiangVien();

        $lop = LopHoc::where('LopID', $idLop)->where('GiangVienID', $gv->GiangVienID)->first();

        if (!$lop) {
            return redirect('/giang-vien/lop-chu-nhiem')->with('error', 'Bạn không phụ trách lớp này!');
        }

        $dsSV = SinhVien::where('LopID', $idLop)->with('diems.monHoc')->get();

        return view('giangvien.bangdiem', compact('lop', 'dsSV'));
    }

    public function xemLopGiangDay()
    {
        $gv = $this->getLoggedGiangVien();
        if (!$gv) return back();

        $dsLopDay = ThoiKhoaBieu::where('GiangVienID', $gv->GiangVienID)
            ->with(['lopHoc', 'monHoc'])
            ->get()
            ->unique(function ($item) {
                return $item->LopID . '-' . $item->MonHocID;
            });

        return view('giangvien.lop_giangday', compact('dsLopDay', 'gv'));
    }
    public function xemDanhSachLopDay($lopID, $monHocID)
    {
        $gv = $this->getLoggedGiangVien();

        $check = ThoiKhoaBieu::where('GiangVienID', $gv->GiangVienID)
            ->where('LopID', $lopID)
            ->where('MonHocID', $monHocID)
            ->exists();

        if (!$check) {
            return back()->with('error', 'Bạn không được phân công dạy lớp này môn này!');
        }

        $lop = LopHoc::find($lopID);
        $mon = \App\Models\MonHoc::find($monHocID);

        $dsSV = SinhVien::where('LopID', $lopID)->get();

        foreach ($dsSV as $sv) {
            $diem = \App\Models\Diem::where('SinhVienID', $sv->id)
                ->where('MonHocID', $monHocID)
                ->first();
            $sv->diem_chi_tiet = $diem;
        }

        return view('giangvien.xem_lop_day', compact('lop', 'mon', 'dsSV'));
    }
    public function hoso()
    {

        $gv = $this->getLoggedGiangVien();
        $user = Auth::user(); 

        return view('giangvien.hoso', compact('gv', 'user'));
    }
    public function doiMatKhau(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'password_old' => 'required',
            'password_new' => 'required|min:6|confirmed'
        ],[
            'password_old.required' => 'Vui lòng nhập mật khẩu hiện tại.',
            'password_new.required' => 'Vui lòng nhập mật khẩu mới.',
            'password_new.min' => 'Mật khẩu mới phải có ít nhất :min ký tự.',
            'password_new.confirmed' => 'Xác nhận mật khẩu mới không khớp.',
            
        ]);
    
        if ($user->MatKhau === $request->password_old) {
        } 
        elseif (!Hash::check($request->password_old, $user->MatKhau)) {
            return back()->withErrors(['password_old' => 'Mật khẩu hiện tại không đúng!']);
        }
        $user->MatKhau = Hash::make($request->password_new);
        $user->save();

        return back()->with('success', 'Đổi mật khẩu thành công!');
    }
}
