@extends('layouts.admin')

@section('noidung')
    <div class="card">
        <h1>Quản Lý Sinh Viên</h1>

        <a href="/admin/sinh-vien/them"
            style="background:green; color:white; padding:10px; text-decoration:none; border-radius:5px; margin-bottom:15px; display:inline-block;">+
            Thêm Sinh Viên</a>

        @if (session('success'))
            <div style="background:#d4edda; color:#155724; padding:10px; margin-bottom:10px;">✅ {{ session('success') }}
            </div>
        @endif

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Mã SV</th>
                    <th>Họ Tên</th>
                    <th>Lớp</th>
                    <th>Ngày Sinh</th>
                    <th>Hành Động</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($dsSinhVien as $sv)
                    <tr>
                        <td>{{ $sv->id }}</td>
                        <td style="font-weight:bold; color:blue;">{{ $sv->MaSV }}</td>
                        <td>{{ $sv->HoTen }}</td>
                        <td>{{ $sv->Lop }}</td>
                        <td>{{ $sv->NgaySinh }}</td>
                        <td>
                            <a href="/admin/sinh-vien/sua/{{ $sv->id }}" style="color: blue;">Sửa</a> |
                            <a href="/admin/sinh-vien/xoa/{{ $sv->id }}" style="color: red;"
                                onclick="return confirm('Bạn có chắc muốn xóa sinh viên {{ $sv->HoTen }}?');">Xóa</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
