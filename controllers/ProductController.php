<?php
// có class chứa các function thực thi xử lý logic 
class ProductController
{
    public $modelProduct;

    public function __construct()
    {
        $this->modelProduct = new ProductModel();
    }

    public function Home()
    {
        $title = "Đây là trang chủ nhé hahaa update";
        $thoiTiet = "Hôm nay trời có vẻ là mưa";

        // Lấy danh sách tour từ TourModel (nếu có)
        $tours = [];
        if (class_exists('TourModel')) {
            $tourModel = new TourModel();
            $tours = $tourModel->getAllTour();
        }

        require_once './views/trangchu.php';
    }

    // Hiển thị chi tiết một tour
    public function TourDetail()
    {
        $id = $_GET['id'] ?? $_GET['tour_id'] ?? null;
        if (!$id || !is_numeric($id)) {
            header('Location: ?act=/');
            exit();
        }

        $tourModel = new TourModel();
        $tour = $tourModel->getTourById($id);
        if (!$tour) {
            header('Location: ?act=/');
            exit();
        }

        $title = $tour['name'] ?? 'Chi tiết tour';
        require_once './views/tours/detail.php';
    }
}
