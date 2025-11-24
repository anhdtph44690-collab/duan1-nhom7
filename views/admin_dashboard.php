<?php
// Dashboard quản trị với Bootstrap styling
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Tour Du Lịch</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #27ae60;
            --secondary-color: #1e5631;
            --accent-color: #5dade2;
            --light-bg: #ecf0f1;
        }

        body {
            background: linear-gradient(135deg, #1e7e74 0%, #1a4d6d 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .navbar-custom {
            background: linear-gradient(90deg, #1e5631 0%, #27ae60 100%);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .navbar-custom .navbar-brand {
            font-weight: bold;
            font-size: 1.5rem;
            color: white !important;
        }

        .dashboard-container {
            margin-top: 40px;
            margin-bottom: 40px;
        }

        .welcome-card {
            background: white;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
            border-left: 5px solid var(--primary-color);
        }

        .welcome-card h2 {
            color: var(--secondary-color);
            font-weight: bold;
            margin-bottom: 10px;
        }

        .welcome-card .user-info {
            color: #666;
            font-size: 0.95rem;
        }

        .menu-section {
            background: white;
            border-radius: 10px;
            padding: 25px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }

        .menu-section h3 {
            color: var(--secondary-color);
            font-weight: bold;
            margin-bottom: 20px;
            border-bottom: 2px solid var(--primary-color);
            padding-bottom: 10px;
        }

        .menu-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
        }

        .menu-item {
            text-decoration: none;
            color: white;
            padding: 20px;
            border-radius: 8px;
            transition: all 0.3s ease;
            text-align: center;
            font-weight: 500;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 10px;
        }

        .menu-item i {
            font-size: 2rem;
        }

        .menu-item.admin-list {
            background: linear-gradient(135deg, #27ae60 0%, #1e7e74 100%);
        }

        .menu-item.admin-register {
            background: linear-gradient(135deg, #52be80 0%, #27ae60 100%);
        }

        .menu-item.home {
            background: linear-gradient(135deg, #5dade2 0%, #3498db 100%);
        }

        .menu-item.tour-list {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        }

        .menu-item.add-tour {
            background: linear-gradient(135deg, #ffb347 0%, #ffcc33 100%);
        }

        .menu-item.manage-tour {
            background: linear-gradient(135deg, #ff9966 0%, #ff5e62 100%);
        }

        .menu-item.booking {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        }

        .menu-item.logout {
            background: linear-gradient(135deg, #52be80 0%, #1e7e74 100%);
        }

        .menu-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
            color: white;
            text-decoration: none;
        }

        .stats-section {
            background: white;
            border-radius: 10px;
            padding: 25px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }

        .stat-card {
            background: linear-gradient(135deg, var(--primary-color) 0%, #16a085 100%);
            color: white;
            padding: 20px;
            border-radius: 8px;
            text-align: center;
            margin-bottom: 15px;
        }

        .stat-card i {
            font-size: 2.5rem;
            margin-bottom: 10px;
        }

        .stat-card h4 {
            margin: 10px 0 5px 0;
            font-weight: bold;
        }

        .footer-custom {
            background: var(--secondary-color);
            color: white;
            text-align: center;
            padding: 20px;
            margin-top: 40px;
            border-top: 3px solid var(--primary-color);
        }

        .breadcrumb-custom {
            background: transparent;
            padding: 10px 0;
        }

        .breadcrumb-custom a {
            color: var(--primary-color);
            text-decoration: none;
        }

        .breadcrumb-custom a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php?act=/">
                <i class="bi bi-globe-americas"></i> TourViet
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <span class="navbar-text text-white">
                            <i class="bi bi-person-circle"></i> <?php echo htmlspecialchars($admin['name'] ?? 'Admin'); ?>
                        </span>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="dashboard-container container">
        <!-- Breadcrumb -->
        <nav class="breadcrumb-custom mb-4">
            <a href="index.php?act=/"><i class="bi bi-house"></i> Trang chủ</a>
            <span class="mx-2">/</span>
            <span>Dashboard</span>
        </nav>

        <!-- Welcome Card -->
        <div class="welcome-card">
            <h2><i class="bi bi-hand-thumbs-up"></i> Xin chào, <?php echo htmlspecialchars($admin['name'] ?? 'Admin'); ?>!</h2>
            <div class="user-info">
                <p><strong>Email:</strong> <?php echo htmlspecialchars($admin['email'] ?? ''); ?></p>
                <p class="text-muted">Quản lý hệ thống tour du lịch của bạn từ đây</p>
            </div>
        </div>

        <!-- Quick Stats -->
        <div class="stats-section">
            <h3 style="color: var(--secondary-color); margin-bottom: 20px;">Thống kê nhanh</h3>
            <div class="row">
                <div class="col-md-4">
                    <div class="stat-card">
                        <i class="bi bi-people"></i>
                        <h4>Admin</h4>
                        <p class="mb-0">Quản lý tài khoản</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card" style="background: linear-gradient(135deg, #ffb86b 0%, #ff7eb6 100%);">
                        <i class="bi bi-person-badge"></i>
                        <h4>Hướng dẫn viên</h4>
                        <p class="mb-0">Tổng: <?php echo isset($guideCount) ? (int)$guideCount : 0; ?></p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
                        <i class="bi bi-cart"></i>
                        <h4>Tour</h4>
                        <p class="mb-0">Danh sách tour</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);">
                        <i class="bi bi-book"></i>
                        <h4>Đặt tour</h4>
                        <p class="mb-0">Quản lý đặt phòng</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Management Menu -->
        <div class="menu-section">
            <h3>Quản trị hệ thống</h3>
            <div class="menu-grid">
                <a href="index.php?act=admin_list" class="menu-item admin-list">
                    <i class="bi bi-list-ul"></i>
                    <span>Danh sách Admin</span>
                </a>
                <a href="index.php?act=guide_list" class="menu-item admin-list" style="background: linear-gradient(135deg, #ff7eb6 0%, #ffb86b 100%);">
                    <i class="bi bi-people-fill"></i>
                    <span>Danh sách Hướng dẫn viên</span>
                </a>
                <a href="index.php?act=admin_register" class="menu-item admin-register">
                    <i class="bi bi-person-plus"></i>
                    <span>Tạo Admin mới</span>
                </a>
                <a href="index.php?act=dashboard" class="menu-item tour-list">
                    <i class="bi bi-map"></i>
                    <span>Danh sách Tour</span>
                </a>
                <a href="index.php?act=add-tour" class="menu-item add-tour">
                    <i class="bi bi-plus-circle"></i>
                    <span>Thêm Tour Mới</span>
                </a>
                <a href="index.php?act=booking-list" class="menu-item manage-tour">
                    <i class="bi bi-arrow-repeat"></i>
                    <span>Quản lý Tour</span>
                </a>
                <a href="index.php?act=booking" class="menu-item booking">
                    <i class="bi bi-calendar-check"></i>
                    <span>Đặt Tour</span>
                </a>
                <a href="index.php?act=/" class="menu-item home">
                    <i class="bi bi-house-door"></i>
                    <span>Trang chủ</span>
                </a>
                <a href="index.php?act=admin_logout" class="menu-item logout">
                    <i class="bi bi-box-arrow-right"></i>
                    <span>Đăng xuất</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer-custom">
        <p class="mb-0">&copy; 2025 TourViet - Du lịch chất lượng. Tất cả quyền được bảo lưu.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>