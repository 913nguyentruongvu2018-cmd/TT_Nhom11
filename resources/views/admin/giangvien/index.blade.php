@extends('layouts.admin')

@section('noidung')
    <div class="card">
        <h1>Quản Lý Giảng Viên</h1>

        <a href="/admin/giang-vien/them"
            style="background:green; color:white; padding:10px; text-decoration:none; border-radius:5px; margin-bottom:15px; display:inline-block;">+
            Thêm Giảng Viên</a>

        @if (session('success'))
            <div style="background:#d4edda; color:#155724; padding:10px; margin-bottom:10px;">✅ {{ session('success') }}
            </div>
        @endif

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Mã GV</th>
                    <th>Họ Tên</th>
                    <th>Học Vị</th>
                    <th>Chuyên Ngành</th>
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
                        <td>{{ $gv->ChuyenNganh }}</td>
                        <td>
                            <a href="/admin/giang-vien/sua/{{ $gv->GiangVienID }}" style="color: blue;">Sửa</a> |
                            <a href="/admin/giang-vien/xoa/{{ $gv->GiangVienID }}" style="color: red;"
                                onclick="return confirm('Bạn có chắc muốn xóa giảng viên {{ $gv->HoTen }}?');">Xóa</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
