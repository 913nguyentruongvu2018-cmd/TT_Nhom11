@extends('layouts.admin')

@section('noidung')
    <div class="card">
        <h1>Tổng Quan Hệ Thống</h1>
        <p style="margin-bottom: 20px; color:#666;">Chào mừng quay trở lại, hệ thống đang hoạt động ổn định.</p>

        {{-- thong ke--}}
        <h3 style="color:#2980b9; margin-bottom: 10px; border-bottom: 2px solid #eee; padding-bottom:5px;">📊 Thống Kê Nhanh</h3>
        <table border="1" cellpadding="15" cellspacing="0" style="width:100%; border-collapse:collapse; border:1px solid #ddd; margin-bottom:30px; text-align:center;">
            <thead>
                <tr style="background:#2980b9; color:white;">
                    <th style="width: 25%;">👨‍🎓 Sinh Viên</th>
                    <th style="width: 25%;">👨‍🏫 Giảng Viên</th>
                    <th style="width: 25%;">📚 Môn Học</th>
                    <th style="width: 25%;">🏫 Lớp Học</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <div style="font-size:30px; font-weight:bold; color:#2980b9;">{{ $soSV }}</div>
                        <div style="color:#666; font-size:13px;">Hồ sơ lưu trữ</div>
                    </td>
                    <td>
                        <div style="font-size:30px; font-weight:bold; color:#27ae60;">{{ $soGV }}</div>
                        <div style="color:#666; font-size:13px;">Đang giảng dạy</div>
                    </td>
                    <td>
                        <div style="font-size:30px; font-weight:bold; color:#f39c12;">{{ $soMon }}</div>
                        <div style="color:#666; font-size:13px;">Môn đào tạo</div>
                    </td>
                    <td>
                        <div style="font-size:30px; font-weight:bold; color:#c0392b;">{{ $soLop }}</div>
                        <div style="color:#666; font-size:13px;">Lớp đang mở</div>
                    </td>
                </tr>
            
                <tr style="background:#f9f9f9;">
                    <td><a href="/admin/sinh-vien" style="text-decoration:none; color:#2980b9; font-weight:bold;">Xem danh sách →</a></td>
                    <td><a href="/admin/giang-vien" style="text-decoration:none; color:#2980b9; font-weight:bold;">Xem danh sách →</a></td>
                    <td><a href="/admin/mon-hoc" style="text-decoration:none; color:#2980b9; font-weight:bold;">Xem danh sách →</a></td>
                    <td><a href="/admin/lop-hoc" style="text-decoration:none; color:#2980b9; font-weight:bold;">Xem danh sách →</a></td>
                </tr>
            </tbody>
        </table>

        

        {{-- bang tt --}}
        <div style="display:flex; gap:20px; flex-wrap:wrap;">
            
            {{-- sinh vien --}}
            <div style="flex:1; min-width:300px;">
                <h3 style="color:#2980b9; margin-bottom: 10px;">🎓 Sinh Viên Mới Nhập Học</h3>
                <table border="1" cellpadding="10" cellspacing="0" style="width:100%; border-collapse:collapse; border:1px solid #ddd;">
                    <thead>
                        <tr style="background:#2980b9; color:white;">
                            <th>Mã SV</th>
                            <th>Họ Tên</th>
                            <th>Lớp</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($svMoi as $sv)
                        <tr style="border-bottom: 1px solid #eee;">
                            <td style="font-weight:bold; color:#555;">{{ $sv->MaSV }}</td>
                            <td>{{ $sv->HoTen }}</td>
                            <td><span style="background:#e1f5fe; color:#0277bd; padding:2px 6px; border-radius:4px; font-size:11px;">{{ $sv->lopHoc->TenLop ?? 'Chưa xếp' }}</span></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- lop hoc --}}
            <div style="flex:1; min-width:300px;">
                <h3 style="color:#d35400; margin-bottom: 10px;">🏫 Lớp Học Mới Mở</h3>
                <table border="1" cellpadding="10" cellspacing="0" style="width:100%; border-collapse:collapse; border:1px solid #ddd;">
                    <thead>
                        <tr style="background:#d35400; color:white;">
                            <th>Tên Lớp</th>
                            <th>Chuyên Ngành</th>
                            <th>Năm Học</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($lopMoi as $lop)
                        <tr style="border-bottom: 1px solid #eee;">
                            <td style="font-weight:bold; color:blue;">{{ $lop->TenLop }}</td>
                            <td>{{ $lop->chuyenNganh->TenChuyenNganh ?? '...' }}</td>
                            <td>{{ $lop->NamHoc }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection