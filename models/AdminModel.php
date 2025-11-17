<?php

class AdminModel
{
    protected $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }

    public function findByEmail($email)
    {
        $stmt = $this->conn->prepare("SELECT * FROM admins WHERE email = :email LIMIT 1");
        $stmt->execute(['email' => $email]);
        return $stmt->fetch();
    }

    public function create($data)
    {
        $stmt = $this->conn->prepare("INSERT INTO admins (name, email, password, created_at) VALUES (:name, :email, :password, :created_at)");
        return $stmt->execute([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
            'created_at' => $data['created_at'] ?? date('Y-m-d H:i:s'),
        ]);
    }
}
