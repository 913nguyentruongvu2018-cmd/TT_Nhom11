@extends('layouts.admin')

@section('noidung')
    <div class="card">
        <h1>Quản Lý Giảng Viên</h1>

        <div style="background:#f1f1f1; padding:15px; margin-bottom:20px; border-radius:5px;">
            <form action="/admin/giang-vien" method="GET" style="display:flex; gap:10px; align-items:center;">
                
                {{-- 1. Ô tìm kiếm --}}
                <input type="text" name="tu_khoa" value="{{ request('tu_khoa') }}" 
                    placeholder="Nhập tên hoặc Mã GV..." 
                    style="padding:8px; border:1px solid #ccc; width:200px;">

                {{-- 2. CHECKBOX LỌC CHƯA CÓ TÀI KHOẢN (ĐÃ THÊM VÀO) --}}
                <label style="display:flex; align-items:center; gap:5px; background:white; border:1px solid #ccc; padding:7px 10px; cursor:pointer;">
                    <input type="checkbox" name="chua_co_tk" value="1" {{ request('chua_co_tk') ? 'checked' : '' }}> 
                    <span style="font-size:14px;">Chưa có tài khoản</span>
                </label>

                {{-- 3. Lọc chuyên ngành --}}
                <select name="cn_id" style="padding:8px; border:1px solid #ccc; min-width: 180px;">
                    <option value="">-- Tất cả Chuyên Ngành --</option>
                    @foreach($dsChuyenNganh as $cn)
                        <option value="{{ $cn->ChuyenNganhID }}" {{ request('cn_id') == $cn->ChuyenNganhID ? 'selected' : '' }}>
                            {{ $cn->TenChuyenNganh }}
                        </option>
                    @endforeach
                </select>

                {{-- 4. Nút Tìm kiếm --}}
                <button type="submit" style="background:#007bff; color:white; border:none; padding:8px 15px; cursor:pointer;">
                    🔍 Tìm kiếm
                </button>
                
                {{-- 5. Nút Xóa lọc --}}
                <a href="/admin/giang-vien" style="color:#666; margin-left:10px; text-decoration:none;">❌ Xóa lọc</a>
            </form>
        </div>

        <a href="/admin/giang-vien/them"
            style="background:green; color:white; padding:10px; text-decoration:none; border-radius:5px; margin-bottom:15px; display:inline-block;">
            + Thêm Giảng Viên
        </a>

        @if (session('success'))
            <div style="background:#d4edda; color:#155724; padding:10px; margin-bottom:10px;">
                ✅ {{ session('success') }}
            </div>
        @endif

        <table border="1" cellpadding="10" style="width:100%; border-collapse:collapse;">
            <thead>
                <tr style="background:#2980b9; color:white;">
                    <th>ID</th>
                    <th>Mã GV</th>
                    <th>Họ Tên</th>
                    <th>Học Vị</th>
                    <th>Chuyên Ngành</th>
                    <th>Tài Khoản</th>
                    <th>Hành Động</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($dsGiangVien as $gv)
                    <tr>
                        <td>{{ $gv->GiangVienID }}</td>
                        <td style="font-weight:bold; color:blue;">{{ $gv->MaGV }}</td>
                        <td>{{ $gv->HoTen }}</td>
                        <td>{{ $gv->HocVi }}</td>
                        <td>
                            {{ $gv->chuyenNganh->TenChuyenNganh ?? 'Chưa cập nhật' }}
                        </td>
                        
                        <td style="text-align:center;">
                            @if($gv->NguoiDungID)
                                <span style="color:green; font-weight:bold;">✔ Đã có</span>
                            @else
                                <a href="/admin/nguoi-dung/them?role=GiangVien&id={{ $gv->GiangVienID }}" 
                                   style="background:#e67e22; color:white; padding:5px 10px; text-decoration:none; border-radius:4px; font-size:12px;">
                                   + Tạo TK
                                </a>
                            @endif
                        </td>

                        <td>
                            <a href="/admin/giang-vien/sua/{{ $gv->GiangVienID }}" style="color: blue;">Sửa</a> |
                            <a href="/admin/giang-vien/xoa/{{ $gv->GiangVienID }}" style="color: red;"
                                onclick="return confirm('Bạn có chắc muốn xóa giảng viên {{ $gv->HoTen }}?');">Xóa</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        
        <div style="margin-top:15px;">
            {{ $dsGiangVien->links() }}
        </div>
    </div>
@endsection