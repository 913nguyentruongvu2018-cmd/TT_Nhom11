@extends('layouts.admin')

@section('noidung')
<div class="card">
    <h1>Quản Lý Giảng Viên</h1>

    <div style="background:#f1f1f1; padding:15px; margin-bottom:20px; border-radius:5px;">
        <form action="/admin/giang-vien" method="GET" style="display:flex; gap:10px; align-items:center; flex-wrap:wrap;">

            <input type="text" name="tu_khoa" value="{{ request('tu_khoa') }}"
                placeholder="Nhập tên hoặc Mã GV..."
                style="padding:8px; border:1px solid #ccc; width:200px;">

            <label style="display:flex; align-items:center; gap:5px; background:white; border:1px solid #ccc; padding:7px 10px; cursor:pointer;">
                <input type="checkbox" name="chua_co_tk" value="1" {{ request('chua_co_tk') ? 'checked' : '' }}>
                <span style="font-size:13px;">Chưa có TK</span>
            </label>

            <select name="cn_id" style="padding:8px; border:1px solid #ccc; min-width: 150px;">
                <option value="">-- Tất cả Chuyên Ngành --</option>
                @foreach($dsChuyenNganh as $cn)
                <option value="{{ $cn->ChuyenNganhID }}" {{ request('cn_id') == $cn->ChuyenNganhID ? 'selected' : '' }}>
                    {{ $cn->TenChuyenNganh }}
                </option>
                @endforeach
            </select>

            {{-- Ô SẮP XẾP --}}
            <select name="sap_xep" style="padding:8px; border:1px solid #ccc;">
                <option value="">Sắp xếp: Mặc định</option>
                <option value="az" {{ request('sap_xep') == 'az' ? 'selected' : '' }}>Tên: A ➜ Z</option>
                <option value="za" {{ request('sap_xep') == 'za' ? 'selected' : '' }}>Tên: Z ➜ A</option>
            </select>

            <button type="submit" style="background:#007bff; color:white; border:none; padding:8px 15px; cursor:pointer;">
                🔍 Tìm
            </button>

            <a href="/admin/giang-vien" style="color:#666; margin-left:5px; text-decoration:none;">❌ Xóa lọc</a>
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
    @if (session('error'))
    <div style="background:#f8d7da; color:#721c24; padding:10px; margin-bottom:10px; border: 1px solid #f5c6cb;">
        ⚠️ {{ session('error') }}
    </div>
    @endif

    <table border="1" cellpadding="10" style="width:100%; border-collapse:collapse;">
        <thead>
            <tr style="background:#2980b9; color:white;">
                <th>Mã GV</th>
                <th>Họ Tên</th>
                <th>Chuyên Ngành</th>
                <th>Tài Khoản</th>
                <th>Hành Động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($dsGiangVien as $gv)
            <tr>
                <td>{{ $gv->MaGV }}</td>
                <td>{{ $gv->HoTen }}</td>
                <td>{{ $gv->chuyenNganh->TenChuyenNganh ?? '...' }}</td>
                <td style="text-align:center;">
                    @if($gv->NguoiDungID)
                    <span style="color:green; font-weight:bold;">✔ Đã có</span>
                    @else
                    <a href="/admin/nguoi-dung/them?role=GiangVien&id={{ $gv->GiangVienID }}"
                        style="background:#e67e22; color:white; padding:5px 10px; text-decoration:none; border-radius:4px; font-size:12px;">+ Tạo TK</a>
                    @endif
                </td>
                <td>
                    <a href="/admin/giang-vien/sua/{{ $gv->GiangVienID }}" style="color:#007bff; font-weight:bold; text-decoration:none; border:1px solid #007bff; padding:4px 10px; border-radius:4px; display:inline-block; margin-right:5px;">Sửa</a>
                    <a href="/admin/giang-vien/xoa/{{ $gv->GiangVienID }}" style="color:#dc3545; font-weight:bold; text-decoration:none; border:1px solid #dc3545; padding:4px 10px; border-radius:4px; display:inline-block;">Xóa</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div style="margin-top:15px;">{{ $dsGiangVien->appends(request()->all())->links('phantrang') }}</div>
</div>
@endsection