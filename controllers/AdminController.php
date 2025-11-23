<?php
class AdminController
{
    public $modelAdmin;

    public function __construct()
    {
        $this->modelAdmin = new AdminModel();
    }

    public function register()
    {
        $errors = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';
            $password_confirm = $_POST['password_confirm'] ?? '';

            if ($name === '') $errors[] = 'Vui lòng nhập tên.';
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'Email không hợp lệ.';
            if (strlen($password) < 6) $errors[] = 'Mật khẩu phải >= 6 kí tự.';
            if ($password !== $password_confirm) $errors[] = 'Mật khẩu không khớp.';

            if (empty($errors)) {
                // Kiểm tra email đã tồn tại
                if ($this->modelAdmin->findByEmail($email)) {
                    $errors[] = 'Email đã được sử dụng.';
                } else {
                    $password_hash = password_hash($password, PASSWORD_DEFAULT);
                    $this->modelAdmin->createAdmin($name, $email, $password_hash);
                    header('Location: index.php?act=admin_login');
                    exit;
                }
            }
        }

        require_once './views/admin_register.php';
    }

    public function login()
    {
        $errors = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'Email không hợp lệ.';
            if ($password === '') $errors[] = 'Vui lòng nhập mật khẩu.';

            if (empty($errors)) {
                $admin = $this->modelAdmin->findByEmail($email);
                if ($admin && password_verify($password, $admin['password_hash'])) {
                    // Lưu session
                    $_SESSION['admin'] = [
                        'id' => $admin['id'],
                        'name' => $admin['name'],
                        'email' => $admin['email']
                    ];
                    header('Location: index.php?act=admin_dashboard');
                    exit;
                } else {
                    $errors[] = 'Email hoặc mật khẩu không đúng.';
                }
            }
        }

        require_once './views/admin_login.php';
    }

    public function logout()
    {
        unset($_SESSION['admin']);
        header('Location: index.php?act=admin_login');
        exit;
    }

    public function dashboard()
    {
        if (empty($_SESSION['admin'])) {
            header('Location: index.php?act=admin_login');
            exit;
        }

        $admin = $_SESSION['admin'];
        // Load guide count for dashboard stats
        $guideCount = 0;
        if (class_exists('GuideModel')) {
            $guideModel = new GuideModel();
            $allGuides = $guideModel->getAllGuides();
            $guideCount = is_array($allGuides) ? count($allGuides) : 0;
        }
        require_once './views/admin_dashboard.php';
    }

    // Danh sách admin
    public function list()
    {
        if (empty($_SESSION['admin'])) {
            header('Location: index.php?act=admin_login');
            exit;
        }

        $admins = $this->modelAdmin->getAllAdmins();
        require_once './views/admin_list.php';
    }

    // Sửa admin
    public function edit()
    {
        if (empty($_SESSION['admin'])) {
            header('Location: index.php?act=admin_login');
            exit;
        }

        $id = $_GET['id'] ?? null;
        if (!$id) {
            header('Location: index.php?act=admin_list');
            exit;
        }

        $adminData = $this->modelAdmin->findById($id);
        if (!$adminData) {
            header('Location: index.php?act=admin_list');
            exit;
        }

        $errors = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $role = $_POST['role'] ?? 'admin';
            $password = $_POST['password'] ?? '';

            if ($name === '') $errors[] = 'Tên không được để trống.';
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'Email không hợp lệ.';

            if (empty($errors)) {
                // Nếu email thay đổi và đã tồn tại cho admin khác
                $existing = $this->modelAdmin->findByEmail($email);
                if ($existing && $existing['id'] != $id) {
                    $errors[] = 'Email đã được sử dụng bởi tài khoản khác.';
                } else {
                    $this->modelAdmin->updateAdmin($id, $name, $email, $role);
                    if ($password !== '') {
                        $this->modelAdmin->updatePassword($id, password_hash($password, PASSWORD_DEFAULT));
                    }
                    header('Location: index.php?act=admin_list');
                    exit;
                }
            }
        }

        $admin = $adminData;
        require_once './views/admin_edit.php';
    }

    // Xóa admin
    public function delete()
    {
        if (empty($_SESSION['admin'])) {
            header('Location: index.php?act=admin_login');
            exit;
        }

        $id = $_GET['id'] ?? null;
        if ($id) {
            // Không cho xóa chính account đang đăng nhập
            if ($_SESSION['admin']['id'] == $id) {
                header('Location: index.php?act=admin_list');
                exit;
            }
            $this->modelAdmin->deleteAdmin($id);
        }
        header('Location: index.php?act=admin_list');
        exit;
    }
}
