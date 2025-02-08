<?php
session_start();
// Kiểm tra đăng nhập và vai trò admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit();
}

require_once '../db.php';

try {
    // Lấy tất cả tin tức, sắp xếp theo ngày tạo giảm dần
    $query = "SELECT * FROM news ORDER BY created_at DESC";
    $stmt = $pdo->query($query);
    $news = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Lỗi truy vấn: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý Tin tức</title>
    <!-- Nhúng Bootstrap CSS từ CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <!-- Nhúng Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <!-- CSS tùy chỉnh -->
    <link rel="stylesheet" href="../componer/css/style.css">
    <style>
    body {
        background-color: #f4f6f9;
        font-family: 'Roboto', sans-serif;
    }

    .main-content {
        padding: 20px;
    }

    .table-responsive {
        margin-top: 20px;
    }

    /* Tùy chỉnh ảnh trong bảng */
    .news-img {
        max-width: 100px;
        border-radius: 4px;
    }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Include Sidebar -->
            <?php include 'sidebar.php'; ?>

            <!-- Nội dung chính -->
            <main class="col-md-10 main-content">
                <div class="container mt-4">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h1 class="mb-0">Quản lý Tin tức</h1>
                        <a href="news_add.php" class="btn btn-success">
                            <i class="fas fa-plus"></i> Thêm tin tức mới
                        </a>
                    </div>
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <div class="table-responsive">
                                <?php if (empty($news)): ?>
                                <p class="text-center">Không có tin tức nào.</p>
                                <?php else: ?>
                                <table class="table table-bordered table-striped align-middle">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>ID</th>
                                            <th>Tiêu đề</th>
                                            <th>Hình ảnh</th>
                                            <th>Ngày tạo</th>
                                            <th>Hành động</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($news as $row): ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($row['id']); ?></td>
                                            <td><?php echo htmlspecialchars($row['title']); ?></td>
                                            <td>
                                                <?php if (!empty($row['image'])): ?>
                                                <img src="<?php echo '../uploads/' . htmlspecialchars($row['image']); ?>"
                                                    alt="<?php echo htmlspecialchars($row['title']); ?>"
                                                    class="news-img">
                                                <?php endif; ?>
                                            </td>
                                            <td><?php echo date("d/m/Y", strtotime($row['created_at'])); ?></td>
                                            <td>
                                                <a href="news_edit.php?id=<?php echo $row['id']; ?>"
                                                    class="btn btn-warning btn-sm">
                                                    <i class="fas fa-edit"></i> Sửa
                                                </a>
                                                <a href="news_delete.php?id=<?php echo $row['id']; ?>"
                                                    class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Bạn có chắc muốn xóa tin này không?');">
                                                    <i class="fas fa-trash-alt"></i> Xóa
                                                </a>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>