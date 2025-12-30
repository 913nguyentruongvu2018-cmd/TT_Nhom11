@extends('layouts.admin')

@section('noidung')
<div class="card">
    <h1>Quản Lý Sinh Viên</h1>

    {{-- tim kiem va sap xep --}}
    <div style="background:#f1f1f1; padding:15px; margin-bottom:20px; border-radius:5px;">
        <form action="/admin/sinh-vien" method="GET" style="display:flex; gap:10px; align-items:center; flex-wrap:wrap;">

            {{-- tim theo ten, mssv --}}
            <input type="text" name="tu_khoa" value="{{ request('tu_khoa') }}"
                placeholder="Nhập tên hoặc MSSV..."
                style="padding:8px; border:1px solid #ccc; width:200px;">

            {{-- loc khong co tk --}}
            <label style="display:flex; align-items:center; gap:5px; background:white; border:1px solid #ccc; padding:7px 10px; cursor:pointer;">
                <input type="checkbox" name="chua_co_tk" value="1" {{ request('chua_co_tk') ? 'checked' : '' }}>
                <span style="font-size:13px;">Chưa có TK</span>
            </label>

            {{-- chon lop --}}
            <select name="lop_id" style="padding:8px; border:1px solid #ccc; min-width: 150px;">
                <option value="">-- Tất cả các lớp --</option>
                @foreach($dsLop as $lop)
                <option value="{{ $lop->LopID }}" {{ request('lop_id') == $lop->LopID ? 'selected' : '' }}>
                    {{ $lop->TenLop }}
                </option>
                @endforeach
            </select>

            {{-- sap xep --}}
            <select name="sap_xep" style="padding:8px; border:1px solid #ccc;">
                <option value="">Sắp xếp: Mặc định</option>
                <option value="az" {{ request('sap_xep') == 'az' ? 'selected' : '' }}>Tên: A ➜ Z</option>
                <option value="za" {{ request('sap_xep') == 'za' ? 'selected' : '' }}>Tên: Z ➜ A</option>
            </select>

            {{-- nut tim --}}
            <button type="submit" style="background:#007bff; color:white; border:none; padding:8px 15px; cursor:pointer;">
                🔍 Tìm
            </button>

            <a href="/admin/sinh-vien" style="color:#666; margin-left:5px; text-decoration:none;">❌ Xóa lọc</a>
        </form>
    </div>

    <a href="/admin/sinh-vien/them" style="background:green; color:white; padding:10px; text-decoration:none; display:inline-block; margin-bottom:15px;">
        + Thêm Sinh Viên Mới
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
                <th>Mã SV</th>
                <th>Họ Tên</th>
                <th>Lớp</th>
                <th>Tài Khoản</th>
                <th>Hành Động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($dsSinhVien as $sv)
            <tr>
                <td>{{ $sv->MaSV }}</td>
                <td>{{ $sv->HoTen }}</td>
                <td>{{ $sv->lopHoc->TenLop ?? '...' }}</td>



                <td style="text-align:center;">
                    @if($sv->NguoiDungID)
                    <span style="color:green; font-weight:bold;">✔ Đã có</span>
                    @else
                    <a href="/admin/nguoi-dung/them?role=SinhVien&id={{ $sv->id }}"
                        style="background:#e67e22; color:white; padding:5px 10px; text-decoration:none; border-radius:4px; font-size:12px;">
                        + Tạo TK
                    </a>
                    @endif
                </td>


                <td style="white-space:nowrap;">
                    {{-- nut  --}}

                    {{-- sua --}}
                    <a href="/admin/sinh-vien/sua/{{ $sv->id }}"
                        style="color:#007bff; font-weight:bold; text-decoration:none; border:1px solid #007bff; padding:5px 10px; border-radius:4px; display:inline-block; margin-right:5px; font-size:13px;">
                        Sửa
                    </a>


                    <a href="/admin/sinh-vien/xoa/{{ $sv->id }}"
                        style="color:#dc3545; font-weight:bold; text-decoration:none; border:1px solid #dc3545; padding:5px 10px; border-radius:4px; display:inline-block; font-size:13px;"
                        onclick="return confirm('Xóa sinh viên này sẽ xóa luôn điểm số và tài khoản liên quan. Bạn chắc chứ?')">
                        Xóa
                    </a>
                    <a href="{{ route('admin.diem.chitiet', ['sv_id' => $sv->id] + request()->all()) }}"
                        style="background:#17a2b8; color:white; font-weight:bold; text-decoration:none; padding:6px 10px; border-radius:4px; display:inline-block; margin-right:5px; font-size:13px;">
                        Xem điểm
                    </a>
                    @if($sv->Lop)
                    <a href="/admin/tkb?LopID={{ $sv->Lop }}"
                        style="background:#6f42c1; color:white; font-weight:bold; text-decoration:none; padding:5px 10px; border-radius:4px; display:inline-block; margin-right:5px; font-size:13px;">
                        Xem TKB
                    </a>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div style="margin-top: 10px;">{{ $dsSinhVien->appends(request()->all())->links('phantrang') }}</div>
</div>
@endsection