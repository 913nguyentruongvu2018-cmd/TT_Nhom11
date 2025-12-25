<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ChuyenNganh; 

class ChuyenNganhController extends Controller
{
    
    public function index()
    {
        $dsCN = ChuyenNganh::all();
        return view('admin.chuyennganh.index', compact('dsCN'));
    }

    
    public function hienFormThem()
    {
        return view('admin.chuyennganh.them');
    }

    
    public function luuChuyenNganh(Request $request)
    {
        
        $request->validate([
            'MaCN' => 'required|unique:chuyennganh,MaCN', 
            'TenCN' => 'required|unique:chuyennganh,TenChuyenNganh'
        ], [
            'MaCN.unique' => 'Mã chuyên ngành này đã tồn tại!',
            'MaCN.required' => 'Vui lòng nhập mã chuyên ngành.',
            'TenCN.required' => 'Vui lòng nhập tên chuyên ngành.',
            'TenCN.unique'=>'Tên chuyên ngành đã tồn tại'
        ]);

        
        ChuyenNganh::create([
            'MaCN' => $request->MaCN,
            'TenChuyenNganh' => $request->TenCN
        ]);

        return redirect('/admin/chuyen-nganh')->with('success', 'Thêm chuyên ngành thành công!');
    }

    
    public function hienFormSua($id)
    {
        $cn = ChuyenNganh::find($id);
        if (!$cn) return redirect('/admin/chuyen-nganh')->with('error', 'Không tìm thấy!');
        
        return view('admin.chuyennganh.sua', compact('cn'));
    }

    
    public function capNhat(Request $request, $id) {
        $request->validate([
            
            'MaCN' => 'required|unique:chuyennganh,MaCN,'.$id.',ChuyenNganhID', 
            'TenCN' => 'required|unique:chuyennganh,TenChuyenNganh,'.$id.',ChuyenNganhID'
        ], [
            'MaCN.required' => 'Vui lòng nhập mã chuyên ngành.',
            'MaCN.unique' => 'Mã chuyên ngành này đã bị trùng với ngành khác.',
            'TenCN.required' => 'Vui lòng nhập tên chuyên ngành.',
            'TenCN.unique'=>'Tên chuyên ngành đã tồn tại'
        ]);

        try {
            $cn = ChuyenNganh::find($id);
            $cn->update([
                'MaCN' => $request->MaCN,
                'TenChuyenNganh' => $request->TenCN
            ]);
            
            return redirect('/admin/chuyen-nganh')->with('success', 'Cập nhật thành công!');
        } catch (\Exception $e) {
            return back()->withErrors(['msg' => 'Lỗi hệ thống: ' . $e->getMessage()]);
        }
    }

    
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