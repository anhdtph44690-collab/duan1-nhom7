<?php
// Booking Model
class BookingModel
{
    public $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }

    // Lấy tất cả booking
    public function getAllBooking()
    {
        try {
            $sql = "SELECT bookings.*, tours.name FROM bookings 
                    LEFT JOIN tours ON bookings.tour_id = tours.id 
                    ORDER BY bookings.created_at DESC";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return [];
        }
    }

    // Lấy booking theo ID
    public function getBookingById($id)
    {
        try {
            $sql = "SELECT * FROM bookings WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return $stmt->fetch();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return null;
        }
    }

    // Tạo booking mới
    public function createBooking($data)
    {
        try {
            $sql = "INSERT INTO bookings (tour_id, customer_name, email, phone, people_count, departure_date, notes, status) 
                    VALUES (:tour_id, :customer_name, :email, :phone, :people_count, :departure_date, :notes, :status)";
            $stmt = $this->conn->prepare($sql);

            $stmt->bindParam(':tour_id', $data['tour_id']);
            $stmt->bindParam(':customer_name', $data['customer_name']);
            $stmt->bindParam(':email', $data['email']);
            $stmt->bindParam(':phone', $data['phone']);
            $stmt->bindParam(':people_count', $data['people_count']);
            $stmt->bindParam(':departure_date', $data['departure_date']);
            $stmt->bindParam(':notes', $data['notes']);
            
            $status = 'pending';
            $stmt->bindParam(':status', $status);

            $result = $stmt->execute();
            
            // Log chi tiết
            if (!$result) {
                error_log("SQL Error: " . implode(", ", $stmt->errorInfo()));
            }
            
            return $result;
        } catch (PDOException $e) {
            error_log("PDO Error in createBooking: " . $e->getMessage());
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    // Cập nhật booking
    public function updateBooking($id, $data)
    {
        try {
            $fields = [];
            $bindings = [];

            foreach ($data as $key => $value) {
                $fields[] = "$key = :$key";
                $bindings[$key] = $value;
            }

            $sql = "UPDATE bookings SET " . implode(", ", $fields) . ", updated_at = NOW() WHERE id = :id";
            $stmt = $this->conn->prepare($sql);

            foreach ($bindings as $key => $value) {
                $stmt->bindParam(':' . $key, $bindings[$key]);
            }
            $stmt->bindParam(':id', $id);

            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    // Xóa booking
    public function deleteBooking($id)
    {
        try {
            $sql = "DELETE FROM bookings WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id);
            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
}
?>
