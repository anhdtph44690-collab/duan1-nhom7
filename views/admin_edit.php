<?php
// Sửa admin với Bootstrap styling
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa Admin - Tour Du Lịch</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #1abc9c;
            --secondary-color: #2c3e50;
        }

        body {
            background: linear-gradient(135deg, #1e7e74 0%, #1a4d6d 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .navbar-custom {
            background: linear-gradient(90deg, #1e5631 0%, #27ae60 100%);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .navbar-custom .navbar-brand {
            font-weight: bold;
            font-size: 1.5rem;
            color: white !important;
        }

        .edit-container {
            margin-top: 40px;
            margin-bottom: 40px;
        }

        .edit-card {
            background: white;
            border-radius: 10px;
            padding: 35px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
            border-left: 5px solid #27ae60;
        }

        .edit-card h2 {
            color: var(--secondary-color);
            font-weight: bold;
            margin-bottom: 25px;
        }

        .form-label {
            color: var(--secondary-color);
            font-weight: 500;
            margin-bottom: 8px;
        }

        .form-control,
        .form-select {
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            padding: 12px 15px;
            transition: all 0.3s ease;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 10px rgba(26, 188, 156, 0.1);
        }

        .alert-danger {
            background: #ffe5e5;
            border: 1px solid #ffcccc;
            color: #cc0000;
            border-radius: 8px;
            padding: 12px;
            margin-bottom: 20px;
        }

        .alert-danger li {
            margin-bottom: 5px;
        }

        .button-group {
            display: flex;
            gap: 10px;
            margin-top: 30px;
        }

        .btn-save {
            background: linear-gradient(90deg, #27ae60 0%, #1e7e74 100%);
            border: none;
            color: white;
            font-weight: bold;
            padding: 12px 30px;
            border-radius: 8px;
            transition: all 0.3s ease;
            flex: 1;
        }

        .btn-save:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(39, 174, 96, 0.3);
            color: white;
        }

        .btn-cancel {
            background: #6c757d;
            border: none;
            color: white;
            font-weight: bold;
            padding: 12px 30px;
            border-radius: 8px;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .btn-cancel:hover {
            background: #5a6268;
            color: white;
            text-decoration: none;
        }

        .breadcrumb-custom {
            background: transparent;
            padding: 10px 0;
            margin-bottom: 30px;
        }

        .breadcrumb-custom a {
            color: #f0f0f0;
            text-decoration: none;
        }

        .breadcrumb-custom a:hover {
            text-decoration: underline;
        }

        .breadcrumb-custom .breadcrumb-item.active {
            color: #f0f0f0;
        }

        .section-divider {
            margin-top: 25px;
            margin-bottom: 25px;
            border-bottom: 2px solid #e8f5e9;
            padding-bottom: 20px;
        }

        .section-divider h4 {
            color: var(--secondary-color);
            font-weight: bold;
            margin-bottom: 15px;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php?act=/">
                <i class="bi bi-globe-americas"></i> Tour Du Lịch Admin
            </a>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="edit-container container">
        <!-- Breadcrumb -->
        <nav class="breadcrumb-custom">
            <a href="index.php?act=/"><i class="bi bi-house"></i> Trang chủ</a>
            <span class="mx-2">/</span>
            <a href="index.php?act=admin_dashboard">Dashboard</a>
            <span class="mx-2">/</span>
            <a href="index.php?act=admin_list">Danh sách Admin</a>
            <span class="mx-2">/</span>
            <span>Sửa Admin</span>
        </nav>

        <!-- Edit Form -->
        <div class="edit-card">
            <h2><i class="bi bi-pencil-square"></i> Sửa Admin: <?php echo htmlspecialchars($admin['name'] ?? ''); ?></h2>

            <?php if (!empty($errors)): ?>
                <div class="alert alert-danger" role="alert">
                    <ul class="mb-0">
                        <?php foreach ($errors as $e): ?>
                            <li><?php echo htmlspecialchars($e); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form method="post" action="index.php?act=admin_edit&id=<?php echo $admin['id']; ?>">
                <!-- Thông tin cơ bản -->
                <div class="section-divider">
                    <h4><i class="bi bi-info-circle"></i> Thông tin cơ bản</h4>

                    <div class="mb-3">
                        <label for="name" class="form-label">Họ tên</label>
                        <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($_POST['name'] ?? $admin['name']); ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($_POST['email'] ?? $admin['email']); ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="role" class="form-label">Role</label>
                        <select name="role" id="role" class="form-select" required>
                            <option value="admin" <?php echo (($_POST['role'] ?? $admin['role']) === 'admin') ? 'selected' : ''; ?>>Admin</option>
                            <option value="manager" <?php echo (($_POST['role'] ?? $admin['role']) === 'manager') ? 'selected' : ''; ?>>Manager</option>
                        </select>
                    </div>
                </div>

                <!-- Bảo mật -->
                <div class="section-divider">
                    <h4><i class="bi bi-lock"></i> Bảo mật</h4>

                    <div class="mb-3">
                        <label for="password" class="form-label">Mật khẩu mới</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Để trống nếu không đổi mật khẩu">
                        <small class="text-muted">Để trống nếu bạn không muốn thay đổi mật khẩu</small>
                    </div>
                </div>

                <!-- Buttons -->
                <div class="button-group">
                    <button type="submit" class="btn btn-save">
                        <i class="bi bi-check-circle"></i> Lưu thay đổi
                    </button>
                    <a href="index.php?act=admin_list" class="btn btn-cancel">
                        <i class="bi bi-x-circle"></i> Hủy
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>