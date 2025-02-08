<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../login.php');
    exit();
}
require_once '../db.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: projects_list.php");
    exit();
}

$id = intval($_GET['id']);

try {
    // Lấy thông tin dự án để xóa file ảnh (nếu có)
    $stmt = $pdo->prepare("SELECT image FROM projects WHERE id = :id");
    $stmt->execute([':id' => $id]);
    $project = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($project) {
        $image = $project['image'];
        if (!empty($image) && file_exists("../" . $image)) {
            unlink("../" . $image);
        }
    }

    // Xóa bản ghi dự án
    $stmt = $pdo->prepare("DELETE FROM projects WHERE id = :id");
    $stmt->execute([':id' => $id]);
    header("Location: projects_list.php");
    exit();
} catch (PDOException $e) {
    die("Lỗi truy vấn: " . $e->getMessage());
}
?>