<?php
// Danh sách hướng dẫn viên (Admin chỉ xem)
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Danh sách Hướng dẫn viên</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container py-5">
        <div class="card">
            <div class="card-body">
                <h4>Danh sách Hướng dẫn viên</h4>
                <p><a href="index.php?act=admin_dashboard" class="btn btn-sm btn-secondary">Quay lại Dashboard</a></p>
                <?php if (!empty($guides)): ?>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Tên</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Ngày sinh</th>
                                    <th>Bio</th>
                                    <th>Vai trò</th>
                                    <th>Trạng thái</th>
                                    <th>Ngày tạo</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($guides as $g): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($g['id']); ?></td>
                                        <td><?php echo htmlspecialchars($g['name']); ?></td>
                                        <td><?php echo htmlspecialchars($g['email']); ?></td>
                                        <td><?php echo htmlspecialchars($g['phone']); ?></td>
                                        <td><?php echo htmlspecialchars(!empty($g['dob']) ? date('d/m/Y', strtotime($g['dob'])) : ''); ?></td>
                                        <td><?php echo !empty($g['bio']) ? nl2br(htmlspecialchars(mb_strimwidth($g['bio'], 0, 200, '...'))) : ''; ?></td>
                                        <td><?php echo htmlspecialchars($g['role'] ?? ''); ?></td>
                                        <td><?php echo htmlspecialchars($g['intro_status'] ?? ''); ?></td>
                                        <td><?php echo htmlspecialchars($g['created_at']); ?></td>
                                        <td>
                                            <a href="index.php?act=guide_edit&id=<?php echo $g['id']; ?>" class="btn btn-sm btn-primary">Sửa</a>
                                            <a href="index.php?act=guide_delete&id=<?php echo $g['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Xóa hướng dẫn viên này?');">Xóa</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <p>Không có hướng dẫn viên.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>