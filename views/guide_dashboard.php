<?php
// Dashboard cho hướng dẫn viên
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard Hướng dẫn viên</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container py-5">
        <div class="card">
            <div class="card-body">
                <h4>Xin chào, <?php echo htmlspecialchars($guide['name'] ?? ''); ?></h4>
                <p>Email: <?php echo htmlspecialchars($guide['email'] ?? ''); ?></p>
                <p><a href="index.php?act=guide_logout" class="btn btn-sm btn-danger">Đăng xuất</a></p>
                <hr>
                <p>Ở đây bạn có thể xem các tour được phân công, lịch trình và thông tin khách hàng (tùy chỉnh tiếp theo).</p>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>