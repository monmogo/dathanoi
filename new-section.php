<?php
// new-section.php

// Include file kết nối PDO; vì new-section.php nằm ở gốc dự án nên đường dẫn là 'db.php'
require_once 'db.php';

try {
    // Lấy 6 tin tức mới nhất theo thứ tự ngày tạo giảm dần
    $stmt = $pdo->query("SELECT title, image FROM news ORDER BY created_at DESC LIMIT 6");
    $news = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    // Nếu có lỗi, gán mảng rỗng (bạn có thể ghi log lỗi nếu cần)
    $news = [];
}
?>
<section class="news-section">
    <div class="news-container">
        <!-- Header -->
        <div class="news-header">
            <div class="news-title">
                <i class="fa-solid fa-newspaper"></i>
                <div>
                    <h2>Tin tức</h2>
                    <p>Tin tức bất động sản mới nhất cả nước</p>
                </div>
            </div>
            <a href="tin-tuc.php" class="view-all">Xem tất cả →</a>
        </div>

        <!-- Danh sách tin tức -->
        <div class="news-grid">
            <?php if (empty($news)): ?>
            <p>Không có tin tức nào.</p>
            <?php else: ?>
            <?php foreach ($news as $index => $item): 
            // Xác định các lớp CSS dựa trên vị trí của tin
            $extraClass   = ($index === 0) ? "large" : "";
            $hiddenClass  = ($index >= 5) ? "hidden-pc" : "";  // Ẩn bài viết thứ 6 trở đi trên PC
            $hiddenMobile = ($index >= 2) ? "hidden-mobile" : ""; // Ẩn bài thứ 3 trở đi trên Mobile

            // Kết hợp các lớp CSS, loại bỏ khoảng trắng thừa
            $classes = trim("$extraClass $hiddenClass $hiddenMobile");
        ?>
            <div class="news-item <?php echo $classes; ?>">
                <img src="<?php echo 'uploads/' . htmlspecialchars($item['image']); ?>"
                    alt="<?php echo htmlspecialchars($item['title']); ?>">
                <div class="news-overlay">
                    <p><?php echo htmlspecialchars($item['title']); ?></p>
                </div>
            </div>
            <?php endforeach; ?>
            <?php endif; ?>
        </div>



        <!-- Nút Xem thêm -->
        <button class="see-more-btn" id="seeMoreBtn" onclick="window.location.href='tin-tuc.php'">Xem thêm</button>
    </div>
</section>