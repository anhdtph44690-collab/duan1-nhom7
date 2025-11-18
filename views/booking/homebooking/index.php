<?php
// Booking View
require_once './views/dashboard/layout_head.php';
?>
            <div class="container-fluid">
                <div class="card mb-4">
                    <div class="card-body">
                        <h1 class="card-title">📅 Đặt Tour Du Lịch</h1>
                        <p class="card-text">Vui lòng điền thông tin để hoàn tất việc đặt tour</p>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h3 class="mb-0">🎫 Mẫu Đặt Tour</h3>
                    </div>
                    <div class="card-body">
                        <?php
                            $msg = $_GET['msg'] ?? null;
                            if ($msg === 'booking_success') {
                                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                        ✅ Đặt tour thành công! Chúng tôi sẽ liên hệ với bạn sớm.
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                      </div>';
                            } elseif ($msg === 'booking_error') {
                                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        ❌ Đặt tour thất bại! Vui lòng thử lại hoặc kiểm tra lại thông tin.
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                      </div>';
                            } elseif ($msg === 'required_fields') {
                                echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                                        ⚠️ Vui lòng điền đầy đủ các trường bắt buộc!
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                      </div>';
                            } elseif ($msg === 'invalid_email') {
                                echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                                        ⚠️ Email không hợp lệ! Vui lòng kiểm tra lại.
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                      </div>';
                            } elseif ($msg === 'invalid_tour') {
                                echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                                        ⚠️ Tour được chọn không tồn tại! Vui lòng chọn tour khác.
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                      </div>';
                            } elseif ($msg === 'invalid_date') {
                                echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                                        ⚠️ Ngày khởi hành không hợp lệ! Vui lòng kiểm tra lại.
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                      </div>';
                            } elseif ($msg === 'past_date') {
                                echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                                        ⚠️ Ngày khởi hành không thể là ngày quá khứ! Vui lòng chọn ngày trong tương lai.
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                      </div>';
                            }
                        ?>

                        <form method="POST" action="?act=submit-booking">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="tour_id" class="form-label">Chọn Tour *</label>
                                    <select class="form-select" id="tour_id" name="tour_id" required>
                                        <option value="">-- Chọn tour --</option>
                                        <?php if (!empty($tours)): ?>
                                            <?php foreach ($tours as $tour): ?>
                                            <option value="<?= $tour['id'] ?>">
                                                <?= htmlspecialchars($tour['name']) ?> (<?= number_format((float)$tour['price'], 0, ',', '.') ?> đ)
                                            </option>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </select>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="people_count" class="form-label">Số Lượng Người *</label>
                                    <input type="number" class="form-control" id="people_count" name="people_count" min="1" required placeholder="Ví dụ: 2">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="customer_name" class="form-label">Họ Tên *</label>
                                    <input type="text" class="form-control" id="customer_name" name="customer_name" required placeholder="Ví dụ: Nguyễn Văn A">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="departure_date" class="form-label">Ngày Khởi Hành *</label>
                                    <input type="date" class="form-control" id="departure_date" name="departure_date" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="phone" class="form-label">Số Điện Thoại *</label>
                                    <input type="tel" class="form-control" id="phone" name="phone" required placeholder="Ví dụ: 0912345678">
                                </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email *</label>
                                <input type="email" class="form-control" id="email" name="email" required placeholder="Ví dụ: user@example.com">
                            </div>

                            <div class="mb-3">
                                <label for="notes" class="form-label">Ghi Chú Thêm</label>
                                <textarea class="form-control" id="notes" name="notes" rows="4" placeholder="Thêm yêu cầu đặc biệt (không bắt buộc)..."></textarea>
                            </div>

                            <div class="alert alert-info" role="alert">
                                <i class="fas fa-info-circle"></i> <strong>Lưu ý:</strong> Chúng tôi sẽ xác nhận đơn đặt tour của bạn qua email hoặc điện thoại trong vòng 24 giờ.
                            </div>

                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    <i class="fas fa-check"></i> Xác Nhận Đặt Tour
                                </button>
                                <a href="?act=/" class="btn btn-secondary btn-lg">
                                    <i class="fas fa-times"></i> Hủy
                                </a>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Tours Info Section -->
                <div class="card mt-4">
                    <div class="card-header">
                        <h3 class="mb-0">🗺️ Các Tour Đã Được Đặt</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <?php if (!empty($bookedTours)): ?>
                                <?php $count = 0; foreach ($bookedTours as $tour): ?>
                                    <?php if ($count >= 3) break; ?>
                                    <div class="col-md-4 mb-3">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title"><?= htmlspecialchars($tour['name']) ?></h5>
                                                <p class="card-text">
                                                    <strong>Điểm đến:</strong> <?= htmlspecialchars($tour['location']) ?><br>
                                                    <strong>Thời gian:</strong> <?= htmlspecialchars($tour['duration']) ?><br>
                                                    <strong>Giá:</strong> <span class="badge bg-success"><?= number_format((float)$tour['price'], 0, ',', '.') ?> đ</span>
                                                </p>
                                                <p class="small text-muted"><?= htmlspecialchars(substr($tour['description'], 0, 100)) ?>...</p>
                                            </div>
                                        </div>
                                    </div>
                                    <?php $count++; ?>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <div class="col-12">
                                    <div class="alert alert-info">
                                        <i class="fas fa-info-circle"></i> Hiện tại chưa có tour nào được đặt. Vui lòng quay lại sau!
                                    </div>
                                </div>
                            <?php endif; ?>
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
