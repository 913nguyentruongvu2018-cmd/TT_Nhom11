@extends('layouts.admin')

@section('noidung')
    <div class="card" style="width: 500px; margin: 0 auto;">
        <a href="/admin/lop-hoc">← Quay lại</a>
        <h2>Thêm Lớp Học Mới</h2>

        <form action="/admin/lop-hoc/them" method="POST">
            @csrf

            {{-- Tên lớp --}}
            <label>Tên Lớp:</label>
            <input type="text" name="TenLop" value="{{ old('TenLop') }}" required placeholder="VD: DH22PM"
                style="width:100%; padding:10px; margin:5px 0;">
            @error('TenLop')
                <div style="color:red">{{ $message }}</div>
            @enderror

            {{-- Chọn Chuyên Ngành (MỚI) --}}
            <label>Chuyên Ngành:</label>
            <select name="ChuyenNganhID" style="width:100%; padding:10px; margin:5px 0;" required>
                <option value="">-- Chọn chuyên ngành --</option>
                @foreach ($dsChuyenNganh as $cn)
                    <option value="{{ $cn->ChuyenNganhID }}"
                        {{ old('ChuyenNganhID') == $cn->ChuyenNganhID ? 'selected' : '' }}>
                        {{ $cn->TenChuyenNganh }}
                    </option>
                @endforeach
            </select>
            @error('ChuyenNganhID')
                <div style="color:red">{{ $message }}</div>
            @enderror

            {{-- Chọn Giảng Viên --}}
            <label>Giảng Viên Chủ Nhiệm:</label>
            <select name="GiangVienID" style="width:100%; padding:10px; margin:5px 0;" required>
                <option value="">-- Chọn giảng viên --</option>
                @foreach ($dsGiangVien as $gv)
                    <option value="{{ $gv->GiangVienID }}" {{ old('GiangVienID') == $gv->GiangVienID ? 'selected' : '' }}>
                        {{ $gv->HoTen }} ({{ $gv->MaGV }})
                    </option>
                @endforeach
            </select>
            @error('GiangVienID')
                <div style="color:red">{{ $message }}</div>
            @enderror
            <label>Năm Học:</label>
            <input type="text" name="NamHoc" value="{{ old('NamHoc') }}" required placeholder="VD: 2024-2025"
                style="width:100%; padding:10px; margin:5px 0;">

            <button type="submit"
                style="background:green; color:white; padding:10px; width:100%; border:none; margin-top:10px; cursor:pointer;">
                Lưu Lớp Học
            </button>
        </form>
    </div>
@endsection
