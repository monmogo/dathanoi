<?php
session_start();
if (!isset($_SESSION["admin"])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <?php include 'sidebar.php'; ?>
    <h2>Chào mừng, <?php echo $_SESSION["admin"]; ?>!</h2>
    <p>Chúc mừng bạn đã đăng nhập thành công.</p>
    <a href="logout.php">Đăng xuất</a>

</body>

</html>