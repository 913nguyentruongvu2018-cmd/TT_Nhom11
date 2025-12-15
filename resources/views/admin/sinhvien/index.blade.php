@extends('layouts.admin')

@section('noidung')
    <div class="card">
        <h1>Quản Lý Sinh Viên</h1>

        {{-- THANH CÔNG CỤ LỌC & TÌM KIẾM --}}
        <div style="background:#f8f9fa; padding:15px; margin-bottom:20px; border:1px solid #ddd; border-radius:5px;">
            <form action="/admin/sinh-vien" method="GET" style="display:flex; gap:10px; flex-wrap:wrap; align-items:center;">

                {{-- 1. Ô Tìm kiếm --}}
                <input type="text" name="tu_khoa" value="{{ request('tu_khoa') }}" placeholder="🔍 Tên hoặc MSSV..."
                    style="padding:8px; border:1px solid #ccc; width:200px;">

                {{-- 2. Dropdown Chọn Lớp (Tự động select nếu bấm từ bên kia sang) --}}
                <select name="lop_id" onchange="this.form.submit()"
                    style="padding:8px; border:1px solid #ccc; min-width:180px; font-weight:bold;">
                    <option value="">-- Tất cả các lớp --</option>
                    @foreach ($dsLop as $lop)
                        <option value="{{ $lop->LopID }}" {{ request('lop_id') == $lop->LopID ? 'selected' : '' }}>
                            Lớp: {{ $lop->TenLop }}
                        </option>
                    @endforeach
                </select>

                {{-- 3. Dropdown Sắp xếp A-Z --}}
                <select name="sap_xep" onchange="this.form.submit()" style="padding:8px; border:1px solid #ccc;">
                    <option value="">Sắp xếp: Mặc định</option>
                    <option value="az" {{ request('sap_xep') == 'az' ? 'selected' : '' }}>Tên: A ➜ Z</option>
                    <option value="za" {{ request('sap_xep') == 'za' ? 'selected' : '' }}>Tên: Z ➜ A</option>
                </select>

                {{-- Nút Reset để xóa hết lọc --}}
                <a href="/admin/sinh-vien" style="color:red; text-decoration:none; margin-left:10px;">
                    ❌ Xóa lọc
                </a>
            </form>
        </div>

        <a href="/admin/sinh-vien/them"
            style="background:green; color:white; padding:10px; text-decoration:none; display:inline-block; margin-bottom:15px;">
            + Thêm Sinh Viên Mới
        </a>

        {{-- BẢNG DANH SÁCH --}}
        <table border="1" cellpadding="10" style="width:100%; border-collapse:collapse;">
            <thead>
                <tr style="background:#007bff; color:white;">
                    <th>Mã SV</th>
                    <th>Họ Tên</th>
                    <th>Lớp</th>
                    <th>Hành Động</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($dsSinhVien as $sv)
                    <tr>
                        <td style="font-weight:bold; color:#555;">{{ $sv->MaSV }}</td>
                        <td style="font-weight:bold;">{{ $sv->HoTen }}</td>

                        {{-- Hiển thị tên lớp --}}
                        <td style="color:blue;">
                            {{ $sv->lopHoc->TenLop ?? 'Chưa xếp lớp' }}
                        </td>

                        <td>
                            <a href="/admin/sinh-vien/sua/{{ $sv->MaSV }}">Sửa</a> |
                            <a href="/admin/sinh-vien/xoa/{{ $sv->MaSV }}" style="color:red;"
                                onclick="return confirm('Xóa nhé?');">Xóa</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{-- Thông báo nếu lớp đó không có ai --}}
        @if ($dsSinhVien->count() == 0)
            <div style="text-align:center; padding:20px; color:gray;">
                <p>Không tìm thấy sinh viên nào!</p>
            </div>
        @endif
    </div>
@endsection
