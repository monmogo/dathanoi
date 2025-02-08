<?php
session_start();

// Kiểm tra đăng nhập và vai trò admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../login.php');
    exit();
}

require_once '../db.php';

try {
    // Lấy tất cả người dùng, sắp xếp theo ngày tạo giảm dần
    $stmt = $pdo->query("SELECT id, username, email, role, created_at FROM users ORDER BY created_at DESC");
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Lỗi truy vấn: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý Người dùng</title>
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

    /* Các tùy chỉnh cho sidebar nếu cần (đã có trong sidebar.php) */
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar: Include file sidebar.php -->
            <?php include 'sidebar.php'; ?>

            <!-- Nội dung chính -->
            <main class="col-md-10">
                <div class="container mt-4">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h1 class="mb-0">Quản lý Người dùng</h1>
                        <a href="user_add.php" class="btn btn-success">
                            <i class="fas fa-plus"></i> Thêm Người dùng mới
                        </a>
                    </div>
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover align-middle">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>ID</th>
                                            <th>Tên người dùng</th>
                                            <th>Email</th>
                                            <th>Vai trò</th>
                                            <th>Ngày tạo</th>
                                            <th>Hành động</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (empty($users)): ?>
                                        <tr>
                                            <td colspan="6" class="text-center">Không có người dùng nào.</td>
                                        </tr>
                                        <?php else: ?>
                                        <?php foreach ($users as $user): ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($user['id']); ?></td>
                                            <td><?php echo htmlspecialchars($user['username']); ?></td>
                                            <td><?php echo htmlspecialchars($user['email']); ?></td>
                                            <td><?php echo htmlspecialchars($user['role']); ?></td>
                                            <td><?php echo date("d/m/Y", strtotime($user['created_at'])); ?></td>
                                            <td>
                                                <a href="user_edit.php?id=<?php echo $user['id']; ?>"
                                                    class="btn btn-warning btn-sm">
                                                    <i class="fas fa-edit"></i> Sửa
                                                </a>
                                                <a href="user_delete.php?id=<?php echo $user['id']; ?>"
                                                    class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Bạn có chắc muốn xóa người dùng này không?');">
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
    <!-- Nhúng Bootstrap Bundle JS (bao gồm Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>