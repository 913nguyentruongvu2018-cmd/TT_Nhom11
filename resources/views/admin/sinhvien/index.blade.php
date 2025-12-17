@extends('layouts.admin')

@section('noidung')
    <div class="card">
        <h1>Quản Lý Sinh Viên</h1>

        {{-- KHUNG TÌM KIẾM (Đã chỉnh sửa cho đẹp và giống bên Giảng viên) --}}
        <div style="background:#f1f1f1; padding:15px; margin-bottom:20px; border-radius:5px;">
            <form action="/admin/sinh-vien" method="GET" style="display:flex; gap:10px; align-items:center;">
                
                {{-- 1. Ô nhập từ khóa --}}
                <input type="text" name="tu_khoa" value="{{ request('tu_khoa') }}" 
                    placeholder="Nhập tên hoặc MSSV..." 
                    style="padding:8px; border:1px solid #ccc; width:200px;">

                {{-- 2. Checkbox lọc chưa có TK (Đóng khung lại cho đẹp) --}}
                <label style="display:flex; align-items:center; gap:5px; background:white; border:1px solid #ccc; padding:7px 10px; cursor:pointer;">
                    <input type="checkbox" name="chua_co_tk" value="1" {{ request('chua_co_tk') ? 'checked' : '' }}> 
                    <span style="font-size:14px;">Chưa có tài khoản</span>
                </label>

                {{-- 3. Dropdown chọn lớp --}}
                <select name="lop_id" style="padding:8px; border:1px solid #ccc; min-width: 150px;">
                    <option value="">-- Tất cả các lớp --</option>
                    @foreach($dsLop as $lop)
                        <option value="{{ $lop->LopID }}" {{ request('lop_id') == $lop->LopID ? 'selected' : '' }}>
                            {{ $lop->TenLop }}
                        </option>
                    @endforeach
                </select>

                {{-- 4. Nút Tìm kiếm (Màu xanh dương giống bên Giảng viên) --}}
                <button type="submit" style="background:#007bff; color:white; border:none; padding:8px 15px; cursor:pointer;">
                    🔍 Tìm kiếm
                </button>
                
                {{-- 5. Nút Xóa lọc --}}
                <a href="/admin/sinh-vien" style="color:#666; margin-left:10px; text-decoration:none;">❌ Xóa lọc</a>
            </form>
        </div>

        <a href="/admin/sinh-vien/them" style="background:green; color:white; padding:10px; text-decoration:none; display:inline-block; margin-bottom:15px;">
            + Thêm Sinh Viên Mới
        </a>

        @if (session('success'))
            <div style="background:#d4edda; color:#155724; padding:10px; margin-bottom:10px;">
                ✅ {{ session('success') }}
            </div>
        @endif

        <table border="1" cellpadding="10" style="width:100%; border-collapse:collapse;">
            <thead>
                <tr style="background:#2980b9; color:white;"> {{-- Đổi màu header thành xanh dương cho đồng bộ luôn --}}
                    <th>Mã SV</th>
                    <th>Họ Tên</th>
                    <th>Lớp</th>
                    <th>Tài Khoản</th>
                    <th>Hành Động</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($dsSinhVien as $sv)
                    <tr>
                        <td>{{ $sv->MaSV }}</td>
                        <td>{{ $sv->HoTen }}</td>
                        <td>{{ $sv->lopHoc->TenLop ?? '...' }}</td>
                        
                        <td style="text-align:center;">
                            @if($sv->NguoiDungID)
                                <span style="color:green; font-weight:bold;">✔ Đã có</span>
                            @else
                                <a href="/admin/nguoi-dung/them?role=SinhVien&id={{ $sv->id }}" 
                                   style="background:#e67e22; color:white; padding:5px 10px; text-decoration:none; border-radius:4px; font-size:12px;">
                                   + Tạo TK
                                </a>
                            @endif
                        </td>

                        <td>
                            <a href="/admin/sinh-vien/sua/{{ $sv->id }}" style="color: blue;">Sửa</a> | 
                            <a href="/admin/sinh-vien/xoa/{{ $sv->id }}" style="color: red;" onclick="return confirm('Xóa?')">Xóa</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        
        <div style="margin-top: 10px;">
            {{ $dsSinhVien->links() }}
        </div>
    </div>
@endsection