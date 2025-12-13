@extends('layouts.admin')

@section('noidung')
    <div class="card" style="width: 500px; margin: 0 auto;">
        <a href="/admin/lop-hoc">← Quay lại</a>
        <h2>Cập Nhật Lớp Học</h2>

        <form action="/admin/lop-hoc/sua/{{ $lop->LopID }}" method="POST">
            @csrf

            {{-- Tên lớp --}}
            <label>Tên Lớp:</label>
            <input type="text" name="TenLop" value="{{ old('TenLop', $lop->TenLop) }}" required
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
                        {{ old('ChuyenNganhID', $lop->ChuyenNganhID) == $cn->ChuyenNganhID ? 'selected' : '' }}>
                        {{ $cn->TenChuyenNganh }}
                    </option>
                @endforeach
            </select>

            {{-- Chọn Giảng Viên --}}
            <label>Giảng Viên Chủ Nhiệm:</label>
            <select name="GiangVienID" style="width:100%; padding:10px; margin:5px 0;" required>
                <option value="">-- Chọn giảng viên --</option>
                @foreach ($dsGiangVien as $gv)
                    <option value="{{ $gv->GiangVienID }}" 
                        {{ old('GiangVienID', $lop->GiangVienID) == $gv->GiangVienID ? 'selected' : '' }}>
                        {{ $gv->HoTen }} ({{ $gv->MaGV }})
                    </option>
                @endforeach
            </select>

            <button type="submit"
                style="background:#e67e22; color:white; padding:10px; width:100%; border:none; margin-top:10px; cursor:pointer;">
                Cập Nhật
            </button>
        </form>
    </div>
@endsection