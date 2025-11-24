<?php
// Require toàn bộ các file khai báo môi trường, thực thi,...(không require view)

// Require file Common
require_once './commons/env.php'; // Khai báo biến môi trường
require_once './commons/function.php'; // Hàm hỗ trợ

// Require toàn bộ file Controllers (only include if file exists)
$controllerFiles = [
    'ProductController.php',
    'AdminController.php',
    'GuideController.php',
    'DashboardController.php',
    'BookingController.php',
];
foreach ($controllerFiles as $cf) {
    $path = __DIR__ . '/controllers/' . $cf;
    if (file_exists($path)) {
        require_once $path;
    }
}

// Require toàn bộ file Models (only include if file exists to avoid fatal errors)
$modelFiles = [
    'ProductModel.php',
    'AdminModel.php',
    'GuideModel.php',
    'TourModel.php',
    'BookingModel.php',
];
foreach ($modelFiles as $mf) {
    $path = __DIR__ . '/models/' . $mf;
    if (file_exists($path)) {
        require_once $path;
    }
}

// Bắt đầu session để dùng cho authentication
session_start();

// Route
$act = $_GET['act'] ?? '/';

// auth-login

// Để bảo đảm tính chất chỉ gọi 1 hàm Controller để xử lý request, sử dụng switch cho tương thích

switch ($act) {
    case '/':
        (new ProductController())->Home();
        break;

    // Admin: đăng ký, đăng nhập, dashboard, đăng xuất
    case 'admin_register':
        (new AdminController())->register();
        break;
    case 'admin_login':
        (new AdminController())->login();
        break;
    case 'admin_logout':
        (new AdminController())->logout();
        break;
    case 'admin_dashboard':
        (new AdminController())->dashboard();
        break;

    // Quản lý admin
    case 'admin_list':
        (new AdminController())->list();
        break;
    case 'admin_edit':
        (new AdminController())->edit();
        break;
    case 'admin_delete':
        (new AdminController())->delete();
        break;

    // Hướng dẫn viên
    case 'guide_register':
        (new GuideController())->register();
        break;
    case 'guide_login':
        (new GuideController())->login();
        break;
    case 'guide_logout':
        (new GuideController())->logout();
        break;
    case 'guide_dashboard':
        (new GuideController())->dashboard();
        break;
    case 'guide_list':
        (new GuideController())->list();
        break;
    case 'guide_edit':
        (new GuideController())->edit();
        break;
    case 'guide_delete':
        (new GuideController())->delete();
        break;

    default:
        // nếu không khớp route nào, chuyển về trang chủ
        (new ProductController())->Home();
        break;
}

// Note: routing handled above with the `switch` statement for compatibility
