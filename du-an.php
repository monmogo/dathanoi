<?php
// du-an.php

// Include file kết nối PDO (đảm bảo file db.php nằm ở gốc dự án)
require_once 'db.php';

try {
    // Lấy tất cả dự án theo thứ tự ngày tạo giảm dần
    $stmt = $pdo->query("SELECT * FROM projects ORDER BY created_at DESC");
    $projects = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    // Nếu có lỗi, gán mảng rỗng
    $projects = [];
}
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dự Án Bất Động Sản</title>
    <!-- Nhúng Bootstrap CSS từ CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <!-- Nhúng file CSS tùy chỉnh nếu có -->
    <link rel="stylesheet" href="componer/css/style.css">
</head>

<body>
    <!-- Include Header nếu có -->
    <?php include 'header.php'; ?>

    <div class="container my-5">
        <h1 class="mb-4">Dự Án Bất Động Sản</h1>
        <!-- Phần danh sách dự án -->
        <div class="row">
            <?php if (empty($projects)): ?>
            <div class="col-12">
                <p class="text-center">Không có dự án nào.</p>
            </div>
            <?php else: ?>
            <?php foreach ($projects as $project): ?>
            <div class="col-12 col-md-6 col-lg-4 mb-4">
                <div class="card h-100 shadow-sm">
                    <?php if (!empty($project['image'])): ?>
                    <img src="<?php echo htmlspecialchars($project['image']); ?>" class="card-img-top"
                        alt="<?php echo htmlspecialchars($project['title']); ?>">
                    <?php endif; ?>
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
                        <!-- Link chi tiết dự án (nếu có trang project_detail.php) -->
                        <a href="project_detail.php?id=<?php echo $project['id']; ?>"
                            class="btn btn-primary btn-sm float-end">Xem chi tiết</a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>

    <!-- Include Footer nếu có -->
    <?php include 'footer.php'; ?>

    <!-- Nhúng Bootstrap Bundle JS (bao gồm Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>