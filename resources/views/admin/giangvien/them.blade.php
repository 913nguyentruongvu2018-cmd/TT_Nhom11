@extends('layouts.admin')

@section('noidung')
    <div class="card">
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom: 20px;">
            <h1>🎓 Thêm Giảng Viên Mới</h1>
            <a href="/admin/giang-vien" style="background:#6c757d; color:white; padding:8px 15px; text-decoration:none; border-radius:4px;">
                ← Quay lại
            </a>
        </div>

        {{-- Hiển thị lỗi chung --}}
        @if($errors->any())
            <div style="background:#f8d7da; color:red; padding:10px; margin-bottom:15px; border-radius:4px; border:1px solid #f5c6cb;">
                ⚠️ Vui lòng kiểm tra lại dữ liệu nhập bên dưới.
            </div>
        @endif

        <form action="/admin/giang-vien/them" method="POST">
            @csrf
            
            <table border="1" cellpadding="15" cellspacing="0" style="width:100%; border-collapse:collapse; border:1px solid #ddd; margin-bottom:20px;">
                <thead>
                    <tr style="background:#2980b9; color:white;">
                        <th style="width: 250px;">Thông Tin</th>
                        <th>Dữ Liệu Nhập</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- MÃ GIẢNG VIÊN --}}
                    <tr>
                        <td style="font-weight:bold; background:#f9f9f9;">Mã Giảng Viên (*)</td>
                        <td>
                            <input type="text" name="MaGV" value="{{ old('MaGV') }}" required placeholder="VD: GV001"
                                   style="width:100%; padding:8px; border:1px solid #ccc; border-radius:4px;">
                            @error('MaGV') <div style="color:red; font-size:13px; margin-top:5px;">⚠️ {{ $message }}</div> @enderror
                        </td>
                    </tr>

                    {{-- HỌ TÊN --}}
                    <tr>
                        <td style="font-weight:bold; background:#f9f9f9;">Họ Tên (*)</td>
                        <td>
                            <input type="text" name="HoTen" value="{{ old('HoTen') }}" required placeholder="VD: Nguyễn Văn A"
                                   style="width:100%; padding:8px; border:1px solid #ccc; border-radius:4px;">
                            @error('HoTen') <div style="color:red; font-size:13px; margin-top:5px;">⚠️ {{ $message }}</div> @enderror
                        </td>
                    </tr>

                    {{-- HỌC VỊ --}}
                    <tr>
                        <td style="font-weight:bold; background:#f9f9f9;">Học Vị</td>
                        <td>
                            <select name="HocVi" style="width:100%; padding:8px; border:1px solid #ccc; border-radius:4px;" required>
                                <option value="" selected disabled>-- Chọn Học Vị --</option>
                                <option value="Cử nhân" {{ old('HocVi') == 'Cử nhân' ? 'selected' : '' }}>Cử nhân</option>
                                <option value="Thạc sĩ" {{ old('HocVi') == 'Thạc sĩ' ? 'selected' : '' }}>Thạc sĩ</option>
                                <option value="Tiến sĩ" {{ old('HocVi') == 'Tiến sĩ' ? 'selected' : '' }}>Tiến sĩ</option>
                                <option value="Phó Giáo sư" {{ old('HocVi') == 'Phó Giáo sư' ? 'selected' : '' }}>Phó Giáo sư</option>
                                <option value="Giáo sư" {{ old('HocVi') == 'Giáo sư' ? 'selected' : '' }}>Giáo sư</option>
                            </select>
                        </td>
                    </tr>

                    {{-- CHUYÊN NGÀNH --}}
                    <tr>
                        <td style="font-weight:bold; background:#f9f9f9;">Chuyên Ngành (*)</td>
                        <td>
                            <select name="ChuyenNganhID" style="width:100%; padding:8px; border:1px solid #ccc; border-radius:4px;" required>
                                <option value="">-- Chọn chuyên ngành --</option>
                                @foreach ($dsChuyenNganh as $cn)
                                    <option value="{{ $cn->ChuyenNganhID }}" {{ old('ChuyenNganhID') == $cn->ChuyenNganhID ? 'selected' : '' }}>
                                        {{ $cn->TenChuyenNganh }}
                                    </option>
                                @endforeach
                            </select>
                            @error('ChuyenNganhID') <div style="color:red; font-size:13px; margin-top:5px;">⚠️ {{ $message }}</div> @enderror
                        </td>
                    </tr>
                </tbody>
            </table>

            <div style="text-align: right;">
                <button type="submit" style="background:#28a745; color:white; padding:12px 40px; border:none; border-radius:4px; cursor:pointer; font-weight:bold; font-size:16px; box-shadow: 0 2px 5px rgba(0,0,0,0.2);">
                    💾 LƯU GIẢNG VIÊN
                </button>
            </div>
        </form>
    </div>
@endsection