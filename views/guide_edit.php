<?php
// Edit guide (admin)
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sửa Hướng dẫn viên</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f7f7f7;
        }

        .card {
            margin-top: 30px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Sửa Hướng dẫn viên: <?php echo htmlspecialchars($guide['name'] ?? ''); ?></h4>
                <?php if (!empty($errors)): ?>
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            <?php foreach ($errors as $e): ?>
                                <li><?php echo htmlspecialchars($e); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <form method="post" action="index.php?act=guide_edit&id=<?php echo $guide['id']; ?>">
                    <div class="mb-3">
                        <label class="form-label">Họ tên</label>
                        <input type="text" name="name" class="form-control" value="<?php echo htmlspecialchars($_POST['name'] ?? $guide['name']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" value="<?php echo htmlspecialchars($_POST['email'] ?? $guide['email']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Điện thoại</label>
                        <input type="text" name="phone" class="form-control" value="<?php echo htmlspecialchars($_POST['phone'] ?? $guide['phone']); ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Ngày sinh</label>
                        <input type="date" name="dob" class="form-control" value="<?php echo htmlspecialchars($_POST['dob'] ?? ($guide['dob'] ?? '')); ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Giới thiệu (bio)</label>
                        <textarea name="bio" class="form-control" rows="4"><?php echo htmlspecialchars($_POST['bio'] ?? ($guide['bio'] ?? '')); ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Trạng thái</label>
                        <select name="intro_status" class="form-select">
                            <?php $s = $_POST['intro_status'] ?? ($guide['intro_status'] ?? 'pending'); ?>
                            <option value="pending" <?php echo ($s === 'pending') ? 'selected' : ''; ?>>Đang chờ</option>
                            <option value="published" <?php echo ($s === 'published') ? 'selected' : ''; ?>>Đã xuất bản</option>
                            <option value="archived" <?php echo ($s === 'archived') ? 'selected' : ''; ?>>Lưu trữ</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Vai trò</label>
                        <select name="role" class="form-select">
                            <?php $r = $_POST['role'] ?? ($guide['role'] ?? 'guide'); ?>
                            <option value="guide" <?php echo ($r === 'guide') ? 'selected' : ''; ?>>Hướng dẫn viên</option>
                            <option value="senior" <?php echo ($r === 'senior') ? 'selected' : ''; ?>>Hướng dẫn viên cao cấp</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Mật khẩu mới (để trống nếu không đổi)</label>
                        <input type="password" name="password" class="form-control">
                    </div>
                    <button class="btn btn-primary">Lưu</button>
                    <a href="index.php?act=guide_list" class="btn btn-secondary ms-2">Hủy</a>
                </form>
            </div>
        </div>
    </div>
</body>

</html>