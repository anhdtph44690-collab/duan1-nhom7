<?php
// Đăng nhập admin với Bootstrap styling
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập Admin - Tour Du Lịch</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #27ae60;
            --secondary-color: #1e5631;
        }

        body {
            background: linear-gradient(135deg, #1e7e74 0%, #1a4d6d 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .login-container {
            width: 100%;
            max-width: 450px;
        }

        .login-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
            padding: 40px;
            border-top: 5px solid var(--primary-color);
        }

        .login-card h2 {
            color: var(--secondary-color);
            font-weight: bold;
            margin-bottom: 10px;
            text-align: center;
        }

        .login-card .subtitle {
            color: #999;
            text-align: center;
            margin-bottom: 30px;
            font-size: 0.9rem;
        }

        .form-control {
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            padding: 12px 15px;
            font-size: 0.95rem;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 10px rgba(26, 188, 156, 0.1);
        }

        .form-label {
            color: var(--secondary-color);
            font-weight: 500;
            margin-bottom: 8px;
        }

        .btn-login {
            background: linear-gradient(90deg, var(--primary-color) 0%, #1e7e74 100%);
            border: none;
            color: white;
            font-weight: bold;
            padding: 12px;
            border-radius: 8px;
            width: 100%;
            transition: all 0.3s ease;
            margin-top: 10px;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(26, 188, 156, 0.3);
            color: white;
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

        .link-section {
            text-align: center;
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid #e0e0e0;
        }

        .link-section a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
        }

        .link-section a:hover {
            text-decoration: underline;
        }

        .icon-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .icon-header i {
            font-size: 3rem;
            color: #27ae60;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <div class="login-card">
            <div class="icon-header">
                <i class="bi bi-lock-fill"></i>
            </div>

            <h2><i class="bi bi-globe-americas"></i> Tour Du Lịch</h2>
            <p class="subtitle">Đăng nhập tài khoản quản trị</p>

            <?php if (!empty($errors)): ?>
                <div class="alert alert-danger" role="alert">
                    <ul class="mb-0">
                        <?php foreach ($errors as $e): ?>
                            <li><?php echo htmlspecialchars($e); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form method="post" action="index.php?act=admin_login">
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Nhập email của bạn" value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>" required>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Mật khẩu</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Nhập mật khẩu" required>
                </div>

                <button type="submit" class="btn btn-login">
                    <i class="bi bi-box-arrow-in-right"></i> Đăng nhập
                </button>
            </form>

            <div class="link-section">
                <p class="mb-0">Chưa có tài khoản? <a href="index.php?act=admin_register">Đăng ký ngay</a></p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>