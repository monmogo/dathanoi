<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../login.php');
    exit();
}
require_once '../db.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: users_list.php");
    exit();
}

$id = intval($_GET['id']);

try {
    $stmt = $pdo->prepare("DELETE FROM users WHERE id = :id");
    $stmt->execute([':id' => $id]);
    header("Location: users_list.php");
    exit();
} catch (PDOException $e) {
    die("Lỗi truy vấn: " . $e->getMessage());
}
?>