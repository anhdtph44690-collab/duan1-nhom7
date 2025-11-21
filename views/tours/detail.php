<?php
require_once './views/dashboard/layout_head.php';
?>
<div class="container my-5">
    <div class="row">
        <div class="col-md-8">
            <div class="card mb-4">
                <?php if (!empty($tour['thumbnail'])): ?>
                    <img src="<?= htmlspecialchars($tour['thumbnail']) ?>" class="card-img-top" alt="<?= htmlspecialchars($tour['name']) ?>">
                <?php endif; ?>
                <div class="card-body">
                    <h2 class="card-title"><?= htmlspecialchars($tour['name']) ?></h2>
                    <p class="text-muted"><?= htmlspecialchars($tour['location'] ?? '') ?> • <?= htmlspecialchars($tour['duration'] ?? '') ?></p>
                    <h4 class="text-success">Giá: <?= number_format((float)($tour['price'] ?? 0), 0, ',', '.') ?> đ</h4>
                    <hr>
                    <p><?= nl2br(htmlspecialchars($tour['description'] ?? '')) ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card p-3">
                <h5>Đặt Tour</h5>
                <p><strong>Giá:</strong> <?= number_format((float)($tour['price'] ?? 0), 0, ',', '.') ?> đ</p>
                <p><strong>Thời gian:</strong> <?= htmlspecialchars($tour['duration'] ?? '') ?></p>
                <a href="?act=booking&tour_id=<?= $tour['id'] ?>" class="btn btn-primary w-100">🎫 Đặt Tour</a>
                <a href="?act=/" class="btn btn-secondary w-100 mt-2">← Quay về</a>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
