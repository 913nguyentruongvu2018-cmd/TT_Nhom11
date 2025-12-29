<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cổng Sinh Viên</title>
    <style>
        body { margin: 0; font-family: 'Segoe UI', sans-serif; display: flex; height: 100vh; background-color: #f4f6f9; color: #333; }
        
        .sidebar { width: 260px; background-color: #ffffff; display: flex; flex-direction: column; border-right: 1px solid #e0e0e0; }
        .sidebar-header { padding: 25px 20px; text-align: center; border-bottom: 1px solid #f0f0f0; }
        .sidebar-header h2 { margin: 0; font-size: 20px; color: #007bff; }
        
        .sidebar a { padding: 12px 24px; color: #555; text-decoration: none; display: block; border-left: 4px solid transparent; transition: 0.2s; font-weight: 500; }
        .sidebar a:hover { background-color: #f8f9fa; color: #007bff; padding-left: 28px; }
        .sidebar a.active { background-color: #e3f2fd; border-left: 4px solid #007bff; color: #007bff; font-weight: bold; }
        
        .menu-group { font-size: 11px; text-transform: uppercase; color: #999; padding: 20px 24px 8px; font-weight: bold; }

        .logout-box { margin-top: auto; border-top: 1px solid #f0f0f0; padding: 10px; }
        .logout-btn { width: 100%; padding: 12px; background-color: #fff5f5; color: #e74c3c; border: 1px solid #ffebea; border-radius: 6px; cursor: pointer; font-weight: bold; }
        .logout-btn:hover { background-color: #e74c3c; color: white; }

        .content { flex: 1; padding: 30px; overflow-y: auto; }
        .card { background: white; padding: 30px; border-radius: 8px; box-shadow: 0 2px 6px rgba(0,0,0,0.04); border: 1px solid #eaedf1; margin-bottom: 20px; }
        
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { padding: 12px; border: 1px solid #ebebeb; text-align: left; }
        th { background-color: #007bff; color: white; }
        tr:nth-child(even) { background-color: #f9fbfd; }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="sidebar-header">
            <h2>🎓 CỔNG SINH VIÊN</h2>
        </div>

        <a href="/sinh-vien/dashboard" class="{{ Request::is('sinh-vien/dashboard') ? 'active' : '' }}">🏠 Trang Chủ</a>
        
        <div class="menu-group">Học Tập</div>
        <a href="/sinh-vien/lich-hoc" class="{{ Request::is('sinh-vien/lich-hoc*') ? 'active' : '' }}">
            📅 Xem Lịch Học
        </a>
        <a href="/sinh-vien/bang-diem" class="{{ Request::is('sinh-vien/bang-diem*') ? 'active' : '' }}">
            📊 Kết Quả Học Tập
        </a>
        
        <div class="menu-group">Thông Tin Chung</div>
        <a href="/sinh-vien/lop-cua-toi" class="{{ Request::is('sinh-vien/lop-cua-toi*') ? 'active' : '' }}">
            🏫 Lớp Của Tôi
        </a>
        <a href="/sinh-vien/ho-so" class="{{ Request::is('sinh-vien/ho-so*') ? 'active' : '' }}">
            👤 Hồ Sơ & Tài Khoản
        </a>

        <div class="logout-box">
            <form action="/dang-xuat" method="POST">
                @csrf
                <button type="submit" class="logout-btn" onclick="return confirm('Bạn muốn đăng xuất?');">
                    🚪 Đăng Xuất
                </button>
            </form>
        </div>
    </div>

    <div class="content">
        @if(session('error'))
            <div style="background:#f8d7da; color:#721c24; padding:15px; border-radius:5px; margin-bottom:20px;">
                ⚠️ {{ session('error') }}
            </div>
        @endif
        @yield('noidung')
    </div>
</body>
</html>