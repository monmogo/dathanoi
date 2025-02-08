<?php
// project_detail.php

// Include file kết nối PDO (đảm bảo file db.php nằm ở gốc dự án)
require_once 'db.php';

// Kiểm tra tham số id
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: du-an.php");
    exit();
}

$id = intval($_GET['id']);

try {
    // Sử dụng prepared statement để lấy chi tiết dự án theo id
    $stmt = $pdo->prepare("SELECT * FROM projects WHERE id = :id");
    $stmt->execute([':id' => $id]);
    $project = $stmt->fetch(PDO::FETCH_ASSOC);
    
    // Nếu không tìm thấy dự án, chuyển hướng về trang danh sách dự án
    if (!$project) {
        header("Location: du-an.php");
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
    <title><?php echo htmlspecialchars($project['title']); ?> - Dự án Bất động sản</title>
    <!-- Nhúng Bootstrap CSS từ CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <!-- Nhúng file CSS tùy chỉnh nếu có -->
    <link rel="stylesheet" href="componer/css/style.css">
</head>

<body>
    <!-- Include header nếu có -->
    <?php include 'header.php'; ?>

    <div class="container my-5">
        <div class="row">
            <div class="col-12">
                <h1><?php echo htmlspecialchars($project['title']); ?></h1>
                <p class="text-muted"><?php echo date("d/m/Y", strtotime($project['created_at'])); ?></p>
                <?php if (!empty($project['image'])): ?>
                <img src="<?php echo htmlspecialchars($project['image']); ?>" class="img-fluid mb-4"
                    alt="<?php echo htmlspecialchars($project['title']); ?>">
                <?php endif; ?>
                <div class="project-details">
                    <h4>Thông tin dự án:</h4>
                    <ul class="list-unstyled">
                        <li><strong>Diện tích:</strong> <?php echo htmlspecialchars($project['size']); ?></li>
                        <li><strong>Loại hình:</strong> <?php echo htmlspecialchars($project['type']); ?></li>
                        <li><strong>Tình trạng:</strong> <?php echo htmlspecialchars($project['status']); ?></li>
                    </ul>
                    <?php if (!empty($project['description'])): ?>
                    <div class="project-description">
                        <h5>Mô tả dự án:</h5>
                        <?php 
                // Hiển thị mô tả dự án (có thể chứa HTML)
                echo $project['description'];
              ?>
                    </div>
                    <?php endif; ?>
                </div>
                <a href="du-an.php" class="btn btn-secondary mt-4">Quay lại danh sách dự án</a>
            </div>
        </div>
    </div>

    <!-- Include footer nếu có -->
    <?php include 'footer.php'; ?>

    <!-- Nhúng Bootstrap Bundle JS (bao gồm Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>