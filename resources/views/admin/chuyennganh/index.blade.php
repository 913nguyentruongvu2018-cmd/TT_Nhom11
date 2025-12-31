@extends('layouts.admin')
@section('noidung')
<div class="card">
    <h1>Quản Lý Chuyên Ngành</h1>
    <a href="/admin/chuyen-nganh/them" style="background:green; color:white; padding:10px;border-radius:5px; text-decoration:none; margin-bottom:15px; display:inline-block;">+ Thêm Ngành</a>

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
                <td style="text-align:center;">
                    <a href="/admin/chuyen-nganh/sua/{{ $cn->ChuyenNganhID }}"
                        style="color:#007bff; font-weight:bold; text-decoration:none; border:1px solid #007bff; padding:4px 10px; border-radius:4px; display:inline-block; margin-right:5px;">
                        Sửa
                    </a>
                    <a href="/admin/chuyen-nganh/xoa/{{ $cn->ChuyenNganhID }}"
                        style="color:#dc3545; font-weight:bold; text-decoration:none; border:1px solid #dc3545; padding:4px 10px; border-radius:4px; display:inline-block;"
                        onclick="return confirm('Xóa ngành {{ $cn->TenChuyenNganh }}?');">
                        Xóa
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection