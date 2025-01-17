<?php
include 'config.php'; // Kết nối cơ sở dữ liệu
session_start();

// Kiểm tra quyền admin
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== true) {
    die(json_encode(["error" => "Bạn không có quyền truy cập."]));
}

// Xử lý các hành động CRUD
$action = $_POST['action'] ?? '';

switch ($action) {
    case 'create':
        $title = $_POST['title'];
        $size = $_POST['size'];
        $type = $_POST['type'];
        $status = $_POST['status'];
        $image = $_POST['image'];

        $stmt = $conn->prepare("INSERT INTO projects (title, size, type, status, image) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $title, $size, $type, $status, $image);

        if ($stmt->execute()) {
            echo json_encode(["success" => "Dự án đã được thêm."]);
        } else {
            echo json_encode(["error" => $stmt->error]);
        }
        break;

    case 'update':
        $id = $_POST['id'];
        $title = $_POST['title'];
        $size = $_POST['size'];
        $type = $_POST['type'];
        $status = $_POST['status'];
        $image = $_POST['image'];

        $stmt = $conn->prepare("UPDATE projects SET title = ?, size = ?, type = ?, status = ?, image = ? WHERE id = ?");
        $stmt->bind_param("sssssi", $title, $size, $type, $status, $image, $id);

        if ($stmt->execute()) {
            echo json_encode(["success" => "Dự án đã được cập nhật."]);
        } else {
            echo json_encode(["error" => $stmt->error]);
        }
        break;

    case 'delete':
        $id = $_POST['id'];

        $stmt = $conn->prepare("DELETE FROM projects WHERE id = ?");
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            echo json_encode(["success" => "Dự án đã được xóa."]);
        } else {
            echo json_encode(["error" => $stmt->error]);
        }
        break;

    case 'read':
    default:
        $result = $conn->query("SELECT * FROM projects ORDER BY id DESC");
        $projects = $result->fetch_all(MYSQLI_ASSOC);
        echo json_encode($projects);
        break;
}
?>