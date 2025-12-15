@extends('layouts.admin')

@section('noidung')
<div class="card" style="width: 500px; margin: 0 auto;">
    <a href="/admin/giang-vien">← Quay lại</a>
    <h2>Cập Nhật Giảng Viên</h2>

    <form action="/admin/giang-vien/sua/{{ $gv->GiangVienID }}" method="POST">
        @csrf

        <label>Mã Giảng Viên:</label>
        <input type="text" name="MaGV" value="{{ old('MaGV', $gv->MaGV) }}" required
            style="width:100%; padding:10px; margin:5px 0;">
        @error('MaGV')
        <div style="color:red">{{ $message }}</div>
        @enderror

        <label>Họ Tên:</label>
        <input type="text" name="HoTen" value="{{ old('HoTen', $gv->HoTen) }}" required
            style="width:100%; padding:10px; margin:5px 0;">

        <label for="HocVi">Học Vị:</label>
        <select name="HocVi" id="HocVi" required
            style='width:100%; padding:10px; margin:5px 0 15px 0;'>
            <option value="" selected disabled>-- Chọn Học Vị --</option>
            <option value="Cử nhân" {{ old('HocVi') == 'Cử nhân' ? 'selected' : '' }}>Cử nhân</option>
            <option value="Thạc sĩ" {{ old('HocVi') == 'Thạc sĩ' ? 'selected' : '' }}>Thạc sĩ</option>
            <option value="Tiến sĩ" {{ old('HocVi') == 'Tiến sĩ' ? 'selected' : '' }}>Tiến sĩ</option>
            <option value="Phó Giáo sư" {{ old('HocVi') == 'Phó Giáo sư' ? 'selected' : '' }}>Phó Giáo sư</option>
            <option value="Giáo sư" {{ old('HocVi') == 'Giáo sư' ? 'selected' : '' }}>Giáo sư</option>
        </select>

        <label>Chuyên Ngành:</label>
        <select name="ChuyenNganhID" style="width:100%; padding:10px; margin:5px 0;" required>
            @foreach ($dsChuyenNganh as $cn)
            <option value="{{ $cn->ChuyenNganhID }}"
                {{ $gv->ChuyenNganhID == $cn->ChuyenNganhID ? 'selected' : '' }}>
                {{ $cn->TenChuyenNganh }}
            </option>
            @endforeach
        </select>

        <button type="submit"
            style="background:#e67e22; color:white; padding:10px; width:100%; border:none; margin-top:10px; cursor:pointer;">Cập
            Nhật</button>
    </form>
</div>
@endsection