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
        require __DIR__ . '/../views/admin_register.php';
    }

    public function register()
    {
        $name = trim($_POST['name'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';
        $password_confirm = $_POST['password_confirm'] ?? '';

        $errors = [];

        if ($name === '') $errors[] = 'Tên không được bỏ trống';
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'Email không hợp lệ';
        if (strlen($password) < 6) $errors[] = 'Mật khẩu cần ít nhất 6 ký tự';
        if ($password !== $password_confirm) $errors[] = 'Mật khẩu xác nhận không khớp';

        if ($this->model->findByEmail($email)) $errors[] = 'Email đã tồn tại';

        if (!empty($errors)) {
            require __DIR__ . '/../views/admin_register.php';
            return;
        }

        $hash = password_hash($password, PASSWORD_DEFAULT);
        $this->model->createAdmin($name, $email, $hash);

        header('Location: index.php?act=admin_login');
        exit;
    }

    public function showLogin()
    {
        $errors = [];
        $old = [];
        require __DIR__ . '/../views/admin_login.php';
    }

    public function login()
    {
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';

        $errors = [];

        if ($email === '' || $password === '') $errors[] = 'Nhập email và mật khẩu';

        $admin = $this->model->findByEmail($email);
        if (!$admin || !password_verify($password, $admin['password_hash'])) $errors[] = 'Email hoặc mật khẩu không đúng';

        if (!empty($errors)) {
            require __DIR__ . '/../views/admin_login.php';
            return;
        }

        if (session_status() === PHP_SESSION_NONE) session_start();
        $_SESSION['admin'] = [
            'id' => $admin['id'],
            'name' => $admin['name'],
            'email' => $admin['email']
        ];

        header('Location: index.php?act=admin_dashboard');
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
