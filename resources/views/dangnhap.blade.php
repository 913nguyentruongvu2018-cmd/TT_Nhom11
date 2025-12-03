<!DOCTYPE html>
<html>

<head>
    <title>Đăng Nhập Hệ Thống</title>
    <style>
        body {
            font-family: sans-serif;
            padding: 50px;
            background-color: #f0f2f5;
        }

        form {
            background: white;
            padding: 30px;
            border-radius: 8px;
            width: 320px;
            margin: 0 auto;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        input {
            width: 100%;
            padding: 10px;
            margin: 5px 0 15px 0;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }

        button {
            background: #007bff;
            color: white;
            padding: 10px;
            border: none;
            width: 100%;
            cursor: pointer;
            border-radius: 4px;
            font-weight: bold;
        }

        button:hover {
            background: #0056b3;
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        .error {
            color: red;
            margin-bottom: 10px;
            text-align: center;
            font-size: 14px;
        }

        /* Thông báo thành công */
        .success-msg {
            background-color: #d4edda;
            color: #155724;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #c3e6cb;
            border-radius: 4px;
            text-align: center;
        }

        /* --- CSS MỚI CHO LINK ĐĂNG KÝ --- */
        .register-link {
            text-align: center;
            margin-top: 15px;
            font-size: 14px;
        }

        .register-link a {
            color: #007bff;
            text-decoration: none;
            font-weight: bold;
        }

        .register-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>

    <form action="/dang-nhap" method="POST">
        <h2>Đăng Nhập</h2>

        @if (session('success'))
            <div class="success-msg">
                ✅ {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="error">{{ $errors->first() }}</div>
        @endif

        @csrf

        <label>Tên đăng nhập:</label>
        <input type="text" name="TenDangNhap" required placeholder="Nhập tên đăng nhập">

        <label>Mật khẩu:</label>
        <input type="password" name="MatKhau" required placeholder="Nhập mật khẩu">

        <button type="submit">Đăng Nhập</button>

        <div class="register-link">
            Chưa có tài khoản? <a href="/dang-ky">Đăng ký tại đây</a>
        </div>
    </form>

</body>

</html>
