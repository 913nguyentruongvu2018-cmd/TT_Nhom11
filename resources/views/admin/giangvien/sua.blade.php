@extends('layouts.admin')

@section('noidung')
    <div class="card">
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom: 20px;">
            <h1>✏️ Cập Nhật Giảng Viên</h1>
            <a href="/admin/giang-vien" style="background:#6c757d; color:white; padding:8px 15px; text-decoration:none; border-radius:4px;">
                ← Quay lại
            </a>
        </div>

        <form action="/admin/giang-vien/sua/{{ $gv->GiangVienID }}" method="POST">
            @csrf
            
            <table border="1" cellpadding="15" cellspacing="0" style="width:100%; border-collapse:collapse; border:1px solid #ddd; margin-bottom:20px;">
                <thead>
                    <tr style="background:#2980b9; color:white;">
                        <th style="width: 250px;">Thông Tin</th>
                        <th>Dữ Liệu Cập Nhật</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- MÃ GIẢNG VIÊN --}}
                    <tr>
                        <td style="font-weight:bold; background:#f9f9f9;">Mã Giảng Viên</td>
                        <td>
                            <input type="text" name="MaGV" value="{{ old('MaGV', $gv->MaGV) }}" required 
                                   style="width:100%; padding:8px; border:1px solid #ccc; border-radius:4px;">
                            @error('MaGV') <div style="color:red; font-size:13px; margin-top:5px;">⚠️ {{ $message }}</div> @enderror
                        </td>
                    </tr>

                    {{-- HỌ TÊN --}}
                    <tr>
                        <td style="font-weight:bold; background:#f9f9f9;">Họ Tên</td>
                        <td>
                            <input type="text" name="HoTen" value="{{ old('HoTen', $gv->HoTen) }}" required 
                                   style="width:100%; padding:8px; border:1px solid #ccc; border-radius:4px;">
                             @error('HoTen') <div style="color:red; font-size:13px; margin-top:5px;">⚠️ {{ $message }}</div> @enderror
                        </td>
                    </tr>

                    {{-- HỌC VỊ --}}
                    <tr>
                        <td style="font-weight:bold; background:#f9f9f9;">Học Vị</td>
                        <td>
                            <select name="HocVi" style="width:100%; padding:8px; border:1px solid #ccc; border-radius:4px;" required>
                                <option value="" disabled>-- Chọn Học Vị --</option>
                                {{-- Tôi đã sửa logic old() ở đây để nó bắt đúng giá trị cũ --}}
                                <option value="Cử nhân" {{ old('HocVi', $gv->HocVi) == 'Cử nhân' ? 'selected' : '' }}>Cử nhân</option>
                                <option value="Thạc sĩ" {{ old('HocVi', $gv->HocVi) == 'Thạc sĩ' ? 'selected' : '' }}>Thạc sĩ</option>
                                <option value="Tiến sĩ" {{ old('HocVi', $gv->HocVi) == 'Tiến sĩ' ? 'selected' : '' }}>Tiến sĩ</option>
                                <option value="Phó Giáo sư" {{ old('HocVi', $gv->HocVi) == 'Phó Giáo sư' ? 'selected' : '' }}>Phó Giáo sư</option>
                                <option value="Giáo sư" {{ old('HocVi', $gv->HocVi) == 'Giáo sư' ? 'selected' : '' }}>Giáo sư</option>
                            </select>
                        </td>
                    </tr>

                    {{-- CHUYÊN NGÀNH --}}
                    <tr>
                        <td style="font-weight:bold; background:#f9f9f9;">Chuyên Ngành</td>
                        <td>
                            <select name="ChuyenNganhID" style="width:100%; padding:8px; border:1px solid #ccc; border-radius:4px;" required>
                                <option value="">-- Chọn chuyên ngành --</option>
                                @foreach ($dsChuyenNganh as $cn)
                                    <option value="{{ $cn->ChuyenNganhID }}" 
                                        {{ old('ChuyenNganhID', $gv->ChuyenNganhID) == $cn->ChuyenNganhID ? 'selected' : '' }}>
                                        {{ $cn->TenChuyenNganh }}
                                    </option>
                                @endforeach
                            </select>
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