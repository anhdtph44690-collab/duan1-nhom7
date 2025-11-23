<?php
// Require toàn bộ các file khai báo môi trường, thực thi,...(không require view)

// Require file Common
require_once './commons/env.php'; // Khai báo biến môi trường
require_once './commons/function.php'; // Hàm hỗ trợ

// Require toàn bộ file Controllers
require_once './controllers/ProductController.php';
// auth-login
require_once './controllers/AdminController.php';
require_once './controllers/GuideController.php';

// Require toàn bộ file Models
require_once './models/ProductModel.php';
require_once './models/AdminModel.php';
require_once './models/GuideModel.php';

// Bắt đầu session để dùng cho authentication
session_start();

require_once './controllers/DashboardController.php';
require_once './controllers/BookingController.php';

// Require toàn bộ file Models
require_once './models/ProductModel.php';
require_once './models/TourModel.php';
require_once './models/BookingModel.php';
 main

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
    
    // Booking
    'booking' => (new BookingController())->Booking(),
    'submit-booking' => (new BookingController())->SubmitBooking(),
    'booking-list' => (new BookingController())->BookingList(),
    'delete-booking' => (new BookingController())->DeleteBooking(),
    'update-booking' => (new BookingController())->UpdateBookingStatus(),
    
    default => (new ProductController())->Home(),
};
 main
