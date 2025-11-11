<?php 
// Tour Model
class TourModel 
{
    public $conn;
    public function __construct()
    {
        $this->conn = connectDB();
    }

    // Lấy tất cả tour
    public function getAllTour()
    {
        try {
            $sql = "SELECT * FROM tours ORDER BY id ASC";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return [];
        }
    }

    // Lấy tour theo ID
    public function getTourById($id)
    {
        try {
            $sql = "SELECT * FROM tours WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return $stmt->fetch();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return null;
        }
    }

    // Xóa tour
    public function deleteTour($id)
    {
        try {
            $sql = "DELETE FROM tours WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id);
            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    // Tạo tour mới
    public function createTour($data)
    {
        try {
            $sql = "INSERT INTO tours (category_id, name, description, price, duration, location, thumbnail, created_at, updated_at) 
                    VALUES (:category_id, :name, :description, :price, :duration, :location, :thumbnail, NOW(), NOW())";
            $stmt = $this->conn->prepare($sql);
            
            $stmt->bindParam(':category_id', $data['category_id']);
            $stmt->bindParam(':name', $data['name']);
            $stmt->bindParam(':description', $data['description']);
            $stmt->bindParam(':price', $data['price']);
            $stmt->bindParam(':duration', $data['duration']);
            $stmt->bindParam(':location', $data['location']);
            $stmt->bindParam(':thumbnail', $data['thumbnail']);
            
            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    // Cập nhật tour
    public function updateTour($id, $data)
    {
        try {
            $sql = "UPDATE tours SET 
                    category_id = :category_id,
                    name = :name,
                    description = :description,
                    price = :price,
                    duration = :duration,
                    location = :location,
                    thumbnail = :thumbnail,
                    updated_at = NOW()
                    WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':category_id', $data['category_id']);
            $stmt->bindParam(':name', $data['name']);
            $stmt->bindParam(':description', $data['description']);
            $stmt->bindParam(':price', $data['price']);
            $stmt->bindParam(':duration', $data['duration']);
            $stmt->bindParam(':location', $data['location']);
            $stmt->bindParam(':thumbnail', $data['thumbnail']);
            
            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
}
