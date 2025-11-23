<?php
class GuideController
{
    public $modelGuide;

    public function __construct()
    {
        $this->modelGuide = new GuideModel();
    }

    public function register()
    {
        $errors = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $phone = trim($_POST['phone'] ?? '');
            $password = $_POST['password'] ?? '';
            $password_confirm = $_POST['password_confirm'] ?? '';

            if ($name === '') $errors[] = 'Vui lòng nhập tên.';
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'Email không hợp lệ.';
            if (strlen($password) < 6) $errors[] = 'Mật khẩu phải >= 6 kí tự.';
            if ($password !== $password_confirm) $errors[] = 'Mật khẩu không khớp.';

            $dob = $_POST['dob'] ?? null;
            $bio = trim($_POST['bio'] ?? null);

            if (empty($errors)) {
                if ($this->modelGuide->findByEmail($email)) {
                    $errors[] = 'Email đã được sử dụng.';
                } else {
                    $password_hash = password_hash($password, PASSWORD_DEFAULT);
                    // createGuide signature: name, email, phone, dob, bio, password_hash
                    $this->modelGuide->createGuide($name, $email, $phone, $dob, $bio, $password_hash);
                    header('Location: index.php?act=guide_login');
                    exit;
                }
            }
        }

        require_once './views/guide_register.php';
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
                $guide = $this->modelGuide->findByEmail($email);
                if ($guide && password_verify($password, $guide['password_hash'])) {
                    $_SESSION['guide'] = [
                        'id' => $guide['id'],
                        'name' => $guide['name'],
                        'email' => $guide['email']
                    ];
                    header('Location: index.php?act=guide_dashboard');
                    exit;
                } else {
                    $errors[] = 'Email hoặc mật khẩu không đúng.';
                }
            }
        }

        require_once './views/guide_login.php';
    }

    public function logout()
    {
        unset($_SESSION['guide']);
        header('Location: index.php?act=guide_login');
        exit;
    }

    public function dashboard()
    {
        if (empty($_SESSION['guide'])) {
            header('Location: index.php?act=guide_login');
            exit;
        }

        $guide = $_SESSION['guide'];
        require_once './views/guide_dashboard.php';
    }

    public function list()
    {
        if (empty($_SESSION['admin'])) {
            header('Location: index.php?act=admin_login');
            exit;
        }

        $guides = $this->modelGuide->getAllGuides();
        require_once './views/guide_list.php';
    }

    public function edit()
    {
        if (empty($_SESSION['admin'])) {
            header('Location: index.php?act=admin_login');
            exit;
        }

        $id = $_GET['id'] ?? null;
        if (!$id) {
            header('Location: index.php?act=guide_list');
            exit;
        }

        $guideData = $this->modelGuide->findById($id);
        if (!$guideData) {
            header('Location: index.php?act=guide_list');
            exit;
        }

        $errors = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $phone = trim($_POST['phone'] ?? '');
            $dob = $_POST['dob'] ?? null;
            $bio = trim($_POST['bio'] ?? null);
            $role = $_POST['role'] ?? 'guide';
            $intro_status = $_POST['intro_status'] ?? 'pending';
            $password = $_POST['password'] ?? '';

            if ($name === '') $errors[] = 'Tên không được để trống.';
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'Email không hợp lệ.';

            if (empty($errors)) {
                $existing = $this->modelGuide->findByEmail($email);
                if ($existing && $existing['id'] != $id) {
                    $errors[] = 'Email đã được sử dụng bởi tài khoản khác.';
                } else {
                    // updateGuide signature: id, name, email, phone, dob, bio, role, intro_status
                    $this->modelGuide->updateGuide($id, $name, $email, $phone, $dob, $bio, $role, $intro_status);
                    if ($password !== '') {
                        $this->modelGuide->updatePassword($id, password_hash($password, PASSWORD_DEFAULT));
                    }
                    header('Location: index.php?act=guide_list');
                    exit;
                }
            }
        }

        $guide = $guideData;
        require_once './views/guide_edit.php';
    }

    public function delete()
    {
        if (empty($_SESSION['admin'])) {
            header('Location: index.php?act=admin_login');
            exit;
        }

        $id = $_GET['id'] ?? null;
        if ($id) {
            $this->modelGuide->deleteGuide($id);
        }
        header('Location: index.php?act=guide_list');
        exit;
    }
}
