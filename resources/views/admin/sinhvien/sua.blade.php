@extends('layouts.admin')

@section('noidung')
    <div class="card">
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom: 20px;">
            <h1>✏️ Cập Nhật Sinh Viên</h1>
            <a href="/admin/sinh-vien" style="background:#6c757d; color:white; padding:8px 15px; text-decoration:none; border-radius:4px;">
                ← Quay lại
            </a>
        </div>
        @if($errors->any())
            <div style="background:#f8d7da; color:red; padding:10px; margin-bottom:15px; border-radius:4px; border:1px solid #f5c6cb;">
                ⚠️ Vui lòng kiểm tra lại dữ liệu nhập bên dưới.
            </div>
        @endif
        <form action="/admin/sinh-vien/sua/{{ $sv->id }}" method="POST" novalidate>
            @csrf
            
            <table border="1" cellpadding="15" cellspacing="0" style="width:100%; border-collapse:collapse; border:1px solid #ddd; margin-bottom:20px;">
                <thead>
                    <tr style="background:#2980b9; color:white;">
                        <th style="width: 250px;">Thông Tin</th>
                        <th>Dữ Liệu Cập Nhật</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- masv --}}
                    <tr>
                        <td style="font-weight:bold; background:#f9f9f9;">Mã Sinh Viên</td>
                        <td>
                            <input type="text" name="MaSV" value="{{ $sv->MaSV }}" readonly
                                   style="width:100%; padding:8px; border:1px solid #ccc; border-radius:4px; background:#e9ecef; font-weight:bold; color:#666; cursor:not-allowed;">
                            <div style="font-size:12px; color:#666; margin-top:5px;">🔒 Mã sinh viên không được phép thay đổi.</div>
                        </td>
                    </tr>

                    {{-- ten --}}
                    <tr>
                        <td style="font-weight:bold; background:#f9f9f9;">Họ và Tên</td>
                        <td>
                            <input type="text" name="HoTen" value="{{ old('HoTen', $sv->HoTen) }}" required 
                                   style="width:100%; padding:8px; border:1px solid #ccc; border-radius:4px;">
                            @error('HoTen') <div style="color:red; font-size:13px; margin-top:5px;">⚠️ {{ $message }}</div> @enderror
                        </td>
                    </tr>

                    {{-- lop --}}
                    <tr>
                        <td style="font-weight:bold; background:#f9f9f9;">Lớp Học</td>
                        <td>
                            <select name="Lop" style="width:100%; padding:8px; border:1px solid #ccc; border-radius:4px;" required>
                                <option value="">-- Chọn Lớp --</option>
                                @foreach($dsLop as $lop)
                                    <option value="{{ $lop->LopID }}" {{ old('Lop', $sv->Lop) == $lop->LopID ? 'selected' : '' }}>
                                        {{ $lop->TenLop }}
                                    </option>
                                @endforeach
                            </select>
                            @error('Lop') <div style="color:red; font-size:13px; margin-top:5px;">⚠️ {{ $message }}</div> @enderror
                        </td>
                    </tr>

                    {{-- ngay sinh --}}
                    <tr>
                        <td style="font-weight:bold; background:#f9f9f9;">Ngày Sinh</td>
                        <td>
                            <input type="date" name="NgaySinh" value="{{ old('NgaySinh', $sv->NgaySinh) }}" required
                                   style="width:100%; padding:8px; border:1px solid #ccc; border-radius:4px;">
                            @error('NgaySinh') <div style="color:red; font-size:13px; margin-top:5px;">⚠️ {{ $message }}</div> @enderror
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