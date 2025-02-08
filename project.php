<?php
// Include file kết nối PDO (ví dụ: db.php nằm ở gốc dự án)
require_once 'db.php';

try {
    // Lấy 8 dự án mới nhất theo thứ tự ngày tạo giảm dần
    $stmt = $pdo->query("SELECT title, size, type, status, image FROM projects ORDER BY created_at DESC LIMIT 8");
    $projects = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $projects = [];
}
?>
<section class="projects-section py-5">
    <div class="container">
        <!-- Header của phần dự án -->
        <div class="projects-header d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0">Dự án mới cập nhật</h2>
            <a href="du-an.php" class="btn btn-outline-primary">Xem tất cả</a>
        </div>

        <!-- Danh sách dự án sử dụng Bootstrap grid và card -->
        <div class="row">
            <?php if (empty($projects)): ?>
            <div class="col-12">
                <p class="text-center">Không có dự án nào.</p>
            </div>
            <?php else: ?>
            <?php foreach ($projects as $project): ?>
            <div class="col-12 col-md-6 col-lg-4 mb-4">
                <div class="card h-100 shadow-sm">
                    <img src="<?php echo htmlspecialchars($project['image']); ?>" class="card-img-top"
                        alt="<?php echo htmlspecialchars($project['title']); ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo htmlspecialchars($project['title']); ?></h5>
                        <p class="card-text mb-1">
                            <strong>Diện tích:</strong> <?php echo htmlspecialchars($project['size']); ?>
                        </p>
                        <p class="card-text mb-1">
                            <strong>Loại hình:</strong> <?php echo htmlspecialchars($project['type']); ?>
                        </p>
                    </div>
                    <div class="card-footer">
                        <span class="badge bg-success"><?php echo htmlspecialchars($project['status']); ?></span>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <!-- Nút Xem thêm (hiển thị khi cần, ví dụ thông qua JS) -->
        <div class="text-center">
            <button class="btn btn-primary see-more-btn" id="seeMoreBtn" style="display: none;">Xem thêm</button>
        </div>
    </div>
</section>