<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SinhVien;
use App\Models\GiangVien;
use App\Models\MonHoc;
use App\Models\LopHoc;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index() {
        $soSinhVien = SinhVien::count();
        $soGiangVien = GiangVien::count();
        $soMonHoc = MonHoc::count();
        $soLopHoc = LopHoc::count();

        return view('admin.dashboard', [
            'soSV' => $soSinhVien,
            'soGV' => $soGiangVien,
            'soMon' => $soMonHoc,
            'soLop' => $soLopHoc
        ]);
    }
    //update
}