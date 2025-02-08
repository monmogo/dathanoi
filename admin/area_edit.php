<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit();
}
require_once '../db.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: areas_list.php");
    exit();
}

$id = intval($_GET['id']);
$error = '';

try {
    $stmt = $pdo->prepare("SELECT * FROM areas WHERE id = :id");
    $stmt->execute([':id' => $id]);
    $area = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$area) {
        header("Location: areas_list.php");
        exit();
    }
} catch (PDOException $e) {
    die("Lỗi truy vấn: " . $e->getMessage());
}

$name = $area['name'];
$currentImage = $area['image'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = isset($_POST['name']) ? trim($_POST['name']) : '';
    if (empty($name)) {
        $error = "Tên khu vực không được để trống.";
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
                // Nếu có ảnh cũ, xóa file ảnh cũ
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
            $stmt = $pdo->prepare("UPDATE areas SET name = :name, image = :image WHERE id = :id");
            $stmt->execute([
                ':name' => $name,
                ':image' => $newImagePath,
                ':id' => $id
            ]);
            header("Location: areas_list.php");
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
    <title>Sửa khu vực</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-4">
        <h1>Sửa khu vực</h1>
        <?php if (!empty($error)): ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="name" class="form-label">Tên khu vực</label>
                <input type="text" name="name" id="name" class="form-control" required
                    value="<?php echo htmlspecialchars($name); ?>">
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Hình ảnh (chọn file mới để cập nhật)</label>
                <input type="file" name="image" id="image" class="form-control">
                <?php if (!empty($currentImage)): ?>
                <img src="<?php echo '../' . htmlspecialchars($currentImage); ?>"
                    alt="<?php echo htmlspecialchars($name); ?>" style="max-width:200px; margin-top:10px;">
                <?php endif; ?>
            </div>
            <button type="submit" class="btn btn-primary">Cập nhật</button>
            <a href="areas_list.php" class="btn btn-secondary">Quay lại</a>
            </