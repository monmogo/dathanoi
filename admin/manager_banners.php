<?php
include 'api/config.php';

// Thêm banner
if (isset($_POST['add'])) {
    $title = htmlspecialchars($_POST['title']);
    $link = htmlspecialchars($_POST['link']);
    $image = 'uploads/' . basename($_FILES['image']['name']);

    // Kiểm tra upload file
    if ($_FILES['image']['error'] !== UPLOAD_ERR_OK) {
        die("Lỗi upload file: " . $_FILES['image']['error']);
    }

    // Kiểm tra định dạng file
    $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
    if (!in_array($_FILES['image']['type'], $allowed_types)) {
        die("Chỉ được phép upload file ảnh (PNG, JPG, GIF).");
    }

    // Upload file
    if (move_uploaded_file($_FILES['image']['tmp_name'], $image)) {
        $stmt = $conn->prepare("INSERT INTO banners (title, image, link) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $title, $image, $link);

        if (!$stmt->execute()) {
            die("Lỗi thêm banner: " . $stmt->error);
        }
    } else {
        die("Không thể di chuyển file upload. Vui lòng kiểm tra quyền thư mục.");
    }
}

// Sửa banner
if (isset($_POST['edit'])) {
    $id = $_POST['id'];
    $title = htmlspecialchars($_POST['title']);
    $link = htmlspecialchars($_POST['link']);
    $image = htmlspecialchars($_POST['existing_image']); // Giữ ảnh cũ nếu không upload ảnh mới

    if (!empty($_FILES['image']['name'])) {
        $image = 'uploads/' . basename($_FILES['image']['name']);

        // Kiểm tra upload file
        if ($_FILES['image']['error'] !== UPLOAD_ERR_OK) {
            die("Lỗi upload file: " . $_FILES['image']['error']);
        }

        // Kiểm tra định dạng file
        if (!in_array($_FILES['image']['type'], $allowed_types)) {
            die("Chỉ được phép upload file ảnh (PNG, JPG, GIF).");
        }

        // Upload file mới
        if (!move_uploaded_file($_FILES['image']['tmp_name'], $image)) {
            die("Không thể di chuyển file upload.");
        }
    }

    $stmt = $conn->prepare("UPDATE banners SET title = ?, image = ?, link = ? WHERE id = ?");
    $stmt->bind_param("sssi", $title, $image, $link, $id);

    if (!$stmt->execute()) {
        die("Lỗi sửa banner: " . $stmt->error);
    }
}

// Xóa banner
if (isset($_GET['delete_id'])) {
    $id = $_GET['delete_id'];

    $stmt = $conn->prepare("DELETE FROM banners WHERE id = ?");
    $stmt->bind_param("i", $id);

    if (!$stmt->execute()) {
        die("Lỗi xóa banner: " . $stmt->error);
    }

    header("Location: manager_banners.php");
    exit();
}

// Lấy danh sách banner
$result = $conn->query("SELECT * FROM banners ORDER BY created_at DESC");
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý banner</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/banner.css">

</head>

<body>
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Quản lý banner</h2>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">Thêm Banner</button>
        </div>

        <!-- Bảng Banner -->
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Tiêu đề</th>
                    <th>Hình ảnh</th>
                    <th>Đường dẫn</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= $row['id'] ?></td>
                        <td><?= htmlspecialchars($row['title']) ?></td>
                        <td>
                            <img src="<?= $row['image'] ?>" alt="<?= htmlspecialchars($row['title']) ?>"
                                style="width: 100px;">
                        </td>
                        <td>
                            <a href="<?= htmlspecialchars($row['link']) ?>" target="_blank" class="text-decoration-none">
                                <?= htmlspecialchars($row['link']) ?>
                            </a>
                        </td>
                        <td>
                            <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal"
                                data-id="<?= $row['id'] ?>" data-title="<?= htmlspecialchars($row['title']) ?>"
                                data-link="<?= htmlspecialchars($row['link']) ?>" data-image="<?= $row['image'] ?>">
                                Sửa
                            </button>
                            <a href="manager_banners.php?delete_id=<?= $row['id'] ?>" class="btn btn-danger btn-sm"
                                onclick="return confirm('Bạn có chắc chắn muốn xóa banner này?')">Xóa</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <!-- Modal Thêm Banner -->
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addModalLabel">Thêm Banner</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
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
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="add" class="btn btn-success">Thêm</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Sửa Banner -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Sửa Banner</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" id="edit-id">
                        <input type="hidden" name="existing_image" id="edit-existing-image">
                        <div class="mb-3">
                            <label for="edit-title" class="form-label">Tiêu đề</label>
                            <input type="text" name="title" id="edit-title" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit-image" class="form-label">Hình ảnh</label>
                            <input type="file" name="image" id="edit-image" class="form-control">
                            <img id="preview-image" src="" alt="" style="width: 100px; margin-top: 10px;">
                        </div>
                        <div class="mb-3">
                            <label for="edit-link" class="form-label">Đường dẫn (tuỳ chọn)</label>
                            <input type="url" name="link" id="edit-link" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="edit" class="btn btn-success">Cập nhật</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const editModal = document.getElementById('editModal');
        editModal.addEventListener('show.bs.modal', event => {
            const button = event.relatedTarget;
            const id = button.getAttribute('data-id');
            const title = button.getAttribute('data-title');
            const link = button.getAttribute('data-link');
            const image = button.getAttribute('data-image');
            document.getElementById('edit-id').value = id;
            document.getElementById('edit-title').value = title;
            document.getElementById('edit-link').value = link;
            document.getElementById('edit-existing-image').value = image;
            document.getElementById('preview-image').src = image;
        });
    </script>
</body>

</html>