@extends('layouts.admin')

@section('noidung')
<div class="card">
    <h1>Quản Lý Môn Học</h1>

    <a href="/admin/mon-hoc/them"
        style="background:green; color:white; padding:10px; text-decoration:none; border-radius:5px; margin-bottom:15px; display:inline-block;">+
        Thêm Môn Mới</a>

    @if (session('success'))
    <div style="background:#d4edda; color:#155724; padding:10px; margin-bottom:10px;">✅ {{ session('success') }}
    </div>
    @endif

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Mã Môn</th> {{-- Thêm cột --}}
                <th>Tên Môn Học</th>
                <th>Số Tín Chỉ</th>
                <th>Hành Động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($dsMon as $mon)
            <tr>
                <td>{{ $mon->MonHocID }}</td>
                <td style="font-weight:bold;">{{ $mon->MaMon }}</td> {{-- Hiển thị mã --}}
                <td style="color:blue;">{{ $mon->TenMonHoc }}</td>
                <td>{{ $mon->SoTinChi }}</td>
                <td>
                    <a href="/admin/mon-hoc/sua/{{ $mon->MonHocID }}" style="color:#007bff; font-weight:bold; text-decoration:none; border:1px solid #007bff; padding:4px 10px; border-radius:4px; display:inline-block; margin-right:5px;">Sửa</a> 
                    <a href="/admin/mon-hoc/xoa/{{ $mon->MonHocID }}" style="color:#dc3545; font-weight:bold; text-decoration:none; border:1px solid #dc3545; padding:4px 10px; border-radius:4px; display:inline-block;" onclick="return confirm('Xóa môn học này?')">Xóa</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection