<?php
$host = 'localhost';      // Thay bằng hostname của bạn
$dbname = 'dathanoi';      // Thay bằng tên cơ sở dữ liệu của bạn
$username = 'root';        // Thay bằng username của bạn
$password = '';            // Thay bằng mật khẩu của bạn

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Kết nối cơ sở dữ liệu thất bại: " . $e->getMessage());
}
?>