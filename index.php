<?php
// Require toàn bộ các file khai báo môi trường, thực thi,...(không require view)

// Require file Common
require_once './commons/env.php'; // Khai báo biến môi trường
require_once './commons/function.php'; // Hàm hỗ trợ

// Require toàn bộ file Controllers
require_once './controllers/ProductController.php';
require_once './controllers/DashboardController.php';
require_once './controllers/AuthController.php';

// Require toàn bộ file Models
require_once './models/ProductModel.php';
require_once './models/TourModel.php';
require_once './models/AdminModel.php';

// Require auth helpers
require_once './commons/auth.php';

// Route
$act = $_GET['act'] ?? '/';

// Routing - đảm bảo chỉ gọi 1 hàm Controller
match ($act) {
    // Trang chủ
    '/' => (new ProductController())->Home(),

    // Dashboard (từ nhánh t2)
    'dashboard' => (new DashboardController())->Dashboard(),

    // Xóa tour
    'delete-tour' => (new DashboardController())->DeleteTour(),

    // Thêm tour
    'add-tour' => (new DashboardController())->AddTour(),
    'submit-add-tour' => (new DashboardController())->SubmitAddTour(),

    // Sửa tour
    'edit-tour' => (new DashboardController())->EditTour(),
    'submit-edit-tour' => (new DashboardController())->SubmitEditTour(),

    // Admin auth (từ nhánh main)
    'admin_register' => (new AuthController())->showRegister(),
    'admin_register_post' => (new AuthController())->register(),
    'admin_login' => (new AuthController())->showLogin(),
    'admin_login_post' => (new AuthController())->login(),
    'admin_logout' => (new AuthController())->logout(),

    // Default
    default => (new ProductController())->Home(),
};
