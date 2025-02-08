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
$error = '';

try {
    $stmt = $pdo->prepare("SELECT * FROM users WHERE id = :id");
    $stmt->execute([':id' => $id]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$user) {
        header("Location: users_list.php");
        exit();
    }
} catch (PDOException $e) {
    die("Lỗi truy vấn: " . $e->getMessage());
}

$username = $user['username'];
$email = $user['email'];
$role = $user['role'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = isset($_POST['username']) ? trim($_POST['username']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $role = isset($_POST['role']) ? trim($_POST['role']) : '';
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if (empty($username) || empty($email) || empty($role)) {
        $error = "Vui lòng điền đầy đủ thông tin.";
    } else {
        if (!empty($password) || !empty($confirm_password)) {
            if ($password !== $confirm_password) {
                $error = "Mật khẩu và xác nhận mật khẩu không khớp.";
            } else {
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            }
        }
    }
    if (empty($error)) {
        try {
            if (isset($hashedPassword)) {
                $stmt = $pdo->prepare("UPDATE users SET username = :username, email = :email, role = :role, password = :password WHERE id = :id");
                $stmt->execute([
                    ':username' => $username,
                    ':email' => $email,
                    ':role' => $role,
                    ':password' => $hashedPassword,
                    ':id' => $id
                ]);
            } else {
                $stmt = $pdo->prepare("UPDATE users SET username = :username, email = :email, role = :role WHERE id = :id");
                $stmt->execute([
                    ':username' => $username,
                    ':email' => $email,
                    ':role' => $role,
                    ':id' => $id
                ]);
            }
            header("Location: users_list.php");
            exit();
        } catch (PDOException $e) {
            $error = "Lỗi truy vấn: " . $e->getMessage();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa Người dùng</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-4">
        <h1>Sửa Người dùng</h1>
        <?php if (!empty($error)): ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>
        <form action="" method="post">
            <div class="mb-3">
                <label for="username" class="form-label">Tên người dùng</label>
                <input type="text" name="username" id="username" class="form-control" required
                    value="<?php echo htmlspecialchars($username); ?>">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" id="email" class="form-control" required
                    value="<?php echo htmlspecialchars($email); ?>">
            </div>
            <div class="mb-3">
                <label for="role" class="form-label">Vai trò</label>
                <select name="role" id="role" class="form-select" required>
                    <option value="user" <?php echo ($role === 'user') ? 'selected' : ''; ?>>User</option>
                    <option value="admin" <?php echo ($role === 'admin') ? 'selected' : ''; ?>>Admin</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Mật khẩu (để trống nếu không thay đổi)</label>
                <input type="password" name="password" id="password" class="form-control">
            </div>
            <div class="mb-3">
                <label for="confirm_password" class="form-label">Xác nhận mật khẩu</label>
                <input type="password" name="confirm_password" id="confirm_password" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Cập nhật</button>
            <a href="users_list.php" class="btn btn-secondary">Quay lại</a>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>