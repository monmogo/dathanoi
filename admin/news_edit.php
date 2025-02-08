<?php
session_start();

// Kiểm tra đăng nhập và vai trò admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../login.php');
    exit();
}

// Include file kết nối cơ sở dữ liệu (PDO)
require_once '../db.php';

// Kiểm tra xem có id tin tức được truyền qua URL hay không
if (!isset($_GET['id'])) {
    header("Location: news_list.php");
    exit();
}

$id = intval($_GET['id']);
$error = '';

// Lấy dữ liệu tin tức hiện có từ CSDL
$sql = "SELECT * FROM news WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->execute([':id' => $id]);
$news = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$news) {
    die("Tin tức không tồn tại.");
}

// Khởi tạo các biến để hiển thị dữ liệu hiện có
$title = $news['title'];
$content = $news['content'];
$currentImage = $news['image'];

// Xử lý khi form được submit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lấy dữ liệu từ form
    $title = isset($_POST['title']) ? trim($_POST['title']) : '';
    $content = isset($_POST['content']) ? trim($_POST['content']) : '';
    
    // Kiểm tra dữ liệu bắt buộc
    if (empty($title) || empty($content)) {
        $error = "Tiêu đề và Nội dung không được bỏ trống.";
    } else {
        $newImage = $currentImage; // Mặc định giữ ảnh cũ nếu không có upload mới

        // Xử lý upload hình ảnh nếu có file mới được chọn
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $targetDir = "../uploads/";
            // Tạo thư mục uploads nếu chưa tồn tại
            if (!is_dir($targetDir)) {
                mkdir($targetDir, 0777, true);
            }
            // Tạo tên file độc nhất dựa trên thời gian
            $newImageName = time() . '_' . basename($_FILES['image']['name']);
            $targetFile = $targetDir . $newImageName;
            if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
                // Nếu có ảnh cũ, xóa file ảnh cũ (nếu tồn tại)
                if (!empty($currentImage) && file_exists($targetDir . $currentImage)) {
                    unlink($targetDir . $currentImage);
                }
                $newImage = $newImageName;
            } else {
                $error = "Lỗi khi tải file hình ảnh mới.";
            }
        }
    }

    // Nếu không có lỗi, cập nhật tin tức vào CSDL
    if (empty($error)) {
        $sqlUpdate = "UPDATE news SET title = :title, content = :content, image = :image WHERE id = :id";
        try {
            $stmtUpdate = $pdo->prepare($sqlUpdate);
            $stmtUpdate->execute([
                ':title'   => $title,
                ':content' => $content,
                ':image'   => $newImage,
                ':id'      => $id
            ]);
            header("Location: news_list.php");
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
    <title>Sửa tin tức</title>
    <link rel="stylesheet" href="../componer/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-4">
        <h1>Sửa tin tức</h1>
        <?php if (!empty($error)): ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>
        <form action="" method="post" enctype="multipart/form-data">
            <!-- Tiêu đề tin tức -->
            <div class="mb-3">
                <label for="title" class="form-label">Tiêu đề</label>
                <input type="text" name="title" id="title" class="form-control" required
                    value="<?php echo htmlspecialchars($title); ?>">
            </div>
            <!-- Nội dung tin tức -->
            <div class="mb-3">
                <label for="content" class="form-label">Nội dung</label>
                <textarea name="content" id="content" rows="10" class="form-control"
                    required><?php echo htmlspecialchars($content); ?></textarea>
            </div>
            <!-- Upload hình ảnh (nếu muốn cập nhật) -->
            <div class="mb-3">
                <label for="image" class="form-label">Hình ảnh (chọn file mới để cập nhật)</label>
                <input type="file" name="image" id="image" class="form-control">
                <?php if (!empty($currentImage)): ?>
                <img src="../uploads/<?php echo $currentImage; ?>" alt="Hình ảnh tin tức"
                    style="max-width:200px; margin-top:10px;">
                <?php endif; ?>
            </div>
            <button type="submit" class="btn btn-primary">Cập nhật tin</button>
            <a href="news_list.php" class="btn btn-secondary">Quay lại</a>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>