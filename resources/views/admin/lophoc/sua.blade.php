@extends('layouts.admin')

@section('noidung')
    <div class="card" style="width: 500px; margin: 0 auto;">
        <a href="/admin/lop-hoc">← Quay lại</a>
        <h2>Cập Nhật Lớp Học</h2>

        <form action="/admin/lop-hoc/sua/{{ $lop->LopID }}" method="POST">
            @csrf

            <label>Tên Lớp:</label>
            <input type="text" name="TenLop" value="{{ $lop->TenLop }}" required
                style="width:100%; padding:10px; margin:5px 0;">
            @error('TenLop')
                <div style="color:red">{{ $message }}</div>
            @enderror

            <label>Giảng Viên Chủ Nhiệm:</label>
            <select name="GiangVienID" style="width:100%; padding:10px; margin:5px 0;">
                @foreach ($dsGiangVien as $gv)
                    <option value="{{ $gv->GiangVienID }}" {{ $lop->GiangVienID == $gv->GiangVienID ? 'selected' : '' }}>
                        {{ $gv->HoTen }} ({{ $gv->MaGV }})
                    </option>
                @endforeach
            </select>

            <button type="submit"
                style="background:#e67e22; color:white; padding:10px; width:100%; border:none; margin-top:10px; cursor:pointer;">Cập
                Nhật</button>
        </form>
    </div>
@endsection
