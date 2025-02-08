<?php
// news_detail.php

// Include file kết nối PDO
require_once 'db.php';

// Kiểm tra xem có nhận được tham số id không
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: tin-tuc.php");
    exit();
}

$id = intval($_GET['id']);

try {
    // Sử dụng prepared statement để lấy chi tiết tin tức theo id
    $stmt = $pdo->prepare("SELECT * FROM news WHERE id = :id");
    $stmt->execute([':id' => $id]);
    $newsItem = $stmt->fetch(PDO::FETCH_ASSOC);
    
    // Nếu không tìm thấy tin tức, chuyển hướng về trang danh sách tin
    if (!$newsItem) {
        header("Location: tin-tuc.php");
        exit();
    }
} catch (PDOException $e) {
    die("Lỗi truy vấn: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($newsItem['title']); ?> - Tin Tức</title>
    <!-- Nhúng Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <!-- Nhúng CSS tùy chỉnh nếu có -->
    <link rel="stylesheet" href="componer/css/style.css">
</head>

<body>
    <!-- Include header nếu có -->
    <?php include 'header.php'; ?>

    <div class="container my-4">
        <div class="row">
            <div class="col-12">
                <h1><?php echo htmlspecialchars($newsItem['title']); ?></h1>
                <p class="text-muted">
                    <?php echo date("d/m/Y", strtotime($newsItem['created_at'])); ?>
                </p>
                <?php if (!empty($newsItem['image'])): ?>
                <img src="uploads/<?php echo htmlspecialchars($newsItem['image']); ?>"
                    alt="<?php echo htmlspecialchars($newsItem['title']); ?>" class="img-fluid mb-4">
                <?php endif; ?>
                <div class="news-content">
                    <?php 
                    // Nếu nội dung có chứa HTML, hiển thị trực tiếp
                    echo $newsItem['content']; 
                    ?>
                </div>
                <a href="tin-tuc.php" class="btn btn-secondary mt-4">Quay lại danh sách tin tức</a>
            </div>
        </div>
    </div>

    <!-- Include footer nếu có -->
    <?php include 'footer.php'; ?>

    <!-- Nhúng Bootstrap Bundle JS (bao gồm Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>