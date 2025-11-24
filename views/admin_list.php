<?php
// Danh sách admin với Bootstrap styling
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý Admin - Tour Du Lịch</title>
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

        .list-container {
            margin-top: 40px;
            margin-bottom: 40px;
        }

        .header-section {
            background: white;
            border-radius: 10px;
            padding: 25px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
            border-left: 5px solid var(--primary-color);
        }

        .header-section h2 {
            color: var(--secondary-color);
            font-weight: bold;
            margin: 0;
        }

        .action-buttons {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }

        .action-buttons a,
        .action-buttons button {
            padding: 10px 20px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-create {
            background: linear-gradient(135deg, #27ae60 0%, #1e7e74 100%);
            color: white;
        }

        .btn-create:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(39, 174, 96, 0.3);
            color: white;
            text-decoration: none;
        }

        .btn-dashboard {
            background: linear-gradient(135deg, #52be80 0%, #27ae60 100%);
            color: white;
        }

        .btn-dashboard:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(82, 190, 128, 0.3);
            color: white;
            text-decoration: none;
        }

        .btn-logout {
            background: linear-gradient(135deg, #5dade2 0%, #3498db 100%);
            color: white;
        }

        .btn-logout:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(93, 173, 226, 0.3);
            color: white;
            text-decoration: none;
        }

        .table-container {
            background: white;
            border-radius: 10px;
            padding: 25px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        }

        .table {
            margin-bottom: 0;
        }

        .table thead {
            background: linear-gradient(90deg, #1e5631 0%, #27ae60 100%);
            color: white;
        }

        .table thead th {
            border: none;
            font-weight: 600;
            padding: 15px;
        }

        .table tbody tr {
            border-bottom: 1px solid #e0e0e0;
            transition: all 0.3s ease;
        }

        .table tbody tr:hover {
            background: #f9f9f9;
        }

        .table tbody td {
            padding: 15px;
            vertical-align: middle;
        }

        .badge-role {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 500;
        }

        .badge-admin {
            background: #d4edda;
            color: #155724;
        }

        .badge-manager {
            background: #cfe2ff;
            color: #084298;
        }

        .action-links {
            display: flex;
            gap: 10px;
        }

        .btn-sm-custom {
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 0.85rem;
            text-decoration: none;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        .btn-edit {
            background: #27ae60;
            color: white;
        }

        .btn-edit:hover {
            background: #1e7e74;
            color: white;
            text-decoration: none;
        }

        .btn-delete {
            background: #dc3545;
            color: white;
        }

        .btn-delete:hover {
            background: #c82333;
            color: white;
            text-decoration: none;
        }

        .empty-state {
            text-align: center;
            padding: 40px;
            color: #999;
        }

        .empty-state i {
            font-size: 3rem;
            margin-bottom: 15px;
            opacity: 0.5;
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
    <div class="list-container container">
        <!-- Header -->
        <div class="header-section">
            <h2><i class="bi bi-list-ul"></i> Danh sách Admin</h2>
        </div>

        <!-- Action Buttons -->
        <div class="action-buttons">
            <a href="index.php?act=admin_register" class="btn-create">
                <i class="bi bi-person-plus"></i> Tạo admin mới
            </a>
            <a href="index.php?act=admin_dashboard" class="btn-dashboard">
                <i class="bi bi-house"></i> Quay lại Dashboard
            </a>
            <a href="index.php?act=admin_logout" class="btn-logout">
                <i class="bi bi-box-arrow-right"></i> Đăng xuất
            </a>
        </div>

        <!-- Table -->
        <div class="table-container">
            <?php if (!empty($admins)): ?>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th><i class="bi bi-hash"></i> ID</th>
                                <th><i class="bi bi-person"></i> Tên</th>
                                <th><i class="bi bi-envelope"></i> Email</th>
                                <th><i class="bi bi-shield"></i> Trạng thái</th>
                                <th><i class="bi bi-calendar"></i> Ngày tạo</th>
                                <th><i class="bi bi-gear"></i> Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($admins as $a): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($a['id']); ?></td>
                                    <td><?php echo htmlspecialchars($a['name']); ?></td>
                                    <td><?php echo htmlspecialchars($a['email']); ?></td>
                                    <td>
                                        <span class="badge-role badge-<?php echo htmlspecialchars($a['role']); ?>">
                                            <?php echo htmlspecialchars($a['role']); ?>
                                        </span>
                                    </td>
                                    <td><?php echo htmlspecialchars(date('d/m/Y H:i', strtotime($a['created_at']))); ?></td>
                                    <td>
                                        <div class="action-links">
                                            <a href="index.php?act=admin_edit&id=<?php echo $a['id']; ?>" class="btn-sm-custom btn-edit">
                                                <i class="bi bi-pencil"></i> Sửa
                                            </a>
                                            <?php if (!isset($_SESSION['admin']) || $_SESSION['admin']['id'] != $a['id']): ?>
                                                <a href="index.php?act=admin_delete&id=<?php echo $a['id']; ?>" class="btn-sm-custom btn-delete" onclick="return confirm('Bạn chắc chắn muốn xóa admin này?');">
                                                    <i class="bi bi-trash"></i> Xóa
                                                </a>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <div class="empty-state">
                    <i class="bi bi-inbox"></i>
                    <h4>Không có admin nào</h4>
                    <p>Hãy <a href="index.php?act=admin_register">tạo admin mới</a></p>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>