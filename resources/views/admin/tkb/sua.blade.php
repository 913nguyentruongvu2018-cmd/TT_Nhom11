@extends('layouts.admin')

@section('noidung')
    <div class="card">
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom: 20px;">
            <h1>✏️ Cập Nhật Lịch Học</h1>
            <a href="/admin/tkb" style="background:#6c757d; color:white; padding:8px 15px; text-decoration:none; border-radius:4px;">← Quay lại</a>
        </div>

        <form action="/admin/tkb/sua/{{ $tkb->TKBid }}" method="POST">
            @csrf
            
            <table border="1" cellpadding="15" cellspacing="0" style="width:100%; border-collapse:collapse; border:1px solid #ddd; margin-bottom:20px;">
                <thead>
                    <tr style="background:#2980b9; color:white;">
                        <th style="width: 200px;">Thông Tin</th>
                        <th>Chi Tiết</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- lop hoc --}}
                    <tr>
                        <td style="font-weight:bold; background:#f9f9f9;">Lớp Học</td>
                        <td>
                            <select name="LopID" style="width:100%; padding:8px;">
                                @foreach($lops as $lop)
                                    <option value="{{ $lop->LopID }}" {{ $tkb->LopID == $lop->LopID ? 'selected' : '' }}>
                                        {{ $lop->TenLop }}
                                    </option>
                                @endforeach
                            </select>
                        </td>
                    </tr>

                    {{-- mon hoc --}}
                    <tr>
                        <td style="font-weight:bold; background:#f9f9f9;">Môn Học</td>
                        <td>
                            <select name="MonHocID" style="width:100%; padding:8px;">
                                @foreach($mons as $mon)
                                    <option value="{{ $mon->MonHocID }}" {{ $tkb->MonHocID == $mon->MonHocID ? 'selected' : '' }}>
                                        {{ $mon->TenMonHoc }} ({{ $mon->SoTinChi }} tín chỉ)
                                    </option>
                                @endforeach
                            </select>
                        </td>
                    </tr>

                    {{-- giang vien --}}
                    <tr>
                        <td style="font-weight:bold; background:#f9f9f9;">Giảng Viên</td>
                        <td>
                            <select name="GiangVienID" style="width:100%; padding:8px;">
                                @foreach($gvs as $gv)
                                    <option value="{{ $gv->GiangVienID }}" {{ $tkb->GiangVienID == $gv->GiangVienID ? 'selected' : '' }}>
                                        {{ $gv->HoTen }}
                                    </option>
                                @endforeach
                            </select>
                        </td>
                    </tr>

                    {{-- thu & phong --}}
                    <tr>
                        <td style="font-weight:bold; background:#f9f9f9;">Thứ & Phòng</td>
                        <td>
                            <div style="display:flex; gap:15px;">
                                <select name="ThuTrongTuan" style="flex:1; padding:8px;">
                                    @foreach(['Hai'=>'Thứ Hai', 'Ba'=>'Thứ Ba', 'Tu'=>'Thứ Tư', 'Nam'=>'Thứ Năm', 'Sau'=>'Thứ Sáu', 'Bay'=>'Thứ Bảy', 'CN'=>'Chủ Nhật'] as $key => $val)
                                        <option value="{{ $key }}" {{ $tkb->ThuTrongTuan == $key ? 'selected' : '' }}>{{ $val }}</option>
                                    @endforeach
                                </select>
                                <input type="text" name="PhongHoc" value="{{ $tkb->PhongHoc }}" required placeholder="Phòng học" style="flex:1; padding:8px;">
                            </div>
                        </td>
                    </tr>

                    {{-- thoi gian hoc --}}
                    <tr>
                        <td style="font-weight:bold; background:#fff3cd; color:#856404;">Thời Gian</td>
                        <td style="background:#fff3cd;">
                            <div style="display:flex; align-items:center; gap:10px;">
                                <span>Từ:</span>
                                <input type="time" name="GioBatDau" value="{{ $tkb->GioBatDau }}" required style="padding:8px; border:2px solid #e67e22; font-weight:bold;">
                                <span>Đến:</span>
                                <input type="time" name="GioKetThuc" value="{{ $tkb->GioKetThuc }}" required style="padding:8px; border:2px solid #e67e22; font-weight:bold;">
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>

            <div style="text-align: right;">
                <button type="submit" style="background:#e67e22; color:white; padding:12px 40px; border:none; border-radius:4px; cursor:pointer; font-weight:bold;">
                    💾 LƯU CẬP NHẬT
                </button>
            </div>
        </form>
    </div>
@endsection