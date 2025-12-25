@extends('layouts.admin')

@section('noidung')
    <div class="card">
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom: 20px;">
            <h1>📅 Xếp Lịch Học Mới</h1>
            <a href="/admin/tkb" style="background:#6c757d; color:white; padding:8px 15px; text-decoration:none; border-radius:4px;">
                ← Quay lại
            </a>
        </div>

        {{-- hien loi all --}}
        @if($errors->any())
            <div style="background:#f8d7da; color:red; padding:10px; margin-bottom:15px; border-radius:4px; border:1px solid #f5c6cb;">
                ⚠️ Vui lòng kiểm tra lại dữ liệu nhập bên dưới.
            </div>
        @endif

        <form action="/admin/tkb/them" method="POST" novalidate>
            @csrf
            
            <table border="1" cellpadding="15" cellspacing="0" style="width:100%; border-collapse:collapse; border:1px solid #ddd; margin-bottom:20px;">
                <thead>
                    <tr style="background:#2980b9; color:white;">
                        <th style="width: 200px;">Thông Tin</th>
                        <th>Chi Tiết Xếp Lịch</th>
                    </tr>
                </thead>
                <tbody>
                    
                    {{-- lop --}}
                    <tr>
                        <td style="font-weight:bold; background:#f9f9f9;">Lớp Học</td>
                        <td>
                            <select name="LopID" style="width:100%; padding:8px; border:1px solid #ccc; border-radius:4px;">
                                <option value="">-- Chọn Lớp --</option>
                                @foreach($lops as $lop)
                                    <option value="{{ $lop->LopID }}" {{ old('LopID') == $lop->LopID ? 'selected' : '' }}>
                                        {{ $lop->TenLop }}
                                    </option>
                                @endforeach
                            </select>
                            @error('LopID') <div style="color:red; font-size:13px; margin-top:5px;">⚠️ {{ $message }}</div> @enderror
                        </td>
                    </tr>

                    {{-- mon --}}
                    <tr>
                        <td style="font-weight:bold; background:#f9f9f9;">Môn Học</td>
                        <td>
                            <select name="MonHocID" style="width:100%; padding:8px; border:1px solid #ccc; border-radius:4px;">
                                <option value="">-- Chọn Môn Học --</option>
                                @foreach($mons as $mon)
                                    <option value="{{ $mon->MonHocID }}" {{ old('MonHocID') == $mon->MonHocID ? 'selected' : '' }}>
                                        {{ $mon->TenMonHoc }} ({{ $mon->SoTinChi }} tín chỉ)
                                    </option>
                                @endforeach
                            </select>
                            @error('MonHocID') <div style="color:red; font-size:13px; margin-top:5px;">⚠️ {{ $message }}</div> @enderror
                        </td>
                    </tr>

                    {{-- gv--}}
                    <tr>
                        <td style="font-weight:bold; background:#f9f9f9;">Giảng Viên Dạy</td>
                        <td>
                            <select name="GiangVienID" style="width:100%; padding:8px; border:1px solid #ccc; border-radius:4px;">
                                <option value="">-- Chọn Giảng Viên --</option>
                                @foreach($gvs as $gv)
                                    <option value="{{ $gv->GiangVienID }}" {{ old('GiangVienID') == $gv->GiangVienID ? 'selected' : '' }}>
                                        {{ $gv->HoTen }} ({{ $gv->MaGV }})
                                    </option>
                                @endforeach
                            </select>
                            @error('GiangVienID') <div style="color:red; font-size:13px; margin-top:5px;">⚠️ {{ $message }}</div> @enderror
                        </td>
                    </tr>

                    {{-- thu & phong --}}
                    <tr>
                        <td style="font-weight:bold; background:#f9f9f9;">Thứ & Phòng</td>
                        <td>
                            <div style="display:flex; gap:15px;">
                                <div style="flex:1;">
                                    <label style="font-size:12px; color:#666; display:block; margin-bottom:3px;">Thứ trong tuần:</label>
                                    <select name="ThuTrongTuan" style="width:100%; padding:8px; border:1px solid #ccc; border-radius:4px;">
                                        <option value="">-- Chọn Thứ --</option>
                                        <option value="Hai" {{ old('ThuTrongTuan') == 'Hai' ? 'selected' : '' }}>Thứ Hai</option>
                                        <option value="Ba" {{ old('ThuTrongTuan') == 'Ba' ? 'selected' : '' }}>Thứ Ba</option>
                                        <option value="Tu" {{ old('ThuTrongTuan') == 'Tu' ? 'selected' : '' }}>Thứ Tư</option>
                                        <option value="Nam" {{ old('ThuTrongTuan') == 'Nam' ? 'selected' : '' }}>Thứ Năm</option>
                                        <option value="Sau" {{ old('ThuTrongTuan') == 'Sau' ? 'selected' : '' }}>Thứ Sáu</option>
                                        <option value="Bay" {{ old('ThuTrongTuan') == 'Bay' ? 'selected' : '' }}>Thứ Bảy</option>
                                    </select>
                                    @error('ThuTrongTuan') <div style="color:red; font-size:13px;">⚠️ {{ $message }}</div> @enderror
                                </div>
                                <div style="flex:1;">
                                    <label style="font-size:12px; color:#666; display:block; margin-bottom:3px;">Phòng học:</label>
                                    <input type="text" name="PhongHoc" value="{{ old('PhongHoc') }}" required placeholder="VD: A101" 
                                           style="width:100%; padding:8px; border:1px solid #ccc; border-radius:4px;">
                                    @error('PhongHoc') <div style="color:red; font-size:13px;">⚠️ {{ $message }}</div> @enderror
                                </div>
                            </div>
                        </td>
                    </tr>

                    {{-- thoi gian --}}
                    <tr>
                        <td style="font-weight:bold; background:#fff3cd; color:#856404;">Thời Gian Học</td>
                        <td style="background:#fff3cd;">
                            <div style="display:flex; align-items:center; gap:10px;">
                                <div style="flex:1;">
                                    <span style="font-weight:bold; color:#856404;">Từ:</span>
                                    <input type="time" name="GioBatDau" value="{{ old('GioBatDau') }}" required 
                                           style="width:100%; padding:8px; border:2px solid #e67e22; border-radius:4px; font-weight:bold; color:#e67e22;">
                                </div>
                                <span style="font-weight:bold; color:#856404;">➜</span>
                                <div style="flex:1;">
                                    <span style="font-weight:bold; color:#856404;">Đến:</span>
                                    <input type="time" name="GioKetThuc" value="{{ old('GioKetThuc') }}" required 
                                           style="width:100%; padding:8px; border:2px solid #e67e22; border-radius:4px; font-weight:bold; color:#e67e22;">
                                </div>
                            </div>
                             @error('GioKetThuc') <div style="color:red; font-size:13px; margin-top:5px; font-weight:bold;">⚠️ {{ $message }}</div> @enderror
                             @error('GioBatDau') <div style="color:red; font-size:13px; margin-top:5px;">⚠️ {{ $message }}</div> @enderror
                        </td>
                    </tr>

                </tbody>
            </table>

            <div style="text-align: right;">
                <button type="submit" style="background:#28a745; color:white; padding:12px 40px; border:none; border-radius:4px; cursor:pointer; font-weight:bold; font-size:16px; box-shadow: 0 2px 5px rgba(0,0,0,0.2);">
                    💾 LƯU THỜI KHÓA BIỂU
                </button>
            </div>
        </form>
    </div>
@endsection