<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>
    <style>
        body {
            margin: 0;
            font-family: sans-serif;
            display: flex;
            height: 100vh;
        }

        .sidebar {
            width: 250px;
            background-color: #2c3e50;
            color: white;
            padding-top: 20px;
            display: flex;
            flex-direction: column;
        }

        .sidebar h2 {
            text-align: center;
            margin-bottom: 30px;
        }

        .sidebar a {
            padding: 15px 20px;
            color: white;
            text-decoration: none;
            display: block;
            border-bottom: 1px solid #34495e;
        }

        .sidebar a:hover {
            background-color: #34495e;
        }

        .sidebar a.active {
            background-color: #1abc9c;
            font-weight: bold;
        }

        .logout-form {
            margin-top: auto;
        }

        .logout-btn {
            width: 100%;
            padding: 15px;
            background-color: #c0392b;
            color: white;
            border: none;
            cursor: pointer;
            font-size: 16px;
        }

        .content {
            flex: 1;
            padding: 20px;
            background-color: #ecf0f1;
            overflow-y: auto;
        }

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

        th,
        td {
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
        <h2>Admin Panel</h2>

        <a href="/admin/dashboard" class="{{ Request::is('admin/dashboard') ? 'active' : '' }}">
            🏠 Trang chủ
        </a>

        <a href="/admin/mon-hoc" class="{{ Request::is('admin/mon-hoc*') ? 'active' : '' }}">
            📚 Quản lý Môn học
        </a>

        <a href="/admin/sinh-vien" class="{{ Request::is('admin/sinh-vien*') ? 'active' : '' }}">
            🎓 Quản lý Sinh viên
        </a>

        <a href="/admin/diem/nhap" class="{{ Request::is('admin/diem*') ? 'active' : '' }}">
            📝 Nhập Điểm
        </a>

        <a href="/admin/giang-vien" class="{{ Request::is('admin/giang-vien*') ? 'active' : '' }}">
            👨‍🏫 Quản lý Giảng viên
        </a>

        <a href="/admin/lop-hoc" class="{{ Request::is('admin/lop-hoc*') ? 'active' : '' }}">
            🏫 Quản lý Lớp học
        </a>
        <a href="/admin/tkb" class="{{ Request::is('admin/tkb*') ? 'active' : '' }}">
            📅 Quản lý Lịch Học (TKB)
        </a>
        <a href="/admin/nguoi-dung" class="{{ Request::is('admin/nguoi-dung*') ? 'active' : '' }}">
            👤 Quản lý Người Dùng
        </a>
        <a href="/admin/chuyen-nganh">
            Quản Lý Chuyên Ngành
        </a>

        <form action="/dang-xuat" method="POST" class="logout-form">
            @csrf
            <button type="submit" class="logout-btn"
                onclick="return confirm('Bạn có chắc chắn muốn đăng xuất khỏi hệ thống không?');">>Đăng Xuất</button>
        </form>
    </div>

    <div class="content">
        @yield('noidung')
    </div>

</body>

</html>
