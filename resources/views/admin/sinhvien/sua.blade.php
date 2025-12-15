@extends('layouts.admin')

@section('noidung')
    <div class="card" style="width: 500px; margin: 0 auto;">
        <a href="/admin/sinh-vien">← Quay lại</a>
        <h2>Cập Nhật Sinh Viên</h2>

        <form action="/admin/sinh-vien/sua/{{ $sv->MaSV }}" method="POST">
            @csrf
            @method('POST')

            <label>Mã Sinh Viên:</label>
            <input type="text" name="MaSV" value="{{ $sv->MaSV }}" readonly
                style="width:100%; padding:10px; margin:5px 0; background-color: #eee; cursor: not-allowed;">

            <label>Họ Tên:</label>
            <input type="text" name="HoTen" value="{{ old('HoTen', $sv->HoTen) }}" required
                style="width:100%; padding:10px; margin:5px 0;">

           <label>Lớp:</label>

            <select name="Lop" required style="width:100%; padding:10px; margin:5px 0 15px 0;">

                <option value="">-- Chọn Lớp Học --</option>

                @foreach ($dsLop as $lop)

                    <option value="{{ $lop->LopID }}" {{ old('Lop', $sv->Lop) == $lop->LopID ? 'selected' : '' }}>

                        {{ $lop->TenLop }}

                    </option>

                @endforeach

            </select>

            <label>Ngày Sinh:</label>
            <input type="date" name="NgaySinh" value="{{ old('NgaySinh', $sv->NgaySinh) }}" required
                style="width:100%; padding:10px; margin:5px 0;">

            <button type="submit"
                style="background:#e67e22; color:white; padding:10px; width:100%; border:none; margin-top:10px; cursor:pointer;">
                Cập Nhật
            </button>
        </form>
    </div>
@endsection