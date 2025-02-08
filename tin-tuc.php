<?php
// tin-tuc.php

// Include file kết nối PDO
require_once 'db.php';

try {
    // Lấy tất cả tin tức theo thứ tự ngày tạo giảm dần
    $stmt = $pdo->query("SELECT * FROM news ORDER BY created_at DESC");
    $news = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    // Nếu có lỗi, gán mảng rỗng và bạn có thể ghi log lỗi nếu cần
    $news = [];
}
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tin Tức - Dân Đầu Tư</title>
    <!-- Nhúng CSS của Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <!-- Nhúng Font Awesome (nếu cần) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <!-- Nhúng file CSS tùy chỉnh (nếu có) -->
    <link rel="stylesheet" href="componer/css/style.css">
</head>

<body>
    <!-- Header (có thể include file header.php nếu có) -->
    <?php include 'header.php'; ?>

    <div class="container my-4">
        <h1 class="mb-4">Tin Tức</h1>
        <div class="row">
            <?php if(empty($news)): ?>
            <p>Không có tin tức nào.</p>
            <?php else: ?>
            <?php foreach($news as $item): ?>
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <?php if(!empty($item['image'])): ?>
                    <img src="uploads/<?php echo htmlspecialchars($item['image']); ?>" class="card-img-top"
                        alt="<?php echo htmlspecialchars($item['title']); ?>">
                    <?php endif; ?>
                    <div class="card-body">
                        <h5 class="card-title"><?php echo htmlspecialchars($item['title']); ?></h5>
                        <!-- Nếu có thể, hiển thị đoạn trích ngắn từ nội dung tin -->
                        <p class="card-text">
                            <?php 
                                    // Cắt nội dung tin thành 150 ký tự (loại bỏ thẻ HTML)
                                    echo substr(strip_tags($item['content']), 0, 150) . '...'; 
                                    ?>
                        </p>
                        <a href="news_detail.php?id=<?php echo $item['id']; ?>" class="btn btn-primary">Xem chi tiết</a>
                    </div>
                    <div class="card-footer text-muted">
                        <?php echo date("d/m/Y", strtotime($item['created_at'])); ?>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>

    <!-- Footer (có thể include file footer.php nếu có) -->
    <?php include 'footer.php'; ?>

    <!-- Nhúng Bootstrap Bundle JS (bao gồm Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>