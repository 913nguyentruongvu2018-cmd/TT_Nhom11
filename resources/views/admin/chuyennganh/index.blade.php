@extends('layouts.admin')
@section('noidung')
<div class="card">
    <h1>Quản Lý Chuyên Ngành</h1>
    <a href="/admin/chuyen-nganh/them" style="background:green; color:white; padding:10px; text-decoration:none; margin-bottom:15px; display:inline-block;">+ Thêm Ngành</a>

    @if(session('success')) <div style="color:green; margin:10px 0;">✅ {{ session('success') }}</div> @endif

    <table border="1" cellpadding="10" cellspacing="0" style="width:100%; border-collapse: collapse;">
        <thead style="background:#f2f2f2;">
            <tr>
                <th>ID</th>
                <th>Mã Ngành</th>
                <th>Tên Chuyên Ngành</th>
                <th>Hành Động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($dsCN as $cn)
            <tr>
                <td>{{ $cn->ChuyenNganhID }}</td>
                <td style="color:blue; font-weight:bold;">{{ $cn->MaCN }}</td>
                <td>{{ $cn->TenChuyenNganh }}</td>
                <td>
                    <a href="/admin/chuyen-nganh/sua/{{ $cn->id }}" style="color:blue;">Sửa</a> | 
                    <a href="/admin/chuyen-nganh/xoa/{{ $cn->id }}" style="color:red;" onclick="return confirm('Xóa ngành này?')">Xóa</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection