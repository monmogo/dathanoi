<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../login.php');
    exit();
}
require_once '../db.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: banners_list.php");
    exit();
}

$id = intval($_GET['id']);
$error = '';

try {
    $stmt = $pdo->prepare("SELECT * FROM banners WHERE id = :id");
    $stmt->execute([':id' => $id]);
    $banner = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$banner) {
        header("Location: banners_list.php");
        exit();
    }
} catch (PDOException $e) {
    die("Lỗi truy vấn: " . $e->getMessage());
}

$title = $banner['title'];
$link = $banner['link'];
$currentImage = $banner['image'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title']);
    $link = trim($_POST['link']);
    
    if (empty($title)) {
        $error = "Vui lòng nhập tiêu đề banner.";
    } else {
        $newImagePath = $currentImage;
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $targetDir = "../uploads/";
            if (!is_dir($targetDir)) {
                mkdir($targetDir, 0777, true);
            }
            $filename = time() . '_' . basename($_FILES['image']['name']);
            $targetFile = $targetDir . $filename;
            if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
                // Xóa ảnh cũ nếu có
                if (!empty($currentImage) && file_exists("../" . $currentImage)) {
                    unlink("../" . $currentImage);
                }
                $newImagePath = "uploads/" . $filename;
            } else {
                $error = "Lỗi khi tải file hình ảnh mới.";
            }
        }
    }
    
    if (empty($error)) {
        try {
            $stmt = $pdo->prepare("UPDATE banners SET title = :title, link = :link, image = :image WHERE id = :id");
            $stmt->execute([
                ':title' => $title,
                ':link'  => $link,
                ':image' => $newImagePath,
                ':id'    => $id
            ]);
            header("Location: banners_list.php");
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
    <title>Sửa Banner</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-4">
        <h1>Sửa Banner</h1>
        <?php if (!empty($error)): ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="title" class="form-label">Tiêu đề</label>
                <input type="text" name="title" id="title" class="form-control" required
                    value="<?php echo htmlspecialchars($title); ?>">
            </div>
            <div class="mb-3">
                <label for="link" class="form-label">Link (URL)</label>
                <input type="url" name="link" id="link" class="form-control"
                    value="<?php echo htmlspecialchars($link); ?>">
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Hình ảnh (chọn file mới để cập nhật)</label>
                <input type="file" name="image" id="image" class="form-control">
                <?php if (!empty($currentImage)): ?>
                <img src="<?php echo '../' . htmlspecialchars($currentImage); ?>"
                    alt="<?php echo htmlspecialchars($title); ?>" style="max-width:200px; margin-top:10px;">
                <?php endif; ?>
            </div>
            <button type="submit" class="btn btn-primary">Cập nhật</button>
            <a href="banners_list.php" class="btn btn-secondary">Quay lại</a>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>