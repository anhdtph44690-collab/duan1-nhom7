<?php
// Dashboard View
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        
        .dashboard-header {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }
        
        .dashboard-header h1 {
            color: #333;
            margin-bottom: 10px;
        }
        
        .dashboard-content {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        
        .section-title {
            margin: 30px 0 20px 0;
            font-size: 20px;
            font-weight: bold;
            color: #333;
            border-bottom: 2px solid #667eea;
            padding-bottom: 10px;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        
        table thead {
            background-color: #667eea;
            color: white;
        }
        
        table th, table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        
        table tbody tr:hover {
            background-color: #f9f9f9;
        }
        
        table tbody tr:nth-child(even) {
            background-color: #f5f5f5;
        }
        
        .action-buttons {
            display: flex;
            gap: 5px;
        }
        
        .btn {
            padding: 6px 12px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            font-size: 12px;
            transition: opacity 0.3s;
        }
        
        .btn-edit {
            background-color: #ffc107;
            color: #333;
        }
        
        .btn-edit:hover {
            opacity: 0.8;
        }
        
        .btn-delete {
            background-color: #dc3545;
            color: white;
        }
        
        .btn-delete:hover {
            opacity: 0.8;
        }
        
        .btn-add {
            background-color: #28a745;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            display: inline-block;
            margin-bottom: 20px;
        }
        
        .btn-add:hover {
            opacity: 0.8;
        }
        
        .no-data {
            text-align: center;
            padding: 20px;
            color: #999;
        }
        
        .nav-links {
            margin-top: 20px;
        }
        
        .nav-links a {
            display: inline-block;
            margin-right: 15px;
            padding: 10px 20px;
            background-color: #667eea;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        
        .nav-links a:hover {
            background-color: #764ba2;
        }
        
        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
            border-left: 4px solid;
        }
        
        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border-color: #28a745;
        }
        
        .alert-error {
            background-color: #f8d7da;
            color: #721c24;
            border-color: #dc3545;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="dashboard-header">
            <h1>📊 Dashboard</h1>
            <p>Chào mừng bạn đến với trang quản lý</p>
        </div>
        
        <div class="dashboard-content">
            <h2 class="section-title">📍 Quản Lý Tour</h2>
            
            <?php
                $msg = $_GET['msg'] ?? null;
                if ($msg === 'delete_success') {
                    echo '<div class="alert alert-success">✅ Xóa tour thành công!</div>';
                } elseif ($msg === 'delete_error') {
                    echo '<div class="alert alert-error">❌ Xóa tour thất bại!</div>';
                } elseif ($msg === 'invalid_id') {
                    echo '<div class="alert alert-error">❌ ID không hợp lệ!</div>';
                } elseif ($msg === 'create_success') {
                    echo '<div class="alert alert-success">✅ Tạo tour thành công!</div>';
                } elseif ($msg === 'update_success') {
                    echo '<div class="alert alert-success">✅ Cập nhật tour thành công!</div>';
                } elseif ($msg === 'tour_not_found') {
                    echo '<div class="alert alert-error">❌ Tour không tồn tại!</div>';
                }
            ?>
            
            <a href="?act=add-tour" class="btn-add">+ Thêm Tour Mới</a>
            
            <?php if (!empty($tours)): ?>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tên Tour</th>
                        <th>Điểm Đến</th>
                        <th>Thời Gian</th>
                        <th>Giá</th>
                        <th>Mô Tả</th>
                        <th>Thao Tác</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($tours as $tour): ?>
                    <tr>
                        <td><?= htmlspecialchars($tour['id']) ?></td>
                        <td><?= htmlspecialchars($tour['name']) ?></td>
                        <td><?= htmlspecialchars($tour['location']) ?></td>
                        <td><?= htmlspecialchars($tour['duration']) ?></td>
                        <td><?= number_format((float)$tour['price'], 0, ',', '.') ?> đ</td>
                        <td>
                            <span title="<?= htmlspecialchars($tour['description']) ?>">
                                <?= htmlspecialchars(substr($tour['description'], 0, 50)) ?>...
                            </span>
                        </td>
                        <td>
                            <div class="action-buttons">
                                <a href="?act=edit-tour&id=<?= $tour['id'] ?>" class="btn btn-edit">✏️ Sửa</a>
                                <a href="?act=delete-tour&id=<?= $tour['id'] ?>" class="btn btn-delete" onclick="return confirm('Bạn chắc chắn muốn xóa?')">🗑️ Xóa</a>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?php else: ?>
            <div class="no-data">
                <p>Không có tour nào. <a href="?act=add-tour">Thêm tour mới</a></p>
            </div>
            <?php endif; ?>
            
            <div class="nav-links" style="margin-top: 30px;">
                <a href="?act=/">← Quay lại Trang Chủ</a>
            </div>
        </div>
    </div>
</body>
</html>
