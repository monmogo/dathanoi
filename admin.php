<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Quản trị</title>
</head>

<body>
    <h2>Chào mừng, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2>
    <p>Đây là trang quản trị.</p>
    <a href="logout.php">Đăng xuất</a>
</body>

</html>