<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Bảng Điểm Cá Nhân</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            padding-top: 50px;
        }

        .card {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border: none;
            border-radius: 10px;
        }

        .header-title {
            color: #007bff;
            font-weight: bold;
            text-transform: uppercase;
        }

        .table th {
            background-color: #007bff;
            color: white;
        }

        .pass {
            color: green;
            font-weight: bold;
        }

        .fail {
            color: red;
            font-weight: bold;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="card p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="header-title">🎓 Bảng Điểm Cá Nhân</h2>

                <form action="/dang-xuat" method="POST" class="logout-form">
                    @csrf
                    <button type="submit" class="logout-btn"
                        onclick="return confirm('Bạn có chắc chắn muốn đăng xuất khỏi hệ thống không?');">>Đăng
                        Xuất</button>
                </form>
            </div>

            @php
                $tongDiemNhanTinChi = 0;
                $tongTinChi = 0;
            @endphp

            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Môn Học</th>
                        <th class="text-center">Số Tín Chỉ</th>
                        <th class="text-center">Điểm Số (Hệ 10)</th>
                        <th class="text-center">Trạng Thái</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($bangDiem as $diem)
                        @php
                            // Cộng dồn để tính trung bình
                            $tongDiemNhanTinChi += $diem->DiemSo * $diem->monHoc->SoTinChi;
                            $tongTinChi += $diem->monHoc->SoTinChi;
                        @endphp
                        <tr>
                            <td>{{ $diem->monHoc->TenMonHoc }}</td>
                            <td class="text-center">{{ $diem->monHoc->SoTinChi }}</td>

                            <td class="text-center fw-bold {{ $diem->DiemSo >= 5 ? 'text-success' : 'text-danger' }}">
                                {{ $diem->DiemSo }}
                            </td>

                            <td class="text-center">
                                @if ($diem->DiemSo >= 5)
                                    <span class="badge bg-success">Đạt</span>
                                @else
                                    <span class="badge bg-danger">Học lại</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            @if ($tongTinChi > 0)
                @php
                    $dtb = round($tongDiemNhanTinChi / $tongTinChi, 2);

                    // Xếp loại
                    if ($dtb >= 9) {
                        $xepLoai = 'Xuất sắc';
                    } elseif ($dtb >= 8) {
                        $xepLoai = 'Giỏi';
                    } elseif ($dtb >= 6.5) {
                        $xepLoai = 'Khá';
                    } elseif ($dtb >= 5) {
                        $xepLoai = 'Trung bình';
                    } else {
                        $xepLoai = 'Yếu';
                    }
                @endphp

                <div class="alert alert-info mt-3">
                    <h4 class="mb-0">📊 Tổng Kết Học Tập:</h4>
                    <hr>
                    <p>Tổng số tín chỉ tích lũy: <strong>{{ $tongTinChi }}</strong></p>
                    <p>Điểm Trung Bình (GPA): <strong
                            style="font-size: 20px; color: #d63384;">{{ $dtb }}</strong></p>
                    <p>Xếp Loại: <span class="badge bg-primary" style="font-size: 16px;">{{ $xepLoai }}</span></p>
                </div>
            @else
                <p class="text-center text-muted">Chưa có dữ liệu điểm.</p>
            @endif

        </div>
    </div>

</body>

</html>
