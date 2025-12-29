<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\SinhVien;
use App\Models\ThoiKhoaBieu;
use App\Models\LopHoc;
use App\Models\Diem;


class SinhVienPanelController extends Controller
{
    private function getLoggedSinhVien()
    {
        $userId = Auth::id();
        return SinhVien::where('NguoiDungID', $userId)->with('lopHoc')->first();
    }

    public function index()
    {
        $sv = $this->getLoggedSinhVien();
        if (!$sv) return redirect('/')->with('error', 'Tài khoản chưa liên kết hồ sơ sinh viên!');

        return view('sinhvien.dashboard', compact('sv'));
    }

    public function xemLichHoc()
    {
        $sv = $this->getLoggedSinhVien();
        if (!$sv) return back();

        $dsTKB = ThoiKhoaBieu::where('LopID', $sv->Lop)
            ->with(['monHoc', 'giangVien'])
            ->orderByRaw("FIELD(ThuTrongTuan, 'Hai', 'Ba', 'Tu', 'Nam', 'Sau', 'Bay', 'CN')")
            ->orderBy('GioBatDau')
            ->get();

        return view('sinhvien.lichhoc', compact('dsTKB', 'sv'));
    }

    public function xemBangDiem()
    {
        $sv = $this->getLoggedSinhVien();
        if (!$sv) return back();
        $monCoDiemIDs = Diem::where('SinhVienID', $sv->id)->pluck('MonHocID')->toArray();

        $monTrongTKB_IDs = ThoiKhoaBieu::where('LopID', $sv->Lop)->pluck('MonHocID')->toArray();

        $allMonHocIDs = array_unique(array_merge($monCoDiemIDs, $monTrongTKB_IDs));

        $dsMonHoc = \App\Models\MonHoc::whereIn('MonHocID', $allMonHocIDs)->get();

        foreach ($dsMonHoc as $mon) {
            $diem = Diem::where('SinhVienID', $sv->id)
                ->where('MonHocID', $mon->MonHocID)
                ->first();
            $mon->diem_so = $diem ? $diem->DiemSo : null;
        }

        return view('sinhvien.bangdiem', compact('dsMonHoc', 'sv'));
    }

    public function xemLopCuaToi()
    {
        $sv = $this->getLoggedSinhVien();
        if (!$sv) return back();

        $lop = LopHoc::find($sv->Lop);
        $dsSV = SinhVien::where('Lop', $sv->Lop)->orderBy('HoTen')->get();

        return view('sinhvien.lop_cuatoi', compact('lop', 'dsSV', 'sv'));
    }

    public function xemHoSo() {
        $sv = $this->getLoggedSinhVien();
        $user = Auth::user(); 
        return view('sinhvien.hoso', compact('sv', 'user'));
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
