<?php
// Booking Controller
class BookingController
{
    public $modelBooking;
    public $modelTour;

    public function __construct()
    {
        $this->modelBooking = new BookingModel();
        $this->modelTour = new TourModel();
    }

    public function Booking()
    {
        $title = "Đặt Tour Du Lịch";
        $tours = $this->modelTour->getAllTour();
        
        // Lấy danh sách các tour đã được đặt (có thể trùng)
        $allBookings = $this->modelBooking->getAllBooking();
        $bookedTours = [];
        foreach ($allBookings as $booking) {
            // Tìm tour tương ứng
            foreach ($tours as $tour) {
                if ($tour['id'] == $booking['tour_id']) {
                    $bookedTours[] = $tour;
                    break;
                }
            }
        }
        
        require_once './views/booking/homebooking/index.php';
    }

    public function SubmitBooking()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Lấy dữ liệu từ form
            $tour_id = $_POST['tour_id'] ?? null;
            $customer_name = $_POST['customer_name'] ?? '';
            $email = $_POST['email'] ?? '';
            $phone = $_POST['phone'] ?? '';
            $people_count = $_POST['people_count'] ?? 0;
            $departure_date = $_POST['departure_date'] ?? null;
            $notes = $_POST['notes'] ?? '';

            // Validate dữ liệu
            if (empty($tour_id) || empty($customer_name) || empty($email) || empty($phone) || empty($people_count) || empty($departure_date)) {
                header('Location: ?act=booking&msg=required_fields');
                exit();
            }

            // Kiểm tra email hợp lệ
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                header('Location: ?act=booking&msg=invalid_email');
                exit();
            }

            // Kiểm tra ngày khởi hành có hợp lệ không
            if (!strtotime($departure_date)) {
                header('Location: ?act=booking&msg=invalid_date');
                exit();
            }

            // Kiểm tra ngày khởi hành không được ở quá khứ
            if (strtotime($departure_date) < strtotime('today')) {
                header('Location: ?act=booking&msg=past_date');
                exit();
            }

            // Kiểm tra tour có tồn tại
            $tour = $this->modelTour->getTourById($tour_id);
            if (!$tour) {
                header('Location: ?act=booking&msg=invalid_tour');
                exit();
            }

            // Chuẩn bị dữ liệu
            $data = [
                'tour_id' => $tour_id,
                'customer_name' => $customer_name,
                'email' => $email,
                'phone' => $phone,
                'people_count' => $people_count,
                'departure_date' => $departure_date,
                'notes' => $notes
            ];

            // Tạo booking
            $result = $this->modelBooking->createBooking($data);

            if ($result) {
                header('Location: ?act=booking&msg=booking_success');
                exit();
            } else {
                // Log lỗi để debug
                error_log("Booking Error: " . print_r($data, true));
                header('Location: ?act=booking&msg=booking_error');
                exit();
            }
        }
    }

    public function BookingList()
    {
        $title = "Danh Sách Đặt Tour";
        $bookings = $this->modelBooking->getAllBooking();
        require_once './views/dashboard/booking_list.php';
    }

    public function DeleteBooking()
    {
        $id = $_GET['id'] ?? null;
        
        if ($id && is_numeric($id)) {
            $result = $this->modelBooking->deleteBooking($id);
            
            if ($result) {
                header('Location: ?act=booking-list&msg=delete_success');
                exit();
            } else {
                header('Location: ?act=booking-list&msg=delete_error');
                exit();
            }
        } else {
            header('Location: ?act=booking-list&msg=invalid_id');
            exit();
        }
    }

    public function UpdateBookingStatus()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? null;
            $status = $_POST['status'] ?? 'pending';

            if ($id && is_numeric($id)) {
                $result = $this->modelBooking->updateBooking($id, ['status' => $status]);
                
                if ($result) {
                    header('Location: ?act=booking-list&msg=update_success');
                    exit();
                } else {
                    header('Location: ?act=booking-list&msg=update_error');
                    exit();
                }
            } else {
                header('Location: ?act=booking-list&msg=invalid_id');
                exit();
            }
        }
    }
}
?>
