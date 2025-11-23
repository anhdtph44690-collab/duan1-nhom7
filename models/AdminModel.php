<?php
class AdminModel
{
    public $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }

    public function createAdmin($name, $email, $password_hash)
    {
        $sql = "INSERT INTO admins (name, email, password_hash, role, created_at) VALUES (:name, :email, :password_hash, :role, :created_at)";
        $stmt = $this->conn->prepare($sql);
        $now = date('Y-m-d H:i:s');
        return $stmt->execute([
            ':name' => $name,
            ':email' => $email,
            ':password_hash' => $password_hash,
            ':role' => 'admin',
            ':created_at' => $now
        ]);
    }

    public function findByEmail($email)
    {
        $sql = "SELECT * FROM admins WHERE email = :email LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':email' => $email]);
        return $stmt->fetch();
    }

    public function findById($id)
    {
        $sql = "SELECT * FROM admins WHERE id = :id LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }

    public function getAllAdmins()
    {
        $sql = "SELECT id, name, email, role, created_at FROM admins ORDER BY id DESC";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll();
    }

    public function updateAdmin($id, $name, $email, $role)
    {
        $sql = "UPDATE admins SET name = :name, email = :email, role = :role WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':name' => $name,
            ':email' => $email,
            ':role' => $role,
            ':id' => $id
        ]);
    }

    public function updatePassword($id, $password_hash)
    {
        $sql = "UPDATE admins SET password_hash = :password_hash WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':password_hash' => $password_hash,
            ':id' => $id
        ]);
    }

    public function deleteAdmin($id)
    {
        $sql = "DELETE FROM admins WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }
}
