<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hệ Thống Quản Lý</title>
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            display: flex;
            height: 100vh;
            background-color: #f4f6f9; 
            color: #333;
        }

        /* menu trai */
        .sidebar {
            width: 260px;
            background-color: #ffffff; 
            display: flex;
            flex-direction: column;
            border-right: 1px solid #e0e0e0; 
            box-shadow: 2px 0 10px rgba(0,0,0,0.03); 
        }

        .sidebar-header {
            padding: 25px 20px;
            background-color: #ffffff;
            border-bottom: 1px solid #f0f0f0;
            text-align: center;
        }

        .sidebar-header h2 {
            margin: 0;
            font-size: 20px;
            font-weight: 700;
            color: #007bff; 
        }

        /* link menu*/
        .sidebar a {
            padding: 12px 24px;
            color: #555; 
            text-decoration: none;
            display: block;
            border-left: 4px solid transparent; 
            transition: all 0.2s;
            font-size: 15px;
            font-weight: 500;
        }

        .sidebar a:hover {
            background-color: #f8f9fa; 
            color: #007bff;
            padding-left: 28px; 
        }

        /* muc dang chon */
        .sidebar a.active {
            background-color: #e3f2fd; 
            border-left: 4px solid #007bff; 
            color: #007bff;
            font-weight: bold;
        }

        /*tieu de */
        .menu-group {
            font-size: 11px;
            text-transform: uppercase;
            color: #999; 
            padding: 20px 24px 8px;
            font-weight: bold;
            letter-spacing: 0.5px;
        }

        /* dang xuat */
        .logout-box {
            margin-top: auto;
            border-top: 1px solid #f0f0f0;
            padding: 10px;
        }

        .logout-btn {
            width: 100%;
            padding: 12px;
            background-color: #fff5f5; 
            color: #e74c3c;
            border: 1px solid #ffebea;
            border-radius: 6px;
            cursor: pointer;
            text-align: center; 
            font-size: 15px;
            font-weight: bold;
            transition: 0.2s;
        }

        .logout-btn:hover {
            background-color: #e74c3c;
            color: white;
            border-color: #e74c3c;
        }

        /* noi dung chinh */
        .content {
            flex: 1;
            padding: 30px;
            overflow-y: auto;
        }

        .card {
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.04); /* Bóng đổ nhẹ hơn */
            border: 1px solid #eaedf1;
        }

        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { padding: 12px; border: 1px solid #ebebeb; text-align: left; }
        th { background-color: #007bff; color: white; border-color: #007bff; }
        tr:nth-child(even) { background-color: #f9fbfd; }
    </style>
</head>

<body>

    <div class="sidebar">
        <div class="sidebar-header">
            <h2>🎓 PHÒNG ĐÀO TẠO</h2>
        </div>

        <a href="/admin/dashboard" class="{{ Request::is('admin/dashboard') ? 'active' : '' }}">
            🏠 Trang Chủ
        </a>

        <div class="menu-group">Đào Tạo & Học Vụ</div>
        <a href="/admin/chuyen-nganh" class="{{ Request::is('admin/chuyen-nganh*') ? 'active' : '' }}">🏢 Chuyên Ngành</a>
        <a href="/admin/mon-hoc" class="{{ Request::is('admin/mon-hoc*') ? 'active' : '' }}">📚 Môn Học</a>
        <a href="/admin/lop-hoc" class="{{ Request::is('admin/lop-hoc*') ? 'active' : '' }}">🏫 Lớp Học</a>
        <a href="/admin/tkb" class="{{ Request::is('admin/tkb*') ? 'active' : '' }}">📅 Lịch Học (TKB)</a>
        <a href="/admin/diem" class="{{ Request::is('admin/diem*') ? 'active' : '' }}">📝 Nhập Điểm</a>

        <div class="menu-group">Quản Lý Hồ Sơ</div>
        <a href="/admin/giang-vien" class="{{ Request::is('admin/giang-vien*') ? 'active' : '' }}">👨‍🏫 Giảng Viên</a>
        <a href="/admin/sinh-vien" class="{{ Request::is('admin/sinh-vien*') ? 'active' : '' }}">👨‍🎓 Sinh Viên</a>
        
        <div class="menu-group">Hệ Thống</div>
        <a href="/admin/nguoi-dung" class="{{ Request::is('admin/nguoi-dung*') ? 'active' : '' }}">👤 Tài Khoản</a>

        <div class="logout-box">
            <form action="/dang-xuat" method="POST">
                @csrf
                <button type="submit" class="logout-btn" onclick="return confirm('Bạn muốn đăng xuất khỏi hệ thống?');">
                    🚪 Đăng Xuất
                </button>
            </form>
        </div>
    </div>

    <div class="content">
        @yield('noidung')
    </div>

</body>
</html>