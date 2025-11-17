<?php

require_once __DIR__ . '/../models/AdminModel.php';

class AuthController
{
    protected $model;

    public function __construct()
    {
        $this->model = new AdminModel();
    }

    public function showRegister()
    {
        $errors = [];
        $old = [];
        require __DIR__ . '/../views/admin/register.php';
    }

    public function register()
    {
        $name = $_POST['name'] ?? '';
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        $errors = [];
        $old = ['name' => $name, 'email' => $email];

        if (!$name) $errors[] = 'Tên không được bỏ trống';
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'Email không hợp lệ';
        if (strlen($password) < 6) $errors[] = 'Mật khẩu cần ít nhất 6 ký tự';

        if ($this->model->findByEmail($email)) $errors[] = 'Email đã tồn tại';

        if (!empty($errors)) {
            require __DIR__ . '/../views/admin/register.php';
            return;
        }

        $hash = password_hash($password, PASSWORD_DEFAULT);
        $this->model->create([
            'name' => $name,
            'email' => $email,
            'password' => $hash,
            'created_at' => date('Y-m-d H:i:s')
        ]);

        header('Location: index.php?act=admin_login');
        exit;
    }

    public function showLogin()
    {
        $errors = [];
        $old = [];
        require __DIR__ . '/../views/admin/login.php';
    }

    public function login()
    {
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        $errors = [];
        $old = ['email' => $email];

        if (!$email || !$password) $errors[] = 'Nhập email và mật khẩu';

        $admin = $this->model->findByEmail($email);
        if (!$admin || !password_verify($password, $admin['password'])) $errors[] = 'Email hoặc mật khẩu không đúng';

        if (!empty($errors)) {
            require __DIR__ . '/../views/admin/login.php';
            return;
        }

        if (session_status() === PHP_SESSION_NONE) session_start();
        $_SESSION['admin'] = [
            'id' => $admin['id'],
            'name' => $admin['name'],
            'email' => $admin['email']
        ];

        header('Location: index.php?act=/');
        exit;
    }

    public function logout()
    {
        if (session_status() === PHP_SESSION_NONE) session_start();
        unset($_SESSION['admin']);
        header('Location: index.php?act=admin_login');
        exit;
    }
}
