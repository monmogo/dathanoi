<?php
include 'config.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $link = $_POST['link'];
    $image = 'uploads/' . basename($_FILES['image']['name']);

    if (move_uploaded_file($_FILES['image']['tmp_name'], $image)) {
        $stmt = $conn->prepare("INSERT INTO banners (title, image, link) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $title, $image, $link);
        $stmt->execute();
        header("Location: manage_banners.php");
        exit();
    } else {
        $error = "Lỗi khi tải lên hình ảnh!";
    }
}
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Thêm banner</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-4">
        <h2>Thêm Banner</h2>
        <?php if (isset($error)): ?>
        <p class="text-danger"><?= $error ?></p>
        <?php endif; ?>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="title" class="form-label">Tiêu đề</label>
                <input type="text" name="title" id="title" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Hình ảnh</label>
                <input type="file" name="image" id="image" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="link" class="form-label">Đường dẫn (tuỳ chọn)</label>
                <input type="url" name="link" id="link" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Thêm</button>
        </form>
    </div>
</body>

</html>