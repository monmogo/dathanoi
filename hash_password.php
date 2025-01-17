<?php
$password = "123456";
$hashed_password = password_hash($password, PASSWORD_BCRYPT);
echo "Mật khẩu đã băm: " . $hashed_password;
?>