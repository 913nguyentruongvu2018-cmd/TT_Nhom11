@extends('layouts.admin')

@section('noidung')
    <div class="card">
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom: 20px;">
            <h1>🎓 Thêm Sinh Viên Mới</h1>
            <a href="/admin/sinh-vien" style="background:#6c757d; color:white; padding:8px 15px; text-decoration:none; border-radius:4px;">
                ← Quay lại
            </a>
        </div>

        {{-- hien thi loi all --}}
        @if($errors->any())
            <div style="background:#f8d7da; color:red; padding:10px; margin-bottom:15px; border-radius:4px; border:1px solid #f5c6cb;">
                ⚠️ Vui lòng kiểm tra lại dữ liệu nhập bên dưới.
            </div>
        @endif

        <form action="/admin/sinh-vien/them" method="POST" novalidate>
            @csrf
            
            <table border="1" cellpadding="15" cellspacing="0" style="width:100%; border-collapse:collapse; border:1px solid #ddd; margin-bottom:20px;">
                <thead>
                    <tr style="background:#2980b9; color:white;">
                        <th style="width: 250px;">Thông Tin</th>
                        <th>Dữ Liệu Nhập</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- masv --}}
                    <tr>
                        <td style="font-weight:bold; background:#f9f9f9;">Mã Sinh Viên (*)</td>
                        <td>
                            <input type="text" name="MaSV" value="{{ old('MaSV') }}" required placeholder="VD: DH52201234"
                                   style="width:100%; padding:8px; border:1px solid #ccc; border-radius:4px;">
                            <div style="font-size:12px; color:#666; margin-top:5px; font-style:italic;">Mã sinh viên là duy nhất.</div>
                            @error('MaSV') <div style="color:red; font-size:13px; margin-top:5px;">⚠️ {{ $message }}</div> @enderror
                        </td>
                    </tr>

                    {{-- ho ten --}}
                    <tr>
                        <td style="font-weight:bold; background:#f9f9f9;">Họ và Tên (*)</td>
                        <td>
                            <input type="text" name="HoTen" value="{{ old('HoTen') }}" required placeholder="VD: Nguyễn Văn A"
                                   style="width:100%; padding:8px; border:1px solid #ccc; border-radius:4px;">
                            @error('HoTen') <div style="color:red; font-size:13px; margin-top:5px;">⚠️ {{ $message }}</div> @enderror
                        </td>
                    </tr>

                    {{-- lop hoc --}}
                    <tr>
                        <td style="font-weight:bold; background:#f9f9f9;">Lớp Học (*)</td>
                        <td>
                            <select name="LopID" style="width:100%; padding:8px; border:1px solid #ccc; border-radius:4px;" required>
                                <option value="">-- Chọn Lớp --</option>
                                @foreach($dsLop as $lop)
                                    <option value="{{ $lop->LopID }}" {{ old('LopID') == $lop->LopID ? 'selected' : '' }}>
                                        {{ $lop->TenLop }}
                                    </option>
                                @endforeach
                            </select>
                            @error('LopID') <div style="color:red; font-size:13px; margin-top:5px;">⚠️ {{ $message }}</div> @enderror
                        </td>
                    </tr>

                    {{-- ngay sinh --}}
                    <tr>
                        <td style="font-weight:bold; background:#f9f9f9;">Ngày Sinh (*)</td>
                        <td>
                            <input type="date" name="NgaySinh" value="{{ old('NgaySinh') }}" required
                                   style="width:100%; padding:8px; border:1px solid #ccc; border-radius:4px;">
                            @error('NgaySinh') <div style="color:red; font-size:13px; margin-top:5px;">⚠️ {{ $message }}</div> @enderror
                        </td>
                    </tr>
                </tbody>
            </table>

            <div style="text-align: right;">
                <button type="submit" style="background:#28a745; color:white; padding:12px 40px; border:none; border-radius:4px; cursor:pointer; font-weight:bold; font-size:16px; box-shadow: 0 2px 5px rgba(0,0,0,0.2);">
                    💾 LƯU SINH VIÊN
                </button>
            </div>
        </form>
    </div>
@endsection