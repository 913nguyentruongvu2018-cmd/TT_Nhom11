<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SinhVien;
use App\Models\NguoiDung;
use App\Models\LopHoc;
use Illuminate\Support\Facades\DB;

class SinhVienController extends Controller
{

    public function index(Request $request)
    {
        $query = SinhVien::with('lopHoc');

        if ($request->has('chua_co_tk')) {
            $query->whereNull('NguoiDungID');
        }
        if ($request->filled('lop_id')) {
            $query->where('Lop', $request->lop_id);
        }
        if ($request->filled('tu_khoa')) {
            $query->where(function ($q) use ($request) {
                $q->where('HoTen', 'LIKE', '%' . $request->tu_khoa . '%')
                    ->orWhere('MaSV', 'LIKE', '%' . $request->tu_khoa . '%');
            });
        }

        if ($request->sap_xep == 'az') {
            $query->orderByRaw("SUBSTRING_INDEX(HoTen, ' ', -1) ASC");
        } elseif ($request->sap_xep == 'za') {
            $query->orderByRaw("SUBSTRING_INDEX(HoTen, ' ', -1) DESC");
        } else {
            $query->orderBy('MaSV', 'ASC');
        }

        $dsSinhVien = $query->paginate(50);
        $dsLop = LopHoc::all();

        return view('admin.sinhvien.index', ['dsSinhVien' => $dsSinhVien, 'dsLop' => $dsLop]);
    }


    public function hienFormThem()
    {
        $dsLop = LopHoc::all();
        return view('admin.sinhvien.them', compact('dsLop'));
    }


    public function luuSinhVien(Request $request)
    {
        $request->validate([
            'MaSV' => ['required', 'unique:sinhvien,MaSV', 'regex:/^DH522\d{5}$/'],
            'HoTen' => 'required',
            'Lop' => 'required',
        ], [
            'MaSV.regex' => 'Mã SV phải bắt đầu bằng DH522 và có 5 số phía sau.',
            'MaSV.unique' => 'Mã sinh viên này đã tồn tại.',
            'Lop.required' => 'Vui lòng chọn lớp.'
        ]);

        SinhVien::create([
            'MaSV' => $request->MaSV,
            'HoTen' => $request->HoTen,
            'NgaySinh' => $request->NgaySinh,
            'Lop' => $request->Lop,
            'NguoiDungID' => null
        ]);

        return redirect('/admin/sinh-vien')->with('success', 'Đã thêm hồ sơ sinh viên (Chưa có tài khoản)!');
    }


    public function hienFormSua($id)
    {

        $sv = SinhVien::where('id', $id)->first();
        if (!$sv) $sv = SinhVien::where('MaSV', $id)->first();

        if (!$sv) return redirect('/admin/sinh-vien')->with('error', 'Không tìm thấy sinh viên!');

        $dsLop = LopHoc::all();
        return view('admin.sinhvien.sua', compact('sv', 'dsLop'));
    }


    public function capNhat(Request $request, $id)
    {

        $sinhvien = SinhVien::where('id', $id)->first();
        if (!$sinhvien) $sinhvien = SinhVien::where('MaSV', $id)->first();

        if (!$sinhvien) return redirect('/admin/sinh-vien')->with('error', 'Lỗi: Không tìm thấy sinh viên.');

        $request->validate([
            'HoTen' => 'required',
            'Lop' => 'required',
        ]);


        $sinhvien->update([
            'HoTen' => $request->HoTen,
            'NgaySinh' => $request->NgaySinh,
            'Lop' => $request->Lop,
        ]);


        if ($sinhvien->NguoiDungID) {
            $user = NguoiDung::find($sinhvien->NguoiDungID);
            if ($user) {
                $user->update(['HoTen' => $request->HoTen]);
            }
        }

        return redirect('/admin/sinh-vien')->with('success', 'Cập nhật thông tin thành công!');
    }


    public function xoa($id)
    {
        $sv = SinhVien::where('id', $id)->orWhere('MaSV', $id)->first();
        if ($sv) {


            $sv->delete();
        }
        return back()->with('success', 'Đã xóa sinh viên.');
    }
}
