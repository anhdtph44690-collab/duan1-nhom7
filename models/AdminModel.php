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

    public function findById($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM admins WHERE id = :id LIMIT 1");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    public function getAll()
    {
        $stmt = $this->conn->prepare("SELECT id, name, email, created_at FROM admins ORDER BY created_at DESC");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function update($id, $data)
    {
        $stmt = $this->conn->prepare("UPDATE admins SET name = :name, email = :email WHERE id = :id");
        return $stmt->execute([
            'id' => $id,
            'name' => $data['name'],
            'email' => $data['email'],
        ]);
    }

    public function updatePassword($id, $password)
    {
        $stmt = $this->conn->prepare("UPDATE admins SET password = :password WHERE id = :id");
        return $stmt->execute([
            'id' => $id,
            'password' => $password,
        ]);
    }

    public function delete($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM admins WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }

    public function emailExists($email, $excludeId = null)
    {
        $query = "SELECT id FROM admins WHERE email = :email";
        $params = ['email' => $email];

        if ($excludeId) {
            $query .= " AND id != :id";
            $params['id'] = $excludeId;
        }

        $stmt = $this->conn->prepare($query);
        $stmt->execute($params);
        return $stmt->fetch() ? true : false;
    }
}
