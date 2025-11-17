<?php
// Variables available: $errors (array), $old (array)
?>
<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>Đăng nhập Admin</title>
</head>

<body>
    <h1>Đăng nhập Admin</h1>

    <?php if (!empty($errors)): ?>
        <div style="color:red;">
            <ul>
                <?php foreach ($errors as $e): ?>
                    <li><?php echo htmlspecialchars($e); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form action="index.php?act=admin_login_post" method="post">
        <div>
            <label>Email</label><br>
            <input type="email" name="email" value="<?php echo htmlspecialchars($old['email'] ?? '') ?>">
        </div>
        <div>
            <label>Mật khẩu</label><br>
            <input type="password" name="password">
        </div>
        <div>
            <button type="submit">Đăng nhập</button>
        </div>
    </form>

    <p>Chưa có tài khoản? <a href="index.php?act=admin_register">Đăng ký</a></p>
</body>

</html>