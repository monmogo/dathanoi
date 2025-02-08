<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit();
}
require_once '../db.php';

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title']);
    $size = trim($_POST['size']);
    $type = trim($_POST['type']);
    $status = trim($_POST['status']);
    $description = isset($_POST['description']) ? trim($_POST['description']) : '';
    
    if (empty($title) || empty($size) || empty($type) || empty($status)) {
        $error = "Vui lòng điền đầy đủ các thông tin bắt buộc.";
    } else {
        // Xử lý upload hình ảnh
        $imagePath = '';
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $targetDir = "../uploads/";
            if (!is_dir($targetDir)) {
                mkdir($targetDir, 0777, true);
            }
            $filename = time() . '_' . basename($_FILES['image']['name']);
            $targetFile = $targetDir . $filename;
            if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
                // Lưu đường dẫn tương đối từ gốc dự án
                $imagePath = "uploads/" . $filename;
            } else {
                $error = "Lỗi khi tải file hình ảnh.";
            }
        }
    }
    
    if (empty($error)) {
        try {
            $stmt = $pdo->prepare("INSERT INTO projects (title, size, type, status, description, image) VALUES (:title, :size, :type, :status, :description, :image)");
            $stmt->execute([
                ':title' => $title,
                ':size' => $size,
                ':type' => $type,
                ':status' => $status,
                ':description' => $description,
                ':image' => $imagePath
            ]);
            header("Location: projects_list.php");
            exit();
        } catch (PDOException $e) {
            $error = "Lỗi truy vấn: " . $e->getMessage();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Dự án mới</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-4">
        <h1>Thêm Dự án mới</h1>
        <?php if (!empty($error)): ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="title" class="form-label">Tiêu đề</label>
                <input type="text" name="title" id="title" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="size" class="form-label">Diện tích</label>
                <input type="text" name="size" id="size" class="form-control" required placeholder="vd: 9,120 m²">
            </div>
            <div class="mb-3">
                <label for="type" class="form-label">Loại hình</label>
                <input type="text" name="type" id="type" class="form-control" required
                    placeholder="vd: Liền kề, Biệt thự,...">
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Tình trạng</label>
                <input type="text" name="status" id="status" class="form-control" required
                    placeholder="vd: Đã bàn giao, Sắp bàn giao,...">
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Mô tả dự án (tùy chọn)</label>
                <textarea name="description" id="description" rows="5" class="form-control"></textarea>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Hình ảnh</label>
                <input type="file" name="image" id="image" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Thêm</button>
            <a href="projects_list.php" class="btn btn-secondary">Quay lại</a>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>