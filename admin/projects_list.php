<?php
session_start();
// Kiểm tra đăng nhập và vai trò admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit();
}

require_once '../db.php';

try {
    // Lấy tất cả dự án, sắp xếp theo ngày tạo giảm dần
    $stmt = $pdo->query("SELECT id, title, size, type, status, image, created_at FROM projects ORDER BY created_at DESC");
    $projects = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Lỗi truy vấn: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý Dự án</title>
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

    .card {
        border: none;
        border-radius: 10px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
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
                        <h1 class="mb-0">Quản lý Dự án</h1>
                        <a href="project_add.php" class="btn btn-success">
                            <i class="fas fa-plus"></i> Thêm Dự án mới
                        </a>
                    </div>
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover align-middle">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>ID</th>
                                            <th>Tiêu đề</th>
                                            <th>Diện tích</th>
                                            <th>Loại hình</th>
                                            <th>Tình trạng</th>
                                            <th>Hình ảnh</th>
                                            <th>Ngày tạo</th>
                                            <th>Hành động</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (empty($projects)): ?>
                                        <tr>
                                            <td colspan="8" class="text-center">Không có dự án nào.</td>
                                        </tr>
                                        <?php else: ?>
                                        <?php foreach ($projects as $project): ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($project['id']); ?></td>
                                            <td><?php echo htmlspecialchars($project['title']); ?></td>
                                            <td><?php echo htmlspecialchars($project['size']); ?></td>
                                            <td><?php echo htmlspecialchars($project['type']); ?></td>
                                            <td><?php echo htmlspecialchars($project['status']); ?></td>
                                            <td>
                                                <?php if (!empty($project['image'])): ?>
                                                <img src="<?php echo '../' . htmlspecialchars($project['image']); ?>"
                                                    alt="<?php echo htmlspecialchars($project['title']); ?>"
                                                    style="max-width:100px;">
                                                <?php endif; ?>
                                            </td>
                                            <td><?php echo date("d/m/Y", strtotime($project['created_at'])); ?></td>
                                            <td>
                                                <a href="project_edit.php?id=<?php echo $project['id']; ?>"
                                                    class="btn btn-warning btn-sm">
                                                    <i class="fas fa-edit"></i> Sửa
                                                </a>
                                                <a href="project_delete.php?id=<?php echo $project['id']; ?>"
                                                    class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Bạn có chắc muốn xóa dự án này không?');">
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