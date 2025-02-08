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

try {
    // Lấy thông tin banner để xóa file ảnh nếu có
    $stmt = $pdo->prepare("SELECT image FROM banners WHERE id = :id");
    $stmt->execute([':id' => $id]);
    $banner = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($banner) {
        $image = $banner['image'];
        if (!empty($image) && file_exists("../" . $image)) {
            unlink("../" . $image);
        }
    }
    // Xóa bản ghi banner
    $stmt = $pdo->prepare("DELETE FROM banners WHERE id = :id");
    $stmt->execute([':id' => $id]);
    header("Location: banners_list.php");
    exit();
} catch (PDOException $e) {
    die("Lỗi truy vấn: " . $e->getMessage());
}
?>