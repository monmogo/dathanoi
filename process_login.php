<?php
session_start();
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Truy vấn kiểm tra tài khoản
    $stmt = $conn->prepare("SELECT id, password FROM admins WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($id, $hashed_password);
    $stmt->fetch();

    if ($stmt->num_rows > 0 && password_verify($password, $hashed_password)) {
        $_SESSION["admin"] = $username;
        header("Location: admin/admin_dashboard.php");
        exit();
    } else {
        $_SESSION["error"] = "Sai tài khoản hoặc mật khẩu!";
        header("Location: login.php");
        exit();
    }
}
?>