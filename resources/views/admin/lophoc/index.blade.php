@extends('layouts.admin')

@section('noidung')
    <div class="card">
        <h1>Quản Lý Lớp Học</h1>

        {{-- khung tim kiem --}}
        <div style="background:#f8f9fa; padding:15px; margin-bottom:20px; border:1px solid #ddd;">
            <form action="/admin/lop-hoc" method="GET" style="display:flex; gap:10px; align-items:center;">

                {{-- tim ten lop --}}
                <input type="text" name="tim_ten" value="{{ request('tim_ten') }}" placeholder="Nhập tên lớp..."
                    style="padding:8px;">

                {{-- tim nam hoc --}}
                <input type="text" name="tim_nam" value="{{ request('tim_nam') }}" placeholder="Năm (VD: 2024)..."
                    style="padding:8px; width:120px;">

                {{-- Loc chuyen nganh --}}
                <select name="tim_cn" style="padding:8px;">
                    <option value="">-- Tất cả Chuyên Ngành --</option>
                    @foreach ($dsChuyenNganh as $cn)
                        <option value="{{ $cn->ChuyenNganhID }}"
                            {{ request('tim_cn') == $cn->ChuyenNganhID ? 'selected' : '' }}>
                            {{ $cn->TenChuyenNganh }}
                        </option>
                    @endforeach
                </select>

                <button type="submit"
                    style="background:#007bff; color:white; border:none; padding:8px 15px; cursor:pointer;">
                    🔍 Tìm kiếm
                </button>

                <a href="/admin/lop-hoc" style="color:#666; margin-left:10px;">Xóa lọc</a>
            </form>
        </div>

        <a href="/admin/lop-hoc/them"
            style="background:green; color:white; padding:10px; text-decoration:none; display:inline-block; margin-bottom:15px;">
            + Thêm Lớp Học
        </a>

        @if (session('success'))
            <div style="background:#d4edda; color:#155724; padding:10px; margin-bottom:10px;">
                ✅ {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div style="background:#f8d7da; color:#721c24; padding:10px; margin-bottom:10px; border: 1px solid #f5c6cb;">
                ⚠️ {{ session('error') }}
            </div>
        @endif

        <table border="1" cellpadding="10" style="width:100%; border-collapse:collapse;">
            <thead>
                <tr style="background:#eee;">
                    <th>ID</th>
                    <th>Tên Lớp</th>
                    <th>Năm Học</th>
                    <th>Chuyên Ngành</th>
                    <th>GV Chủ Nhiệm</th>
                    <th>Hành Động</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($dsLop as $lop)
                    <tr>
                        <td>{{ $lop->LopID }}</td>
                        <td style="font-weight:bold; color:blue;">{{ $lop->TenLop }}</td>

                        {{-- Hiển thị Năm Học --}}
                        <td style="text-align:center;">{{ $lop->NamHoc }}</td>

                        <td>{{ $lop->chuyenNganh->TenChuyenNganh ?? '...' }}</td>
                        <td>{{ $lop->giangVien->HoTen ?? '...' }}</td>
                        <td>
                            <a href="/admin/lop-hoc/sua/{{ $lop->LopID }} "style="color:#007bff; font-weight:bold; text-decoration:none; border:1px solid #007bff; padding:4px 10px; border-radius:4px; display:inline-block; margin-right:5px;">Sửa</a>
                            <a href="/admin/lop-hoc/xoa/{{ $lop->LopID }}" onclick="return confirm('Xóa lớp này?');"
                                style="color:#dc3545; font-weight:bold; text-decoration:none; border:1px solid #dc3545; padding:4px 10px; border-radius:4px; display:inline-block;">Xóa</a>
                            <a href="/admin/sinh-vien?lop_id={{ $lop->LopID }}"
                                style="background:#17a2b8; color:white; padding:6px 12px; text-decoration:none; border-radius:4px; font-size:13px; font-weight:bold;">
                                Xem Danh Sách
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
