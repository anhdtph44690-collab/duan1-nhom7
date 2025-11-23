<?php

require_once __DIR__ . '/../models/AdminModel.php';

class AdminController
{
    protected $model;

    public function __construct()
    {
        $this->model = new AdminModel();
    }

    public function listAdmins()
    {
        requireAdmin();
        $admins = $this->model->getAll();
        require __DIR__ . '/../views/admin/dashboard.php';
    }

    public function showAddForm()
    {
        requireAdmin();
        $errors = [];
        $old = [];
        require __DIR__ . '/../views/admin/add-admin.php';
    }

    public function addAdmin()
    {
        requireAdmin();

        $name = $_POST['name'] ?? '';
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        $confirm_password = $_POST['confirm_password'] ?? '';

        $errors = [];
        $old = ['name' => $name, 'email' => $email];

        if (!$name) $errors[] = 'Tên không được bỏ trống';
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'Email không hợp lệ';
        if (strlen($password) < 6) $errors[] = 'Mật khẩu cần ít nhất 6 ký tự';
        if ($password !== $confirm_password) $errors[] = 'Mật khẩu xác nhận không khớp';
        if ($this->model->emailExists($email)) $errors[] = 'Email đã tồn tại';

        if (!empty($errors)) {
            require __DIR__ . '/../views/admin/add-admin.php';
            return;
        }

        $hash = password_hash($password, PASSWORD_DEFAULT);
        $this->model->create([
            'name' => $name,
            'email' => $email,
            'password' => $hash,
            'created_at' => date('Y-m-d H:i:s')
        ]);

        if (session_status() === PHP_SESSION_NONE) session_start();
        $_SESSION['success'] = 'Thêm admin thành công!';

        header('Location: index.php?act=admin_list');
        exit;
    }

    public function showEditForm()
    {
        requireAdmin();

        $id = $_GET['id'] ?? null;
        if (!$id) {
            header('Location: index.php?act=admin_list');
            exit;
        }

        $admin = $this->model->findById($id);
        if (!$admin) {
            if (session_status() === PHP_SESSION_NONE) session_start();
            $_SESSION['error'] = 'Admin không tồn tại!';
            header('Location: index.php?act=admin_list');
            exit;
        }

        $errors = [];
        $old = ['name' => $admin['name'], 'email' => $admin['email']];

        require __DIR__ . '/../views/admin/edit-admin.php';
    }

    public function editAdmin()
    {
        requireAdmin();

        $id = $_POST['id'] ?? null;
        $name = $_POST['name'] ?? '';
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        $errors = [];
        $old = ['name' => $name, 'email' => $email];

        if (!$id) {
            $errors[] = 'ID admin không hợp lệ';
        }

        if (!$name) $errors[] = 'Tên không được bỏ trống';
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'Email không hợp lệ';
        if ($this->model->emailExists($email, $id)) $errors[] = 'Email đã được sử dụng bởi admin khác';

        if (!empty($errors)) {
            $admin = $this->model->findById($id);
            require __DIR__ . '/../views/admin/edit-admin.php';
            return;
        }

        $this->model->update($id, [
            'name' => $name,
            'email' => $email,
        ]);

        if ($password && strlen($password) >= 6) {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $this->model->updatePassword($id, $hash);
        }

        if (session_status() === PHP_SESSION_NONE) session_start();
        $_SESSION['success'] = 'Cập nhật admin thành công!';

        header('Location: index.php?act=admin_list');
        exit;
    }

    public function deleteAdmin()
    {
        requireAdmin();

        $id = $_GET['id'] ?? null;

        if (!$id) {
            if (session_status() === PHP_SESSION_NONE) session_start();
            $_SESSION['error'] = 'ID admin không hợp lệ!';
            header('Location: index.php?act=admin_list');
            exit;
        }

        $admin = $this->model->findById($id);
        if (!$admin) {
            if (session_status() === PHP_SESSION_NONE) session_start();
            $_SESSION['error'] = 'Admin không tồn tại!';
            header('Location: index.php?act=admin_list');
            exit;
        }

        // Không cho xóa admin cuối cùng
        $allAdmins = $this->model->getAll();
        if (count($allAdmins) <= 1) {
            if (session_status() === PHP_SESSION_NONE) session_start();
            $_SESSION['error'] = 'Không thể xóa admin cuối cùng!';
            header('Location: index.php?act=admin_list');
            exit;
        }

        $this->model->delete($id);

        if (session_status() === PHP_SESSION_NONE) session_start();
        $_SESSION['success'] = 'Xóa admin thành công!';

        header('Location: index.php?act=admin_list');
        exit;
    }
}
