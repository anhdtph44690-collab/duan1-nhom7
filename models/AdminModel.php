<?php
// auth-login
class AdminModel
{
    protected $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }

    public function createAdmin($name, $email, $password_hash, $role = 'admin')
    {
        $sql = "INSERT INTO admins (name, email, password_hash, role, created_at) VALUES (:name, :email, :password_hash, :role, :created_at)";
        $stmt = $this->conn->prepare($sql);
        $now = date('Y-m-d H:i:s');
        return $stmt->execute([
            ':name' => $name,
            ':email' => $email,
            ':password_hash' => $password_hash,
            ':role' => $role,
            ':created_at' => $now
        ]);
    }

    public function findByEmail($email)
    {
        $stmt = $this->conn->prepare("SELECT * FROM admins WHERE email = :email LIMIT 1");
        $stmt->execute([':email' => $email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function findById($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM admins WHERE id = :id LIMIT 1");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getAllAdmins()
    {
        $sql = "SELECT id, name, email, role, created_at FROM admins ORDER BY id DESC";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
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
