<?php
// khu-vuc.php
require_once 'db.php';

try {
    // Lấy tất cả thông tin khu vực, sắp xếp theo id tăng dần
    $stmt = $pdo->query("SELECT * FROM areas ORDER BY id ASC");
    $areas = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Lỗi truy vấn: " . $e->getMessage());
}

// Đường dẫn mặc định nếu không có ảnh hoặc file không tồn tại
$defaultAreaImage = "componer/asset/image/default_area.jpg";
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông tin Khu vực - Dân Đầu Tư</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="componer/css/style.css">
    <style>
    body {
        font-family: 'Roboto', sans-serif;
        background-color: #f4f6f9;
    }

    .area-section {
        padding: 60px 0;
        background-color: #fff;
    }

    .area-header {
        margin-bottom: 40px;
    }

    .area-title {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .area-title h2 {
        margin: 0;
        font-size: 2rem;
        font-weight: 500;
    }

    .area-title p {
        margin: 0;
        font-size: 1rem;
        color: #666;
    }

    .area-grid {
        margin-top: 30px;
    }

    .area-item {
        position: relative;
        overflow: hidden;
        border-radius: 8px;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s;
    }

    .area-item:hover {
        transform: scale(1.02);
    }

    .area-item img {
        width: 100%;
        height: 200px;
        object-fit: cover;
        display: block;
    }

    .area-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.4);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity 0.3s;
    }

    .area-item:hover .area-overlay {
        opacity: 1;
    }

    .area-overlay p {
        color: #fff;
        font-size: 1.25rem;
        font-weight: 500;
        margin: 0;
    }
    </style>
</head>

<body>
    <!-- Include Header -->
    <?php include 'header.php'; ?>

    <section class="area-section">
        <div class="container">
            <!-- Header của khu vực -->
            <div class="area-header d-flex justify-content-between align-items-center">
                <div class="area-title d-flex align-items-center">
                    <i class="fa-solid fa-binoculars fa-2x text-primary"></i>
                    <div>
                        <h2>Thông tin Khu vực</h2>
                        <p>Danh sách thông tin khu vực trên cả nước</p>
                    </div>
                </div>
                <a href="khu-vuc.php" class="btn btn-outline-primary">Xem tất cả →</a>
            </div>
            <!-- Danh sách khu vực -->
            <div class="area-grid row">
                <?php if (empty($areas)): ?>
                <div class="col-12">
                    <p class="text-center">Không có thông tin khu vực nào.</p>
                </div>
                <?php else: ?>
                <?php foreach ($areas as $area): ?>
                <div class="col-12 col-sm-6 col-md-4 mb-4">
                    <div class="area-item">
                        <?php 
                  // Kiểm tra nếu trường image không rỗng, lấy đường dẫn ảnh từ thư mục uploads
                  // Nếu không tồn tại, dùng ảnh mặc định.
                  $imgPath = !empty($area['image']) ? 'uploads/' . htmlspecialchars($area['image']) : $defaultAreaImage;
                  if (!file_exists($imgPath)) {
                      $imgPath = $defaultAreaImage;
                  }
                ?>
                        <img src="<?php echo $imgPath; ?>" alt="<?php echo htmlspecialchars($area['name']); ?>">
                        <div class="area-overlay">
                            <p><?php echo htmlspecialchars($area['name']); ?></p>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- Include Footer -->
    <?php include 'footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>