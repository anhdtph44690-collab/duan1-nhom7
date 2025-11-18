<?php 
// Require toàn bộ các file khai báo môi trường, thực thi,...(không require view)

// Require file Common
require_once './commons/env.php'; // Khai báo biến môi trường
require_once './commons/function.php'; // Hàm hỗ trợ

// Require toàn bộ file Controllers
require_once './controllers/ProductController.php';
require_once './controllers/DashboardController.php';
require_once './controllers/BookingController.php';

// Require toàn bộ file Models
require_once './models/ProductModel.php';
require_once './models/TourModel.php';
require_once './models/BookingModel.php';

// Route
$act = $_GET['act'] ?? '/';


// Để bảo bảo tính chất chỉ gọi 1 hàm Controller để xử lý request thì mình sử dụng match

match ($act) {
    // Trang chủ
    '/' => (new ProductController())->Home(),
    
    // Dashboard
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