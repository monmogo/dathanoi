<?php
session_start();
// Kiểm tra đăng nhập và vai trò admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit();
}

require_once '../db.php';

try {
    // Lấy tất cả khu vực, sắp xếp theo id tăng dần
    $stmt = $pdo->query("SELECT * FROM areas ORDER BY id ASC");
    $areas = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Lỗi truy vấn: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý Thông tin Khu vực</title>
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

    .table-responsive {
        margin-top: 20px;
    }

    /* Tùy chỉnh cho bảng */
    table th,
    table td {
        vertical-align: middle;
    }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Include Sidebar -->
            <?php include 'sidebar.php'; ?>

            <!-- Nội dung chính -->
            <main class="col-md-10">
                <div class="container mt-4">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h1 class="mb-0">Quản lý Thông tin Khu vực</h1>
                        <a href="area_add.php" class="btn btn-success">
                            <i class="fas fa-plus"></i> Thêm khu vực mới
                        </a>
                    </div>
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover align-middle">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>ID</th>
                                            <th>Tên khu vực</th>
                                            <th>Hình ảnh</th>
                                            <th>Ngày tạo</th>
                                            <th>Hành động</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (empty($areas)): ?>
                                        <tr>
                                            <td colspan="5" class="text-center">Không có khu vực nào.</td>
                                        </tr>
                                        <?php else: ?>
                                        <?php foreach ($areas as $area): ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($area['id']); ?></td>
                                            <td><?php echo htmlspecialchars($area['name']); ?></td>
                                            <td>
                                                <?php if (!empty($area['image'])): ?>
                                                <img src="<?php echo '../' . htmlspecialchars($area['image']); ?>"
                                                    alt="<?php echo htmlspecialchars($area['name']); ?>"
                                                    style="max-width:100px;">
                                                <?php endif; ?>
                                            </td>
                                            <td><?php echo date("d/m/Y", strtotime($area['created_at'])); ?></td>
                                            <td>
                                                <a href="area_edit.php?id=<?php echo $area['id']; ?>"
                                                    class="btn btn-warning btn-sm">
                                                    <i class="fas fa-edit"></i> Sửa
                                                </a>
                                                <a href="area_delete.php?id=<?php echo $area['id']; ?>"
                                                    class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Bạn có chắc muốn xóa khu vực này không?');">
                                                    <i class="fas fa-trash-alt"></i> Xóa
                                                </a>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
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