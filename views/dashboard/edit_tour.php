<?php
// Edit Tour View - Form sửa tour
require_once './views/dashboard/layout_head.php';
?>
            <div class="container mt-5" style="max-width: 800px;">
        <div class="card mb-4">
            <div class="card-body">
                <h1 class="card-title"> Sửa Tour</h1>
                <p class="card-text">Cập nhật thông tin tour</p>
            </div>
        </div>
        
        <div class="card">
        <div class="card-body">
            <?php
                $msg = $_GET['msg'] ?? null;
                if ($msg === 'required_fields') {
                    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                             Vui lòng điền đầy đủ các trường bắt buộc!
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                          </div>';
                } elseif ($msg === 'update_error') {
                    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                             Cập nhật tour thất bại! Vui lòng thử lại.
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                          </div>';
                }
            ?>
            
            <form method="POST" action="?act=submit-edit-tour">
                <input type="hidden" name="id" value="<?= htmlspecialchars($tour['id']) ?>">
                
                <div class="mb-3">
                    <label for="name" class="form-label">Tên Tour *</label>
                    <input type="text" class="form-control" id="name" name="name" required placeholder="Ví dụ: Tour Phú Quốc 4N3Đ" value="<?= htmlspecialchars($tour['name']) ?>">
                </div>
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="category_id" class="form-label">Danh Mục</label>
                        <select class="form-select" id="category_id" name="category_id">
                            <option value="1" <?= $tour['category_id'] == 1 ? 'selected' : '' ?>>Biển</option>
                            <option value="2" <?= $tour['category_id'] == 2 ? 'selected' : '' ?>>Núi</option>
                            <option value="3" <?= $tour['category_id'] == 3 ? 'selected' : '' ?>>Nước Ngoài</option>
                        </select>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="price" class="form-label">Giá (VNĐ) *</label>
                        <input type="number" class="form-control" id="price" name="price" value="<?= htmlspecialchars($tour['price']) ?>">
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="duration" class="form-label">Thời Gian *</label>
                        <input type="text" class="form-control" id="duration" name="duration" required placeholder="Ví dụ: 4 ngày 3 đêm" value="<?= htmlspecialchars($tour['duration']) ?>">
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="location" class="form-label">Điểm Đến *</label>
                        <input type="text" class="form-control" id="location" name="location" required placeholder="Ví dụ: Phú Quốc, Kiên Giang" value="<?= htmlspecialchars($tour['location']) ?>">
                    </div>
                </div>
                
                <div class="mb-3">
                    <label for="description" class="form-label">Mô Tả *</label>
                    <textarea class="form-control" id="description" name="description" rows="4" required placeholder="Mô tả chi tiết về tour..."><?= htmlspecialchars($tour['description']) ?></textarea>
                </div>
                
            
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-warning btn-lg">💾 Cập Nhật</button>
                    <a href="?act=dashboard" class="btn btn-secondary btn-lg">❌ Hủy</a>
                </div>
            </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
