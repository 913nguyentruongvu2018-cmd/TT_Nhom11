@extends('layouts.admin')

@section('noidung')
    <div class="card">
        <h1>Danh Sách Sinh Viên</h1>
        <a href="/admin/sinh-vien/them" style="background:green; color:white; padding:10px; text-decoration:none; border-radius:5px; margin-bottom:15px; display:inline-block;">+ Thêm Sinh Viên</a>

        @if (session('success'))
            <div style="background:#d4edda; color:#155724; padding:10px; margin-bottom:10px;">✅ {{ session('success') }}</div>
        @endif

        <table border="1" cellpadding="10" cellspacing="0" style="width:100%; border-collapse: collapse; border-color: #ddd;">
            <thead style="background-color: #f2f2f2;">
                <tr>
                    <th>ID</th>
                    <th>Mã SV</th>
                    <th>Họ Tên</th>
                    <th>Ngày Sinh</th> <th>Lớp</th>
                    <th>Hành Động</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($dsSinhVien as $sv)
                <tr style="border-bottom: 1px solid #ddd;">
                    <td>{{ $sv->id }}</td>
                    <td style="font-weight:bold; color:blue;">{{ $sv->MaSV }}</td>
                    <td>{{ $sv->HoTen }}</td>
                    
                    <td>
                        {{ $sv->NgaySinh ? date('d/m/Y', strtotime($sv->NgaySinh)) : '' }}
                    </td>

                    <td>{{ $sv->Lop }}</td>
                    <td>
                        <a href="/admin/sinh-vien/sua/{{ $sv->id }}" style="color: blue;">Sửa</a> |
                        <a href="/admin/sinh-vien/xoa/{{ $sv->id }}" style="color: red;" onclick="return confirm('Xóa sinh viên này?');">Xóa</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection