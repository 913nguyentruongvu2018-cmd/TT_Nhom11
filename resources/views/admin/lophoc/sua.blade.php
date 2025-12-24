@extends('layouts.admin')

@section('noidung')
    <div class="card">
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom: 20px;">
            <h1>✏️ Cập Nhật Lớp Học</h1>
            <a href="/admin/lop-hoc" style="background:#6c757d; color:white; padding:8px 15px; text-decoration:none; border-radius:4px;">
                ← Quay lại
            </a>
        </div>

        <form action="/admin/lop-hoc/sua/{{ $lop->LopID }}" method="POST">
            @csrf
            
            <table border="1" cellpadding="15" cellspacing="0" style="width:100%; border-collapse:collapse; border:1px solid #ddd; margin-bottom:20px;">
                <thead>
                    <tr style="background:#2980b9; color:white;">
                        <th style="width: 250px;">Thông Tin</th>
                        <th>Dữ Liệu Cập Nhật</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- ten lop --}}
                    <tr>
                        <td style="font-weight:bold; background:#f9f9f9;">Tên Lớp</td>
                        <td>
                            <input type="text" name="TenLop" value="{{ old('TenLop', $lop->TenLop) }}" required 
                                   style="width:100%; padding:8px; border:1px solid #ccc; border-radius:4px;">
                            @error('TenLop') <div style="color:red; font-size:13px; margin-top:5px;">⚠️ {{ $message }}</div> @enderror
                        </td>
                    </tr>

                    {{-- chuyen nganh --}}
                    <tr>
                        <td style="font-weight:bold; background:#f9f9f9;">Chuyên Ngành</td>
                        <td>
                            <select name="ChuyenNganhID" style="width:100%; padding:8px; border:1px solid #ccc; border-radius:4px;" required>
                                <option value="">-- Chọn chuyên ngành --</option>
                                @foreach ($dsChuyenNganh as $cn)
                                    <option value="{{ $cn->ChuyenNganhID }}" 
                                        {{ old('ChuyenNganhID', $lop->ChuyenNganhID) == $cn->ChuyenNganhID ? 'selected' : '' }}>
                                        {{ $cn->TenChuyenNganh }}
                                    </option>
                                @endforeach
                            </select>
                        </td>
                    </tr>

                    {{-- giang vien --}}
                    <tr>
                        <td style="font-weight:bold; background:#f9f9f9;">Giảng Viên Chủ Nhiệm</td>
                        <td>
                            <select name="GiangVienID" style="width:100%; padding:8px; border:1px solid #ccc; border-radius:4px;" required>
                                <option value="">-- Chọn giảng viên --</option>
                                @foreach ($dsGiangVien as $gv)
                                    <option value="{{ $gv->GiangVienID }}" 
                                        {{ old('GiangVienID', $lop->GiangVienID) == $gv->GiangVienID ? 'selected' : '' }}>
                                        {{ $gv->HoTen }} ({{ $gv->MaGV }})
                                    </option>
                                @endforeach
                            </select>
                        </td>
                    </tr>

                    {{-- nam hoc --}}
                    <tr>
                        <td style="font-weight:bold; background:#f9f9f9;">Năm Học</td>
                        <td>
                            <input type="text" name="NamHoc" value="{{ old('NamHoc', $lop->NamHoc) }}" required 
                                   style="width:100%; padding:8px; border:1px solid #ccc; border-radius:4px;">
                        </td>
                    </tr>
                </tbody>
            </table>

            <div style="text-align: right;">
                <button type="submit" style="background:#e67e22; color:white; padding:12px 40px; border:none; border-radius:4px; cursor:pointer; font-weight:bold; font-size:16px; box-shadow: 0 2px 5px rgba(0,0,0,0.2);">
                    💾 LƯU CẬP NHẬT
                </button>
            </div>
        </form>
    </div>
@endsection