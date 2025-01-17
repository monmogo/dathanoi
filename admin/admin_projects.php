<?php
include 'api/config.php';
session_start();

// Kiểm tra đăng nhập
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php"); // Chuyển hướng về trang đăng nhập nếu chưa đăng nhập
    exit();
}

// Lấy thông tin người dùng từ database
$stmt = $conn->prepare("SELECT role FROM admins WHERE id = ?");
$stmt->bind_param("i", $_SESSION['user_id']);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if (!$user || $user['role'] !== 'admin') {
    die("Bạn không có quyền truy cập vào trang này.");
}

// Lấy danh sách dự án
$query = "SELECT * FROM projects ORDER BY id DESC";
$result = $conn->query($query);
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý Dự án</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Quản lý Dự án</h2>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#projectModal">Thêm Dự án</button>
        </div>

        <!-- Bảng quản lý dự án -->
        <table class="table table-striped">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Tiêu đề</th>
                    <th>Diện tích</th>
                    <th>Loại hình</th>
                    <th>Trạng thái</th>
                    <th>Hình ảnh</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= $row['id'] ?></td>
                        <td><?= htmlspecialchars($row['title']) ?></td>
                        <td><?= htmlspecialchars($row['size']) ?></td>
                        <td><?= htmlspecialchars($row['type']) ?></td>
                        <td><?= htmlspecialchars($row['status']) ?></td>
                        <td><img src="<?= htmlspecialchars($row['image']) ?>" alt="" style="width: 100px;"></td>
                        <td>
                            <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#projectModal"
                                data-id="<?= $row['id'] ?>" data-title="<?= htmlspecialchars($row['title']) ?>"
                                data-size="<?= htmlspecialchars($row['size']) ?>"
                                data-type="<?= htmlspecialchars($row['type']) ?>"
                                data-status="<?= htmlspecialchars($row['status']) ?>"
                                data-image="<?= htmlspecialchars($row['image']) ?>">
                                Sửa
                            </button>
                            <button class="btn btn-danger btn-sm" onclick="deleteProject(<?= $row['id'] ?>)">Xóa</button>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <!-- Modal Thêm/Sửa Dự án -->
    <div class="modal fade" id="projectModal" tabindex="-1" aria-labelledby="projectModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="projectForm">
                    <div class="modal-header">
                        <h5 class="modal-title" id="projectModalLabel">Quản lý Dự án</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="project-id" name="id">
                        <div class="mb-3">
                            <label for="project-title" class="form-label">Tiêu đề</label>
                            <input type="text" class="form-control" id="project-title" name="title" required>
                        </div>
                        <div class="mb-3">
                            <label for="project-size" class="form-label">Diện tích</label>
                            <input type="text" class="form-control" id="project-size" name="size" required>
                        </div>
                        <div class="mb-3">
                            <label for="project-type" class="form-label">Loại hình</label>
                            <input type="text" class="form-control" id="project-type" name="type" required>
                        </div>
                        <div class="mb-3">
                            <label for="project-status" class="form-label">Trạng thái</label>
                            <input type="text" class="form-control" id="project-status" name="status" required>
                        </div>
                        <div class="mb-3">
                            <label for="project-image" class="form-label">Hình ảnh (URL)</label>
                            <input type="text" class="form-control" id="project-image" name="image" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                        <button type="button" class="btn btn-primary" id="saveProject">Lưu</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const projectModal = document.getElementById("projectModal");
            const projectForm = document.getElementById("projectForm");
            const saveProjectBtn = document.getElementById("saveProject");

            projectModal.addEventListener("show.bs.modal", function (event) {
                const button = event.relatedTarget;
                const id = button.getAttribute("data-id");
                const title = button.getAttribute("data-title");
                const size = button.getAttribute("data-size");
                const type = button.getAttribute("data-type");
                const status = button.getAttribute("data-status");
                const image = button.getAttribute("data-image");

                projectForm.reset();
                if (id) {
                    projectForm.id.value = id;
                    projectForm.title.value = title;
                    projectForm.size.value = size;
                    projectForm.type.value = type;
                    projectForm.status.value = status;
                    projectForm.image.value = image;
                }
            });

            saveProjectBtn.addEventListener("click", function () {
                const formData = new FormData(projectForm);
                formData.append("action", projectForm.id.value ? "update" : "create");

                fetch("api/manage_projects.php", {
                    method: "POST",
                    body: formData
                })
                    .then(response => response.json())
                    .then(data => {
                        alert(data.success || data.error);
                        if (data.success) location.reload();
                    })
                    .catch(error => console.error("Error:", error));
            });
        });

        function deleteProject(id) {
            if (confirm("Bạn có chắc chắn muốn xóa dự án này?")) {
                fetch("api/manage_projects.php", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/x-www-form-urlencoded"
                    },
                    body: `action=delete&id=${id}`
                })
                    .then(response => response.json())
                    .then(data => {
                        alert(data.success || data.error);
                        if (data.success) location.reload();
                    })
                    .catch(error => console.error("Error:", error));
            }
        }
    </script>
</body>

</html>