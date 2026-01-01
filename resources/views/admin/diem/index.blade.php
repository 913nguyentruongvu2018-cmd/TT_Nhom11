@extends('layouts.admin')

@section('noidung')
<div class="card">
    <h1>Quản Lý Điểm Số</h1>


    <div style="background:#f8f9fa; padding:15px; margin-bottom:20px; border:1px solid #ddd; border-radius:5px;">
        <form action="{{ route('admin.diem.index') }}" method="GET" style="display:flex; flex-wrap:wrap; gap:10px; align-items:center;">


            <select name="lop_id" style="padding:8px; border:1px solid #ccc; min-width:150px;" onchange="this.form.submit()">
                <option value="">-- Tất cả Lớp --</option>
                @foreach($dsLop as $lop)
                <option value="{{ $lop->LopID }}" {{ request('lop_id') == $lop->LopID ? 'selected' : '' }}>
                    {{ $lop->TenLop }}
                </option>
                @endforeach
            </select>


            <select name="mh_id" style="padding:8px; border:1px solid #ccc; min-width:200px;" onchange="this.form.submit()">
                <option value="">-- Chọn Môn để nhập/xem --</option>
                @foreach($dsMonHoc as $mh)
                <option value="{{ $mh->MonHocID }}" {{ request('mh_id') == $mh->MonHocID ? 'selected' : '' }}>
                    {{ $mh->TenMonHoc }}
                </option>
                @endforeach
            </select>


            <input type="text" name="tu_khoa" value="{{ request('tu_khoa') }}"
                placeholder="Tìm tên hoặc MSSV..."
                style="padding:8px; border:1px solid #ccc; width:200px;">

            <button type="submit" style="background:#007bff; color:white; border:none; padding:8px 15px; cursor:pointer;">
                🔍 Tìm
            </button>
            <a href="{{ route('admin.diem.index') }}" style="color:#666; margin-left:5px; text-decoration:none;">❌ Xóa lọc</a>
        </form>
    </div>


    <table border="1" cellpadding="10" style="width:100%; border-radius:5px;; ">
        <thead>
            <tr style="background:#343a40; color:white; ">
                <th>MSSV</th>
                <th>Họ Tên</th>
                <th>Lớp</th>
                @if(isset($monHocDuocChon) && $monHocDuocChon)
                <th style="background:#e67e22; color:white; width:150px; text-align:center;">
                    Điểm: {{ $monHocDuocChon->TenMonHoc }}
                </th>
                @endif
                <th style="text-align:center;">Hành Động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($dsSinhVien as $sv)
            <tr>
                <td>{{ $sv->MaSV }}</td>
                <td>{{ $sv->HoTen }}</td>
                <td>{{ $sv->lopHoc->TenLop ?? '...' }}</td>


                @if(isset($monHocDuocChon) && $monHocDuocChon)
                <td style="text-align:center;">
                    @if($sv->diem_hien_tai)
                    <span style="font-weight:bold; font-size:16px; color: {{ $sv->diem_hien_tai->DiemSo < 5 ? 'red' : 'blue' }}">
                        {{ $sv->diem_hien_tai->DiemSo }}
                    </span>
                    @else
                    <span style="color:#ccc;">--</span>
                    @endif
                </td>


                <td style="text-align:center; vertical-align: middle;">
                    @if($sv->diem_hien_tai)

                    <a href="{{ route('admin.diem.sua', ['id' => $sv->diem_hien_tai->DiemID] + request()->all()) }}"
                        style="color:blue; font-weight:bold; text-decoration:none; margin-right:5px;">
                        Sửa
                    </a>
                    <span style="color:#ccc;">|</span>
                    <a href="/admin/diem/xoa/{{ $sv->diem_hien_tai->DiemID }}"
                        style="color:red; font-weight:bold; text-decoration:none; margin-left:5px;"
                        onclick="return confirm('Xóa điểm này?')">
                        Xóa
                    </a>
                    @else

                    <a href="{{ route('admin.diem.nhap', array_merge(
                                           ['sv_id' => $sv->id, 'mh_id' => $monHocDuocChon->MonHocID, 'lop_id' => request('lop_id')],
                                           request()->query() 
                                       )) }}"
                        style="color:green; font-weight:bold; text-decoration:none; border:1px solid green; padding:4px 12px; border-radius:4px; display:inline-block; background:white;">
                        + Nhập
                    </a>
                    @endif
                </td>


                @else
                <td style="text-align:center;">
                    <a href="{{ route('admin.diem.chitiet', array_merge(['sv_id' => $sv->id], request()->query())) }}"
                        style="background:#17a2b8; color:white; padding:6px 12px; text-decoration:none; border-radius:4px; font-size:13px; font-weight:bold;">
                        👁️ Xem bảng điểm
                    </a>
                </td>
                @endif
            </tr>
            @endforeach
        </tbody>
    </table>

    <div style="margin-top:15px;">
        {{ $dsSinhVien->appends(request()->all())->links('phantrang') }}
    </div>
</div>
@endsection