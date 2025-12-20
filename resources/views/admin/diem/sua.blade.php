@extends('layouts.admin')

@section('noidung')
<div class="card" style="width: 500px; margin: 0 auto;">
    <a href="/admin/diem">← Quay lại danh sách</a>
    <h2>Cập Nhật Điểm Số</h2>

    <form action="/admin/diem/sua/{{ $diem->DiemID }}" method="POST">
        @csrf

        {{-- Hiển thị thông tin (Không cho sửa, chỉ xem) --}}
        <div style="background:#eee; padding:10px; border-radius:5px; margin-bottom:15px;">
            <p><strong>Sinh Viên:</strong> {{ $diem->sinhVien->HoTen }} ({{ $diem->sinhVien->MaSV }})</p>
            <p><strong>Môn Học:</strong> {{ $diem->monHoc->TenMonHoc }}</p>
            <p><strong>Học Kỳ:</strong> <span style="color:blue; font-weight:bold;">{{ $diem->HocKy }}</span></p>
            <p><strong>Số Tín Chỉ:</strong> {{ $diem->monHoc->SoTinChi }}</p>
        </div>

        

        <label style="font-weight:bold;">Điểm Số Mới:</label>
        <input type="number" name="DiemSo" step="0.1" min="0" max="10" required
            value="{{ $diem->DiemSo }}"
            style="width:100%; padding:10px; margin:5px 0 15px 0; border:1px solid #ccc; font-size:16px;">

        @error('DiemSo')
        <div style="color:red">{{ $message }}</div>
        @enderror

        <button type="submit"
            style="background:#e67e22; color:white; padding:10px; width:100%; border:none; cursor:pointer; font-weight:bold;">
            Cập Nhật Điểm
        </button>
    </form>
</div>
@endsection