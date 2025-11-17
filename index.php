<?php
// Require toàn bộ các file khai báo môi trường, thực thi,...(không require view)

// Require file Common
require_once './commons/env.php'; // Khai báo biến môi trường
require_once './commons/function.php'; // Hàm hỗ trợ

// Require toàn bộ file Controllers
require_once './controllers/ProductController.php';
require_once './controllers/AuthController.php';

// Require toàn bộ file Models
require_once './models/ProductModel.php';
require_once './models/AdminModel.php';

// Require auth helpers
require_once './commons/auth.php';

// Route
$act = $_GET['act'] ?? '/';


// Để bảo bảo tính chất chỉ gọi 1 hàm Controller để xử lý request thì mình sử dụng match

match ($act) {
    // Trang chủ
    '/' => (new ProductController())->Home(),
    // Admin auth
    'admin_register' => (new AuthController())->showRegister(),
    'admin_register_post' => (new AuthController())->register(),
    'admin_login' => (new AuthController())->showLogin(),
    'admin_login_post' => (new AuthController())->login(),
    'admin_logout' => (new AuthController())->logout(),
};

// Kết thúc