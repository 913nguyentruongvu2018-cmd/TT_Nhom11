@extends('layouts.admin')

@section('noidung')
    <style>
        .stat-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }

        .stat-card {
            color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            position: relative;
            overflow: hidden;
        }

        .stat-card h3 {
            margin: 0;
            font-size: 36px;
            font-weight: bold;
        }

        .stat-card p {
            margin: 5px 0 0;
            font-size: 16px;
            opacity: 0.9;
        }

        .stat-card i {
            position: absolute;
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 50px;
            opacity: 0.3;
        }

        .bg-blue {
            background: linear-gradient(45deg, #4099ff, #73b4ff);
        }

        .bg-green {
            background: linear-gradient(45deg, #2ed8b6, #59e0c5);
        }

        .bg-red {
            background: linear-gradient(45deg, #FF5370, #ff869a);
        }

        .bg-yellow {
            background: linear-gradient(45deg, #FFB64D, #ffcb80);
        }
    </style>

    <div class="card">
        <h1>Tổng Quan Hệ Thống</h1>
        <p>Chào mừng bạn quay trở lại, <b>Quản trị viên</b>!</p>

        <div class="stat-grid">
            <div class="stat-card bg-blue">
                <h3>{{ $soSV }}</h3>
                <p>Sinh Viên</p>
                <i class="fas fa-user-graduate"></i>
            </div>

            <div class="stat-card bg-green">
                <h3>{{ $soGV }}</h3>
                <p>Giảng Viên</p>
                <i class="fas fa-chalkboard-teacher"></i>
            </div>

            <div class="stat-card bg-yellow">
                <h3>{{ $soMon }}</h3>
                <p>Môn Học</p>
                <i class="fas fa-book"></i>
            </div>

            <div class="stat-card bg-red">
                <h3>{{ $soLop }}</h3>
                <p>Lớp Học</p>
                <i class="fas fa-school"></i>
            </div>
        </div>
    </div>
@endsection
