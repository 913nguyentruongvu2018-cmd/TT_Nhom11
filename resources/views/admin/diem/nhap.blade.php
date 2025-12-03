@extends('layouts.admin')

@section('noidung')
    <div class="card" style="width: 500px; margin: 0 auto;">
        <h2>📝 Nhập Điểm Sinh Viên</h2>

        @if (session('success'))
            <div
                style="background:#d4edda; color:#155724; padding:10px; margin-bottom:15px; border-radius:4px; text-align:center;">
                ✅ {{ session('success') }}
            </div>
        @endif

        <form action="/admin/diem/nhap" method="POST">
            @csrf

            <label style="font-weight:bold;">Chọn Sinh Viên:</label>
            <select name="SinhVienID"
                style="width:100%; padding:10px; margin:5px 0 15px 0; border:1px solid #ddd; border-radius:4px;">
                @foreach ($sinhvien as $sv)
                    <option value="{{ $sv->id }}">{{ $sv->MaSV }} - {{ $sv->HoTen }}</option>
                @endforeach
            </select>

            <label style="font-weight:bold;">Chọn Môn Học:</label>
            <select name="MonHocID"
                style="width:100%; padding:10px; margin:5px 0 15px 0; border:1px solid #ddd; border-radius:4px;">
                @foreach ($monhoc as $mh)
                    <option value="{{ $mh->MonHocID }}">{{ $mh->TenMonHoc }}</option>
                @endforeach
            </select>

            <label style="font-weight:bold;">Điểm Số (0 - 10):</label>
            <input type="number" name="DiemSo" step="0.1" min="0" max="10" required
                placeholder="Nhập số điểm..."
                style="width:100%; padding:10px; margin:5px 0 5px 0; border:1px solid #ddd; border-radius:4px;">

            @error('DiemSo')
                <div style="color:red; text-align:right; font-size:13px; font-style:italic;">⚠️ {{ $message }}</div>
            @enderror

            <button type="submit"
                style="background:#2ecc71; color:white; padding:12px; width:100%; border:none; margin-top:20px; cursor:pointer; font-weight:bold; font-size:16px; border-radius:4px;">
                Lưu Điểm
            </button>
        </form>
    </div>
@endsection
