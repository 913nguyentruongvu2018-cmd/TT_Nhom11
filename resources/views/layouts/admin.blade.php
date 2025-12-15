<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; /* Font chữ đẹp hơn */
            display: flex;
            height: 100vh;
        }

        .sidebar {
            width: 260px; /* Rộng hơn xíu cho thoáng */
            background-color: #2c3e50;
            color: white;
            display: flex;
            flex-direction: column;
            overflow-y: auto; /* Cho phép cuộn nếu menu dài */
        }

        .sidebar-header {
            text-align: center;
            padding: 20px 0;
            background-color: #1a252f;
            border-bottom: 1px solid #34495e;
        }
        
        .sidebar-header h2 {
            margin: 0;
            font-size: 24px;
        }

        /* Style cho Tiêu đề nhóm (MỚI) */
        .menu-label {
            color: #95a5a6;
            text-transform: uppercase;
            font-size: 12px;
            font-weight: bold;
            padding: 15px 20px 5px 20px;
            margin-top: 5px;
            letter-spacing: 1px;
        }

        .sidebar a {
            padding: 12px 20px;
            color: #ecf0f1;
            text-decoration: none;
            display: flex; /* Canh icon và chữ thẳng hàng */
            align-items: center; 
            gap: 10px; /* Khoảng cách giữa icon và chữ */
            border-left: 4px solid transparent; /* Tạo hiệu ứng border trái */
            transition: all 0.3s;
        }

        .sidebar a:hover {
            background-color: #34495e;
            color: #fff;
        }

        .sidebar a.active {
            background-color: #2980b9; /* Màu xanh sáng hơn */
            border-left: 4px solid #3498db; /* Border nổi bật */
            font-weight: bold;
        }

        .logout-form {
            margin-top: auto; /* Đẩy xuống đáy */
            border-top: 1px solid #34495e;
        }

        .logout-btn {
            width: 100%;
            padding: 15px;
            background-color: #c0392b;
            color: white;
            border: none;
            cursor: pointer;
            font-size: 16px;
            text-align: left;
            padding-left: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: bold;
        }
        
        .logout-btn:hover {
            background-color: #e74c3c;
        }

        .content {
            flex: 1;
            padding: 20px;
            background-color: #ecf0f1;
            overflow-y: auto;
        }

        /* Giữ nguyên CSS card và table cũ của bạn */
        .card {
            background: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #2980b9;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>

    <div class="sidebar">
        <div class="sidebar-header">
            <h2>🎓 Admin Panel</h2>
        </div>

        {{-- NHÓM 1: TỔNG QUAN --}}
        <a href="/admin/dashboard" class="{{ Request::is('admin/dashboard') ? 'active' : '' }}">
            🏠 Trang chủ
        </a>

        {{-- NHÓM 2: QUẢN LÝ ĐÀO TẠO (Cấu trúc trường học) --}}
        <div class="menu-label">Đào Tạo & Học Vụ</div>
        
        <a href="/admin/chuyen-nganh" class="{{ Request::is('admin/chuyen-nganh*') ? 'active' : '' }}">
            🏢 Chuyên ngành
        </a>
        <a href="/admin/mon-hoc" class="{{ Request::is('admin/mon-hoc*') ? 'active' : '' }}">
            📚 Môn học
        </a>
        <a href="/admin/lop-hoc" class="{{ Request::is('admin/lop-hoc*') ? 'active' : '' }}">
            🏫 Lớp học
        </a>
        <a href="/admin/tkb" class="{{ Request::is('admin/tkb*') ? 'active' : '' }}">
            📅 Lịch học (TKB)
        </a>

        {{-- NHÓM 3: NHÂN SỰ & KẾT QUẢ --}}
        <div class="menu-label">Nhân Sự & Điểm Số</div>

        <a href="/admin/giang-vien" class="{{ Request::is('admin/giang-vien*') ? 'active' : '' }}">
            👨‍🏫 Giảng viên
        </a>
        <a href="/admin/sinh-vien" class="{{ Request::is('admin/sinh-vien*') ? 'active' : '' }}">
            🎓 Sinh viên
        </a>
        <a href="/admin/diem/nhap" class="{{ Request::is('admin/diem*') ? 'active' : '' }}">
            📝 Nhập Điểm
        </a>

        {{-- NHÓM 4: HỆ THỐNG --}}
        <div class="menu-label">Hệ Thống</div>

        <a href="/admin/nguoi-dung" class="{{ Request::is('admin/nguoi-dung*') ? 'active' : '' }}">
            👤 Tài khoản
        </a>

        {{-- NÚT ĐĂNG XUẤT --}}
        <form action="/dang-xuat" method="POST" class="logout-form">
            @csrf
            <button type="submit" class="logout-btn"
                onclick="return confirm('Bạn có chắc chắn muốn đăng xuất?');">
                🚪 Đăng Xuất
            </button>
        </form>
    </div>

    <div class="content">
        @yield('noidung')
    </div>

</body>

</html>