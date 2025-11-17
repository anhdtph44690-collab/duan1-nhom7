<?php
// Add Tour View - Form thêm tour mới
require_once './views/dashboard/layout_head.php';
?>
            <div class="container mt-5" style="max-width: 800px;">
        <div class="card mb-4">
            <div class="card-body">
                <h1 class="card-title">➕ Thêm Tour Mới</h1>
                <p class="card-text">Vui lòng điền đầy đủ thông tin tour</p>
            </div>
        </div>
        
        <div class="card">
        <div class="card-body">
            <?php
                $msg = $_GET['msg'] ?? null;
                if ($msg === 'required_fields') {
                    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                            ⚠️ Vui lòng điền đầy đủ các trường bắt buộc!
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                          </div>';
                } elseif ($msg === 'create_error') {
                    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                            ❌ Tạo tour thất bại! Vui lòng thử lại.
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                          </div>';
                }
            ?>
            
            <form method="POST" action="?act=submit-add-tour">
                <div class="mb-3">
                    <label for="name" class="form-label">Tên Tour *</label>
                    <input type="text" class="form-control" id="name" name="name" required placeholder="Ví dụ: Tour Phú Quốc 4N3Đ">
                </div>
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="category_id" class="form-label">Danh Mục</label>
                        <select class="form-select" id="category_id" name="category_id">
                            <option value="1">Biển</option>
                            <option value="2">Núi</option>
                            <option value="3">Nước Ngoài</option>
                        </select>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="price" class="form-label">Giá (VNĐ) *</label>
                        <input type="number" class="form-control" id="price" name="price">
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="duration" class="form-label">Thời Gian *</label>
                        <input type="text" class="form-control" id="duration" name="duration" required placeholder="Ví dụ: 4 ngày 3 đêm">
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="location" class="form-label">Điểm Đến *</label>
                        <input type="text" class="form-control" id="location" name="location" required placeholder="Ví dụ: Phú Quốc, Kiên Giang">
                    </div>
                </div>
                
                <div class="mb-3">
                    <label for="description" class="form-label">Mô Tả *</label>
                    <textarea class="form-control" id="description" name="description" rows="4" required placeholder="Mô tả chi tiết về tour..."></textarea>
                </div>
                
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-success btn-lg">✅ Tạo Tour</button>
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
