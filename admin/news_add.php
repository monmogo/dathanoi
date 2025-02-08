<?php
session_start();

// Kiểm tra đăng nhập và vai trò admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../login.php');
    exit();
}

require_once '../db.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lấy dữ liệu từ form
    $title   = isset($_POST['title']) ? trim($_POST['title']) : '';
    $content = isset($_POST['content']) ? trim($_POST['content']) : '';
    $image   = '';

    // Kiểm tra dữ liệu bắt buộc
    if (empty($title) || empty($content)) {
        $error = "Tiêu đề và Nội dung không được bỏ trống.";
    } else {
        // Xử lý upload hình ảnh nếu có
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $targetDir = "../uploads/";
            // Nếu thư mục uploads chưa tồn tại, tạo mới
            if (!is_dir($targetDir)) {
                mkdir($targetDir, 0777, true);
            }
            // Tạo tên file độc nhất
            $image = time() . '_' . basename($_FILES['image']['name']);
            $targetFile = $targetDir . $image;
            if (!move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
                $error = "Lỗi khi tải file hình ảnh.";
            }
        }
    }

    // Nếu không có lỗi, thực hiện lưu tin tức vào CSDL
    if (empty($error)) {
        $sql = "INSERT INTO news (title, content, image, created_at) VALUES (:title, :content, :image, NOW())";
        try {
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':title', $title);
            $stmt->bindParam(':content', $content);
            $stmt->bindParam(':image', $image);
            if ($stmt->execute()) {
                header("Location: news_list.php");
                exit();
            } else {
                $error = "Không thể thêm tin tức.";
            }
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
    <title>Thêm tin tức</title>
    <link rel="stylesheet" href="../componer/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-4">
        <h1>Thêm tin tức mới</h1>
        <?php if (!empty($error)): ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="title" class="form-label">Tiêu đề</label>
                <input type="text" name="title" id="title" class="form-control" required
                    value="<?php echo isset($title) ? htmlspecialchars($title) : ''; ?>">
            </div>
            <div class="mb-3">
                <label for="content" class="form-label">Nội dung</label>
                <textarea name="content" id="content" rows="10" class="form-control"
                    required><?php echo isset($content) ? htmlspecialchars($content) : ''; ?></textarea>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Hình ảnh (tùy chọn)</label>
                <input type="file" name="image" id="image" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Thêm tin</button>
            <a href="news_list.php" class="btn btn-secondary">Quay lại</a>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>