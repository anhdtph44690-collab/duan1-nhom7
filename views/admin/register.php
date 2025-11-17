<?php
// Variables available: $errors (array), $old (array)
?>
<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>Đăng ký Admin</title>
</head>

<body>
    <h1>Đăng ký Admin</h1>

    <?php if (!empty($errors)): ?>
        <div style="color:red;">
            <ul>
                <?php foreach ($errors as $e): ?>
                    <li><?php echo htmlspecialchars($e); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form action="index.php?act=admin_register_post" method="post">
        <div>
            <label>Tên</label><br>
            <input type="text" name="name" value="<?php echo htmlspecialchars($old['name'] ?? '') ?>">
        </div>
        <div>
            <label>Email</label><br>
            <input type="email" name="email" value="<?php echo htmlspecialchars($old['email'] ?? '') ?>">
        </div>
        <div>
            <label>Mật khẩu</label><br>
            <input type="password" name="password">
        </div>
        <div>
            <button type="submit">Đăng ký</button>
        </div>
    </form>

    <p>Đã có tài khoản? <a href="index.php?act=admin_login">Đăng nhập</a></p>
</body>

</html>