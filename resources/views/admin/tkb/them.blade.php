@extends('layouts.admin')

@section('noidung')
    <div class="card" style="width: 600px; margin: 0 auto;">
        <a href="/admin/tkb">← Quay lại</a>
        <h2>Xếp Lịch Học Mới</h2>

        <form action="/admin/tkb/them" method="POST">
            @csrf
            
            <div style="display:flex; gap:20px;">
                <div style="flex:1;">
                    <label>Lớp Học:</label>
                    <select name="LopID" style="width:100%; padding:10px; margin:5px 0;">
                        @foreach($lops as $lop)
                            <option value="{{ $lop->LopID }}">{{ $lop->TenLop }}</option>
                        @endforeach
                    </select>
                    @error('LopID')
                        <div style="color:red; font-size:13px; margin-top:2px;">⚠️ {{ $message }}</div>
                    @enderror
                </div>
                <div style="flex:1;">
                    <label>Môn Học:</label>
                    <select name="MonHocID" style="width:100%; padding:10px; margin:5px 0;">
                        @foreach($mons as $mon)
                            <option value="{{ $mon->MonHocID }}">{{ $mon->TenMonHoc }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <label>Giảng Viên Dạy:</label>
            <select name="GiangVienID" style="width:100%; padding:10px; margin:5px 0;">
                @foreach($gvs as $gv)
                    <option value="{{ $gv->GiangVienID }}">{{ $gv->HoTen }} ({{ $gv->MaGV }})</option>
                @endforeach
            </select>
            @error('GiangVienID')
                <div style="color:red; font-size:13px; margin-top:2px;">⚠️ {{ $message }}</div>
            @enderror

            <div style="display:flex; gap:20px;">
                <div style="flex:1;">
                    <label>Thứ Trong Tuần:</label>
                    <select name="ThuTrongTuan" style="width:100%; padding:10px; margin:5px 0;">
                        <option value="Hai">Thứ Hai</option>
                        <option value="Ba">Thứ Ba</option>
                        <option value="Tu">Thứ Tư</option>
                        <option value="Nam">Thứ Năm</option>
                        <option value="Sau">Thứ Sáu</option>
                        <option value="Bay">Thứ Bảy</option>
                    </select>
                </div>
                <div style="flex:1;">
                    <label>Phòng Học:</label>
                    <input type="text" name="PhongHoc" required placeholder="VD: A101" style="width:100%; padding:10px; margin:5px 0;">
                    @error('PhongHoc')
                        <div style="color:red; font-size:13px; margin-top:2px;">⚠️ {{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div style="display:flex; gap:20px;">
                <div style="flex:1;">
                    <label>Giờ Bắt Đầu:</label>
                    <input type="time" name="GioBatDau" required style="width:100%; padding:10px; margin:5px 0;">
                </div>
                <div style="flex:1;">
                    <label>Giờ Kết Thúc:</label>
                    <input type="time" name="GioKetThuc" required style="width:100%; padding:10px; margin:5px 0;">
                </div>
            </div>
            @error('GioKetThuc') <div style="color:red">{{ $message }}</div> @enderror

            <button type="submit" style="background:green; color:white; padding:10px; width:100%; border:none; margin-top:20px; cursor:pointer;">Lưu Thời Khóa Biểu</button>
        </form>
    </div>
@endsection