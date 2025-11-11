<?php
// Edit Tour View - Form sửa tour
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
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        
        .form-header {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }
        
        .form-header h1 {
            color: #333;
            margin-bottom: 10px;
        }
        
        .form-content {
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #333;
        }
        
        input[type="text"],
        input[type="number"],
        textarea,
        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-family: Arial, sans-serif;
            font-size: 14px;
        }
        
        input[type="text"]:focus,
        input[type="number"]:focus,
        textarea:focus,
        select:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 5px rgba(102, 126, 234, 0.3);
        }
        
        textarea {
            resize: vertical;
            min-height: 100px;
        }
        
        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }
        
        .form-actions {
            display: flex;
            gap: 10px;
            margin-top: 30px;
        }
        
        .btn {
            padding: 12px 30px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: opacity 0.3s;
            text-decoration: none;
            display: inline-block;
            text-align: center;
        }
        
        .btn-submit {
            background-color: #ffc107;
            color: #333;
        }
        
        .btn-submit:hover {
            opacity: 0.9;
        }
        
        .btn-cancel {
            background-color: #6c757d;
            color: white;
        }
        
        .btn-cancel:hover {
            opacity: 0.9;
        }
        
        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
            border-left: 4px solid;
        }
        
        .alert-error {
            background-color: #f8d7da;
            color: #721c24;
            border-color: #dc3545;
        }
        
        .alert-warning {
            background-color: #fff3cd;
            color: #856404;
            border-color: #ffc107;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-header">
            <h1>✏️ Sửa Tour</h1>
            <p>Cập nhật thông tin tour</p>
        </div>
        
        <div class="form-content">
            <?php
                $msg = $_GET['msg'] ?? null;
                if ($msg === 'required_fields') {
                    echo '<div class="alert alert-warning">⚠️ Vui lòng điền đầy đủ các trường bắt buộc!</div>';
                } elseif ($msg === 'update_error') {
                    echo '<div class="alert alert-error">❌ Cập nhật tour thất bại! Vui lòng thử lại.</div>';
                }
            ?>
            
            <form method="POST" action="?act=submit-edit-tour">
                <input type="hidden" name="id" value="<?= htmlspecialchars($tour['id']) ?>">
                
                <div class="form-group">
                    <label for="name">Tên Tour *</label>
                    <input type="text" id="name" name="name" required placeholder="Ví dụ: Tour Phú Quốc 4N3Đ" value="<?= htmlspecialchars($tour['name']) ?>">
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="category_id">Danh Mục</label>
                        <select id="category_id" name="category_id">
                            <option value="1" <?= $tour['category_id'] == 1 ? 'selected' : '' ?>>Biển</option>
                            <option value="2" <?= $tour['category_id'] == 2 ? 'selected' : '' ?>>Núi</option>
                            <option value="3" <?= $tour['category_id'] == 3 ? 'selected' : '' ?>>Nước Ngoài</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="price">Giá (VNĐ) *</label>
                        <input type="number" id="price" name="price" >
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="duration">Thời Gian *</label>
                        <input type="text" id="duration" name="duration" required placeholder="Ví dụ: 4 ngày 3 đêm" value="<?= htmlspecialchars($tour['duration']) ?>">
                    </div>
                    
                    <div class="form-group">
                        <label for="location">Điểm Đến *</label>
                        <input type="text" id="location" name="location" required placeholder="Ví dụ: Phú Quốc, Kiên Giang" value="<?= htmlspecialchars($tour['location']) ?>">
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="description">Mô Tả *</label>
                    <textarea id="description" name="description" required placeholder="Mô tả chi tiết về tour..."><?= htmlspecialchars($tour['description']) ?></textarea>
                </div>
                
                <div class="form-group">
                    <label for="thumbnail">Ảnh Đại Diện</label>
                    <input type="text" id="thumbnail" name="thumbnail" placeholder="Ví dụ: tour.jpg" value="<?= htmlspecialchars($tour['thumbnail']) ?>">
                </div>
                
                <div class="form-actions">
                    <button type="submit" class="btn btn-submit">💾 Cập Nhật</button>
                    <a href="?act=dashboard" class="btn btn-cancel">❌ Hủy</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
