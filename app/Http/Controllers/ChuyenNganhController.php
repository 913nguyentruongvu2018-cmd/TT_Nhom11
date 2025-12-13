<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ChuyenNganh; // Nhớ import Model

class ChuyenNganhController extends Controller
{
    // 1. Xem danh sách chuyên ngành
    public function index()
    {
        $dsCN = ChuyenNganh::all();
        return view('admin.chuyennganh.index', compact('dsCN'));
    }

    // 2. Hiển thị form thêm mới
    public function hienFormThem()
    {
        return view('admin.chuyennganh.them');
    }

    // 3. Xử lý lưu chuyên ngành
    public function luuChuyenNganh(Request $request)
    {
        // Validate đơn giản
        $request->validate([
            'MaCN' => 'required|unique:chuyennganh,MaCN', // Mã không được trùng
            'TenCN' => 'required'
        ], [
            'MaCN.unique' => 'Mã chuyên ngành này đã tồn tại!',
            'MaCN.required' => 'Vui lòng nhập mã chuyên ngành.',
            'TenCN.required' => 'Vui lòng nhập tên chuyên ngành.'
        ]);

        // Lưu vào DB (Không có timestamps như bạn yêu cầu)
        ChuyenNganh::create([
            'MaCN' => $request->MaCN,
            'TenCN' => $request->TenCN
        ]);

        return redirect('/admin/chuyen-nganh')->with('success', 'Thêm chuyên ngành thành công!');
    }

    // 4. Hiển thị form sửa
    public function hienFormSua($id)
    {
        $cn = ChuyenNganh::find($id);
        if (!$cn) return redirect('/admin/chuyen-nganh')->with('error', 'Không tìm thấy!');
        
        return view('admin.chuyennganh.sua', compact('cn'));
    }

    // 5. Xử lý cập nhật
    public function capNhat(Request $request, $id)
    {
        $cn = ChuyenNganh::find($id);
        
        // Cập nhật tên (thường Mã ngành ít khi cho sửa để tránh lỗi dữ liệu cũ)
        $cn->update([
            'TenCN' => $request->TenCN
        ]);

        return redirect('/admin/chuyen-nganh')->with('success', 'Cập nhật thành công!');
    }

    // 6. Xóa chuyên ngành
    public function xoa($id)
    {
        try {
            ChuyenNganh::destroy($id);
            return redirect()->back()->with('success', 'Đã xóa chuyên ngành!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Lỗi: Có thể ngành này đang được dùng cho Lớp/GV khác.');
        }
    }
}