<?php
// Include file kết nối PDO (đảm bảo file db.php đã được cấu hình đúng)
require_once 'db.php';

try {
    // Lấy tất cả khu vực, sắp xếp theo tên (hoặc theo thứ tự bạn mong muốn)
    $stmt = $pdo->query("SELECT name, image FROM areas ORDER BY id ASC");
    $areas = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $areas = [];
}
?>
<section class="area-section">
    <div class="area-container">
        <!-- Header -->
        <div class="area-header">
            <div class="area-title">
                <i class="fa-solid fa-binoculars"></i>
                <div>
                    <h2>Thông tin khu vực</h2>
                    <p>Danh sách thông tin khu vực trên cả nước</p>
                </div>
            </div>
            <a href="khu-vuc.php" class="view-all">Xem tất cả →</a>
        </div>

        <!-- Danh sách khu vực -->
        <div class="area-grid">
            <?php
                if (empty($areas)) {
                    echo '<p>Không có thông tin khu vực nào.</p>';
                } else {
                    foreach ($areas as $index => $area) {
                        $extraClass = ($index >= 4) ? "wide" : ""; // 2 ô cuối sẽ rộng hơn
                        echo '
                        <div class="area-item ' . $extraClass . '">
                            <img src="' . htmlspecialchars($area["image"]) . '" alt="' . htmlspecialchars($area["name"]) . '">
                            <div class="area-overlay">
                                <p>' . htmlspecialchars($area["name"]) . '</p>
                            </div>
                        </div>';
                    }
                }
            ?>
        </div>
    </div>
</section>