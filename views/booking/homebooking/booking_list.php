<?php
// Booking List View (Admin)
require_once './views/dashboard/layout_head.php';
?>
            <div class="container-fluid">
                <div class="card mb-4">
                    <div class="card-body">
                        <h1 class="card-title">📋 Danh Sách Đặt Tour</h1>
                        <p class="card-text">Quản lý các yêu cầu đặt tour từ khách hàng</p>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h3 class="mb-0">🎫 Danh Sách Booking</h3>
                    </div>
                    <div class="card-body">
                        <?php
                            $msg = $_GET['msg'] ?? null;
                            if ($msg === 'delete_success') {
                                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                        ✅ Xóa booking thành công!
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                      </div>';
                            } elseif ($msg === 'update_success') {
                                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                        ✅ Cập nhật trạng thái thành công!
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                      </div>';
                            }
                        ?>

                        <div class="table-responsive">
                            <table class="table table-hover table-striped">
                                <thead class="table-dark">
                                    <tr>
                                        <th>ID</th>
                                        <th>Tour</th>
                                        <th>Khách Hàng</th>
                                        <th>Email</th>
                                        <th>Điện Thoại</th>
                                        <th>Số Người</th>
                                        <th>Trạng Thái</th>
                                        <th>Hành Động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($bookings)): ?>
                                        <?php foreach ($bookings as $booking): ?>
                                        <tr>
                                            <td><span class="badge bg-primary"><?= $booking['id'] ?></span></td>
                                            <td><?= htmlspecialchars($booking['name']) ?></td>
                                            <td><?= htmlspecialchars($booking['customer_name']) ?></td>
                                            <td><?= htmlspecialchars($booking['email']) ?></td>
                                            <td><?= htmlspecialchars($booking['phone']) ?></td>
                                            <td><?= $booking['people_count'] ?></td>
                                            <td>
                                                <?php
                                                    $statusBadge = [
                                                        'pending' => 'warning',
                                                        'confirmed' => 'info',
                                                        'cancelled' => 'danger',
                                                        'completed' => 'success'
                                                    ];
                                                    $statusText = [
                                                        'pending' => '⏳ Chờ Xác Nhận',
                                                        'confirmed' => '✅ Đã Xác Nhận',
                                                        'cancelled' => '❌ Đã Hủy',
                                                        'completed' => '🎉 Hoàn Thành'
                                                    ];
                                                    $currentStatus = $booking['status'] ?? 'pending';
                                                    $badgeClass = $statusBadge[$currentStatus] ?? 'secondary';
                                                    $displayText = $statusText[$currentStatus] ?? 'Unknown';
                                                ?>
                                                <span class="badge bg-<?= $badgeClass ?>"><?= $displayText ?></span>
                                                
                                                <div class="mt-2">
                                                    <button class="btn btn-sm btn-outline-secondary" data-bs-toggle="collapse" data-bs-target="#collapse-<?= $booking['id'] ?>">
                                                        🔄 Thay Đổi
                                                    </button>
                                                </div>
                                                
                                                <div class="collapse mt-2" id="collapse-<?= $booking['id'] ?>">
                                                    <form method="POST" action="?act=update-booking" class="d-inline">
                                                        <div class="btn-group btn-group-sm" role="group">
                                                            <button type="submit" name="status" value="pending" class="btn btn-warning btn-sm" onclick="return confirm('Chuyển về Chờ Xác Nhận?')">⏳ Pending</button>
                                                            <button type="submit" name="status" value="confirmed" class="btn btn-info btn-sm" onclick="return confirm('Xác nhận booking này?')">✅ Confirmed</button>
                                                            <button type="submit" name="status" value="cancelled" class="btn btn-danger btn-sm" onclick="return confirm('Hủy booking này?')">❌ Cancelled</button>
                                                            <button type="submit" name="status" value="completed" class="btn btn-success btn-sm" onclick="return confirm('Đánh dấu hoàn thành?')">🎉 Completed</button>
                                                        </div>
                                                        <input type="hidden" name="id" value="<?= $booking['id'] ?>">
                                                    </form>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="btn-group btn-group-sm" role="group">
                                                    <a href="?act=delete-booking&id=<?= $booking['id'] ?>" class="btn btn-danger" onclick="return confirm('Bạn chắc chắn muốn xóa?')">
                                                        <i class="fas fa-trash"></i> Xóa
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="8" class="text-center text-muted">Chưa có booking nào</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
