<?php
class GuideModel
{
    public $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }

    public function createGuide($name, $email, $phone, $dob = null, $bio = null, $password_hash)
    {
        $sql = "INSERT INTO guides (name, email, phone, dob, bio, password_hash, role, intro_status, created_at) VALUES (:name, :email, :phone, :dob, :bio, :password_hash, :role, :intro_status, :created_at)";
        $stmt = $this->conn->prepare($sql);
        $now = date('Y-m-d H:i:s');
        return $stmt->execute([
            ':name' => $name,
            ':email' => $email,
            ':phone' => $phone,
            ':dob' => $dob,
            ':bio' => $bio,
            ':password_hash' => $password_hash,
            ':role' => 'guide',
            ':intro_status' => 'pending',
            ':created_at' => $now
        ]);
    }

    public function findByEmail($email)
    {
        $sql = "SELECT * FROM guides WHERE email = :email LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':email' => $email]);
        return $stmt->fetch();
    }

    public function findById($id)
    {
        $sql = "SELECT * FROM guides WHERE id = :id LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }

    public function getAllGuides()
    {
        $sql = "SELECT id, name, email, phone, dob, bio, intro_status, role, created_at FROM guides ORDER BY id DESC";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll();
    }

    public function updateGuide($id, $name, $email, $phone, $dob = null, $bio = null, $role = 'guide', $intro_status = 'pending')
    {
        $sql = "UPDATE guides SET name = :name, email = :email, phone = :phone, dob = :dob, bio = :bio, role = :role, intro_status = :intro_status WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':name' => $name,
            ':email' => $email,
            ':phone' => $phone,
            ':dob' => $dob,
            ':bio' => $bio,
            ':role' => $role,
            ':intro_status' => $intro_status,
            ':id' => $id
        ]);
    }

    public function updatePassword($id, $password_hash)
    {
        $sql = "UPDATE guides SET password_hash = :password_hash WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':password_hash' => $password_hash,
            ':id' => $id
        ]);
    }

    public function deleteGuide($id)
    {
        $sql = "DELETE FROM guides WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }
}
