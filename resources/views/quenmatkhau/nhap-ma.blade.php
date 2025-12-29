<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Xác Thực & Đổi Mật Khẩu</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            font-family: 'Segoe UI', sans-serif;
            background: #f4f6f9;
        }

        .box {
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            width: 350px;
        }

        input {
            width: 100%;
            padding: 12px;
            margin: 5px 0 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input.is-invalid {
            border: 1px solid #dc3545;
            background-color: #fff8f8;
        }

        button {
            width: 100%;
            padding: 12px;
            background: #28a745;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
        }

        button:hover {
            background: #218838;
        }

        .success {
            color: #155724;
            background: #d4edda;
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 10px;
            text-align: center;
            border: 1px solid #c3e6cb;
        }

        .error-msg {
            color: #721c24;
            background-color: #f8d7da;
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 10px;
            font-size: 13px;
            border: 1px solid #f5c6cb;
        }

        .text-danger {
            color: #dc3545;
            font-size: 12px;
            margin-top: -10px;
            margin-bottom: 10px;
            display: block;
        }
    </style>
</head>

<body>
    <div class="box">
        <h2 style="text-align: center; color: #333;">🔑 Đặt Lại Mật Khẩu</h2>

        @if(session('success')) <div class="success">✅ {{ session('success') }}</div> @endif
        @if(session('error')) <div class="error-msg">⚠️ {{ session('error') }}</div> @endif


        @php
        $emailFull = session('reset_email');
        $userPart = $emailFull ? strstr($emailFull, '@', true) : '';
        @endphp


        @if($userPart)
        <div style="text-align: center; margin-bottom: 20px;">
            <a href="https://www.mailinator.com/v4/public/inboxes.jsp?to={{ $userPart }}"
                target="_blank"
                style="display: inline-block; background: #6c757d; color: white; padding: 8px 15px; border-radius: 20px; text-decoration: none; font-size: 13px;">
                📩 Mở Mailinator của <b>{{ $userPart }}</b>
            </a>
        </div>
        @endif

        <form action="/xac-nhan-doi-pass" method="POST" novalidate>
            @csrf


            <label style="font-weight: bold;">Mã xác nhận (6 số):</label>
            <input type="text" name="Code"
                value="{{ old('Code') }}"
                class="@error('Code') is-invalid @enderror"
                required placeholder="Nhập mã từ email..." autocomplete="off">
            @error('Code') <span class="text-danger">⚠️ {{ $message }}</span> @enderror


            <label style="font-weight: bold;">Mật khẩu mới:</label>
            <input type="password" name="MatKhauMoi"
                class="@error('MatKhauMoi') is-invalid @enderror"
                required placeholder="Nhập mật khẩu mới">
            @error('MatKhauMoi') <span class="text-danger">⚠️ {{ $message }}</span> @enderror


            <label style="font-weight: bold;">Xác nhận mật khẩu:</label>
            <input type="password" name="XacNhanMatKhau"
                class="@error('XacNhanMatKhau') is-invalid @enderror"
                required placeholder="Nhập lại mật khẩu mới">
            @error('XacNhanMatKhau') <span class="text-danger">⚠️ {{ $message }}</span> @enderror

            <button type="submit">Xác Nhận Đổi</button>
        </form>
    </div>
</body>

</html>