<?php
// Dashboard View
require_once './views/dashboard/layout_head.php';
?>
            <div class="container-fluid">
        <div class="card mb-4">
            <div class="card-body">
                <h1 class="card-title"> Dashboard</h1>
                <p class="card-text">Chào mừng bạn đến với trang quản lý</p>
            </div>
        </div>
        
        <div class="card">
            <div class="card-header">
                <h2 class="mb-0"> Quản Lý Tour</h2>
            </div>
            <div class="card-body">
            
            <?php
                $msg = $_GET['msg'] ?? null;
                if ($msg === 'delete_success') {
                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                             Xóa tour thành công!
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                          </div>';
                } elseif ($msg === 'delete_error') {
                    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                             Xóa tour thất bại!
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                          </div>';
                } elseif ($msg === 'invalid_id') {
                    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                             ID không hợp lệ!
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                          </div>';
                } elseif ($msg === 'create_success') {
                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                             Tạo tour thành công!
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                          </div>';
                } elseif ($msg === 'update_success') {
                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                             Cập nhật tour thành công!
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                          </div>';
                } elseif ($msg === 'tour_not_found') {
                    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                             Tour không tồn tại!
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                          </div>';
                }
            ?>
            
            <a href="?act=add-tour" class="btn btn-success btn-lg mb-3">+ Thêm Tour Mới</a>
            
            <?php if (!empty($tours)): ?>
            <table class="table table-hover">
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
                        <td><span class="badge bg-primary"><?= htmlspecialchars($tour['id']) ?></span></td>
                        <td><?= htmlspecialchars($tour['name']) ?></td>
                        <td><?= htmlspecialchars($tour['location']) ?></td>
                        <td><?= htmlspecialchars($tour['duration']) ?></td>
                        <td><strong><?= number_format((float)$tour['price'], 0, ',', '.') ?></strong> đ</td>
                        <td>
                            <span title="<?= htmlspecialchars($tour['description']) ?>">
                                <?= htmlspecialchars(substr($tour['description'], 0, 50)) ?>...
                            </span>
                        </td>
                        <td>
                            <div class="btn-group btn-group-sm" role="group">
                                <a href="?act=edit-tour&id=<?= $tour['id'] ?>" class="btn btn-warning">✏️ Sửa</a>
                                <a href="?act=delete-tour&id=<?= $tour['id'] ?>" class="btn btn-danger" onclick="return confirm('Bạn chắc chắn muốn xóa?')">🗑️ Xóa</a>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?php else: ?>
            <div class="alert alert-info">
                <p class="mb-0">Không có tour nào. <a href="?act=add-tour" class="alert-link">Thêm tour mới</a></p>
            </div>
            <?php endif; ?>
            
            <div class="mt-4">
                <a href="?act=/" class="btn btn-secondary">← Quay lại Trang Chủ</a>
            </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
