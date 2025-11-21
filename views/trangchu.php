<?php
// Trang chủ
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f5f5f5;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .navbar {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        .navbar-brand {
            font-weight: bold;
            font-size: 1.5rem;
        }

        .hero-section {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 60px 0;
            text-align: center;
        }

        .hero-section h1 {
            font-size: 3rem;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .hero-section p {
            font-size: 1.2rem;
            margin-bottom: 30px;
        }

        .card {
            border: none;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            transition: transform 0.3s;
        }

        .card:hover {
            transform: translateY(-5px);
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="?act=/">✈️ TourViet</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="?act=dashboard">📊 Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?act=booking">🎫 Đặt Tour</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="userMenu" role="button" data-bs-toggle="dropdown">
                            👤 Admin
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userMenu">
                            <li><a class="dropdown-item" href="?act=booking-list">📋 Danh Sách Booking</a></li>
                            <li><a class="dropdown-item" href="#">⚙️ Cài Đặt</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#">🚪 Đăng Xuất</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <h1>🌍 Khám Phá Thế Giới Cùng TourViet</h1>
            <p><?= $thoiTiet ?></p>
            <div class="d-flex gap-3 justify-content-center flex-wrap">
                <a href="?act=dashboard" class="btn btn-light btn-lg">📋 Xem Danh Sách Tour</a>
                <a href="?act=booking" class="btn btn-warning btn-lg">🎫 Đặt Tour Ngay</a>
                <a href="?act=booking-list" class="btn btn-info btn-lg">📊 Quản Lý Booking</a>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <div class="container my-5">
        <h2 class="text-center mb-4">🎯 Các Tour Nổi Bật</h2>
        <div class="row">
            <?php if (!empty($tours) && is_array($tours)): ?>
                <?php foreach ($tours as $tour): ?>
                    <div class="col-md-4 mb-4">
                        <div class="card h-100">
                            <?php if (!empty($tour['thumbnail'])): ?>
                                <img src="<?= htmlspecialchars($tour['thumbnail']) ?>" class="card-img-top" alt="<?= htmlspecialchars($tour['name']) ?>">
                            <?php endif; ?>
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title"><?= htmlspecialchars($tour['name']) ?></h5>
                                <p class="card-text text-truncate"><?= htmlspecialchars($tour['description'] ?? '') ?></p>
                                <p class="mt-auto mb-2"><strong>Giá:</strong> <span class="badge bg-success"><?= number_format((float)($tour['price'] ?? 0), 0, ',', '.') ?> đ</span></p>
                                <div class="btn-group w-100" role="group">
                                    <a href="?act=tour&id=<?= $tour['id'] ?>" class="btn btn-primary btn-sm">Xem Chi Tiết</a>
                                    <a href="?act=booking&tour_id=<?= $tour['id'] ?>" class="btn btn-success btn-sm">Đặt Tour</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12">
                    <div class="alert alert-info">Hiện chưa có tour nào. Vui lòng quay lại sau!</div>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Admin Section -->
    <section class="bg-light py-5">
        <div class="container">
            <h2 class="text-center mb-4">⚙️ Quản Lý Hệ Thống</h2>
            <div class="row">
                <div class="col-md-6 mb-4">
                    <div class="card border-left border-primary">
                        <div class="card-body">
                            <h5 class="card-title">📊 Danh Sách Tour</h5>
                            <p class="card-text">Xem và quản lý toàn bộ các tour du lịch trong hệ thống</p>
                            <a href="?act=dashboard" class="btn btn-primary">Xem Dashboard</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-4">
                    <div class="card border-left border-info">
                        <div class="card-body">
                            <h5 class="card-title">📋 Danh Sách Booking</h5>
                            <p class="card-text">Quản lý tất cả yêu cầu đặt tour từ khách hàng</p>
                            <a href="?act=booking-list" class="btn btn-info">Xem Booking</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-4 mt-5">
        <p>&copy; 2025 TourViet - Du lịch chất lượng. Tất cả quyền được bảo lưu.</p>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
