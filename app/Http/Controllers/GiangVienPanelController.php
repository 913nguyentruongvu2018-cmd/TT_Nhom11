<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\GiangVien;
use App\Models\ThoiKhoaBieu;
use App\Models\LopHoc;
use App\Models\SinhVien;

class GiangVienPanelController extends Controller
{
    private function getLoggedGiangVien() {
        $userId = Auth::id(); 
    
    return GiangVien::where('NguoiDungID', $userId)->first();
    }

    public function index() {
        $gv = $this->getLoggedGiangVien();
        if (!$gv) return redirect('/')->with('error', 'Tài khoản này chưa liên kết hồ sơ giảng viên!');

        return view('giangvien.dashboard', compact('gv'));
    }

    public function xemLichDay() {
        $gv = $this->getLoggedGiangVien();
        if (!$gv) return back();

        $dsTKB = ThoiKhoaBieu::where('GiangVienID', $gv->GiangVienID)
                    ->with(['lopHoc', 'monHoc'])
                    ->orderByRaw("FIELD(ThuTrongTuan, 'Hai', 'Ba', 'Tu', 'Nam', 'Sau', 'Bay', 'CN')")
                    ->orderBy('GioBatDau')
                    ->get();

        return view('giangvien.lichday', compact('dsTKB','gv'));
    }
}