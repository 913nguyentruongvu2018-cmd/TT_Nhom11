@extends('layouts.admin')

@section('noidung')
    <div class="card">
        <h1>Quản Lý Thời Khóa Biểu</h1>
        
        {{-- khung tim kiem va loc --}}
        <div style="background:#f1f1f1; padding:15px; border-radius:5px; margin-bottom:20px; border:1px solid #ddd;">
            <form action="/admin/tkb" method="GET" style="display:flex; gap:10px; flex-wrap:wrap; align-items:center;">
                
                {{-- tim tu khoa--}}
                <input type="text" name="tu_khoa" value="{{ request('tu_khoa') }}" placeholder="Nhập tên môn hoặc giảng viên..." 
                       style="padding:8px; border:1px solid #ccc; border-radius:4px; width:250px;">

                {{-- loc lop --}}
                <select name="LopID" style="padding:8px; border:1px solid #ccc; border-radius:4px;">
                    <option value="">-- Tất cả lớp --</option>
                    @foreach($dslop as $lop)
                        <option value="{{ $lop->LopID }}" {{ request('LopID') == $lop->LopID ? 'selected' : '' }}>
                            {{ $lop->TenLop }}
                        </option>
                    @endforeach
                </select>

                {{-- loc thu --}}
                <select name="ThuTrongTuan" style="padding:8px; border:1px solid #ccc; border-radius:4px;">
                    <option value="">-- Tất cả thứ --</option>
                    <option value="Hai" {{ request('ThuTrongTuan') == 'Hai' ? 'selected' : '' }}>Thứ Hai</option>
                    <option value="Ba" {{ request('ThuTrongTuan') == 'Ba' ? 'selected' : '' }}>Thứ Ba</option>
                    <option value="Tu" {{ request('ThuTrongTuan') == 'Tu' ? 'selected' : '' }}>Thứ Tư</option>
                    <option value="Nam" {{ request('ThuTrongTuan') == 'Nam' ? 'selected' : '' }}>Thứ Năm</option>
                    <option value="Sau" {{ request('ThuTrongTuan') == 'Sau' ? 'selected' : '' }}>Thứ Sáu</option>
                    <option value="Bay" {{ request('ThuTrongTuan') == 'Bay' ? 'selected' : '' }}>Thứ Bảy</option>
                </select>

                <button type="submit" style="background:#007bff; color:white; border:none; padding:8px 15px; border-radius:4px; cursor:pointer;">🔍 Tìm kiếm</button>
                <a href="/admin/tkb" style="color:#666; text-decoration:none; margin-left:5px;">❌ Xóa lọc</a>
            </form>
        </div>

        <a href="/admin/tkb/them" style="background:green; color:white; padding:10px; text-decoration:none; border-radius:5px; margin-bottom:15px; display:inline-block;">+ Xếp Lịch Học Mới</a>

        @php
            $mapThu = ['Hai' => 'Thứ Hai', 'Ba' => 'Thứ Ba', 'Tu' => 'Thứ Tư', 'Nam' => 'Thứ Năm', 'Sau' => 'Thứ Sáu', 'Bay' => 'Thứ Bảy', 'CN' => 'Chủ Nhật'];
        @endphp

        <table border="1" cellpadding="10" cellspacing="0" style="width:100%; border-collapse:collapse; border:1px solid #ddd;">
            <thead style="background:#2980b9; color:white;">
                <tr>
                    <th>Thứ</th>
                    <th>Lớp</th>
                    <th>Môn Học</th>
                    <th>Giảng Viên</th>
                    <th>Thời Gian</th>
                    <th>Phòng</th>
                    <th>Hành Động</th>
                </tr>
            </thead>
            <tbody>
                @foreach($dsTKB as $tkb)
                <tr style="border-bottom: 1px solid #ddd;">
                    <td style="font-weight:bold; color:#d35400;">{{ $mapThu[$tkb->ThuTrongTuan] ?? $tkb->ThuTrongTuan }}</td>
                    <td style="color:blue; font-weight:bold;">{{ $tkb->lopHoc->TenLop }}</td>
                    <td>{{ $tkb->monHoc->TenMonHoc }}</td>
                    <td>{{ $tkb->giangVien->HoTen }}</td>
                    <td>{{ date('H:i', strtotime($tkb->GioBatDau)) }} - {{ date('H:i', strtotime($tkb->GioKetThuc)) }}</td>
                    <td style="font-weight:bold; color:red;">{{ $tkb->PhongHoc }}</td>
                    
                    <td style="white-space:nowrap;">
                        <a href="/admin/tkb/sua/{{ $tkb->TKBid }}" 
                           style="color:#007bff; font-weight:bold; text-decoration:none; border:1px solid #007bff; padding:3px 8px; border-radius:4px; margin-right:5px;">
                           Sửa
                        </a>

                        <a href="/admin/tkb/xoa/{{ $tkb->TKBid }}" 
                           style="color:red; font-weight:bold; text-decoration:none; border:1px solid red; padding:3px 8px; border-radius:4px;"
                           onclick="return confirm('Xóa lịch học này?');">
                           Xóa
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        
        
        <div style="margin-top:15px;">
            {{ $dsTKB->appends(request()->all())->links('phantrang') }}
        </div>
    </div>
@endsection