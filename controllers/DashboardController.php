<?php
// Dashboard Controller
class DashboardController
{
    public $modelTour;

    public function __construct()
    {
        $this->modelTour = new TourModel();
    }

    public function Dashboard()
    {
        $title = "Dashboard - Quản lý Tour";
        $tours = $this->modelTour->getAllTour();
        require_once './views/dashboard.php';
    }

    public function DeleteTour()
    {
        $id = $_GET['id'] ?? null;
        
        if ($id && is_numeric($id)) {
            $result = $this->modelTour->deleteTour($id);
            
            if ($result) {
                // Xóa thành công - quay lại dashboard
                header('Location: ?act=dashboard&msg=delete_success');
                exit();
            } else {
                // Xóa thất bại - quay lại dashboard với lỗi
                header('Location: ?act=dashboard&msg=delete_error');
                exit();
            }
        } else {
            header('Location: ?act=dashboard&msg=invalid_id');
            exit();
        }
    }

    public function AddTour()
    {
        $title = "Thêm Tour Mới";
        require_once './views/add_tour.php';
    }

    public function SubmitAddTour()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Lấy dữ liệu từ form
            $name = $_POST['name'] ?? '';
            $description = $_POST['description'] ?? '';
            $price = $_POST['price'] ?? 0;
            $duration = $_POST['duration'] ?? '';
            $location = $_POST['location'] ?? '';
            $category_id = $_POST['category_id'] ?? 1;
            $thumbnail = $_POST['thumbnail'] ?? 'default.jpg';

            // Validate dữ liệu
            if (empty($name) || empty($description) || empty($location)) {
                header('Location: ?act=add-tour&msg=required_fields');
                exit();
            }

            // Chuẩn bị dữ liệu
            $data = [
                'name' => $name,
                'description' => $description,
                'price' => $price,
                'duration' => $duration,
                'location' => $location,
                'category_id' => $category_id,
                'thumbnail' => $thumbnail
            ];

            // Tạo tour
            $result = $this->modelTour->createTour($data);

            if ($result) {
                header('Location: ?act=dashboard&msg=create_success');
                exit();
            } else {
                header('Location: ?act=add-tour&msg=create_error');
                exit();
            }
        }
    }

    public function EditTour()
    {
        $id = $_GET['id'] ?? null;
        
        if ($id && is_numeric($id)) {
            $tour = $this->modelTour->getTourById($id);
            
            if ($tour) {
                $title = "Sửa Tour";
                require_once './views/edit_tour.php';
            } else {
                header('Location: ?act=dashboard&msg=tour_not_found');
                exit();
            }
        } else {
            header('Location: ?act=dashboard&msg=invalid_id');
            exit();
        }
    }

    public function SubmitEditTour()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? null;
            
            if (!$id || !is_numeric($id)) {
                header('Location: ?act=dashboard&msg=invalid_id');
                exit();
            }

            // Lấy dữ liệu từ form
            $name = $_POST['name'] ?? '';
            $description = $_POST['description'] ?? '';
            $price = $_POST['price'] ?? 0;
            $duration = $_POST['duration'] ?? '';
            $location = $_POST['location'] ?? '';
            $category_id = $_POST['category_id'] ?? 1;
            $thumbnail = $_POST['thumbnail'] ?? 'default.jpg';

            // Validate dữ liệu
            if (empty($name) || empty($description) || empty($location)) {
                header('Location: ?act=edit-tour&id=' . $id . '&msg=required_fields');
                exit();
            }

            // Chuẩn bị dữ liệu
            $data = [
                'name' => $name,
                'description' => $description,
                'price' => $price,
                'duration' => $duration,
                'location' => $location,
                'category_id' => $category_id,
                'thumbnail' => $thumbnail
            ];

            // Cập nhật tour
            $result = $this->modelTour->updateTour($id, $data);

            if ($result) {
                header('Location: ?act=dashboard&msg=update_success');
                exit();
            } else {
                header('Location: ?act=edit-tour&id=' . $id . '&msg=update_error');
                exit();
            }
        }
    }
}

