<?php
session_start();

// Kiểm tra đăng nhập và vai trò admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit();
}

require_once '../db.php';

$error = '';
$success = '';

// Xử lý form nếu có submit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lấy dữ liệu từ form và loại bỏ khoảng trắng
    $site_title        = trim($_POST['site_title']);
    $site_description  = trim($_POST['site_description']);
    $contact_email     = trim($_POST['contact_email']);
    $social_facebook   = trim($_POST['social_facebook']);
    $social_twitter    = trim($_POST['social_twitter']);

    // Bạn có thể thêm validation ở đây (ví dụ: kiểm tra email hợp lệ)

    if (empty($site_title) || empty($site_description) || empty($contact_email)) {
        $error = "Vui lòng điền đầy đủ các trường bắt buộc.";
    } else {
        try {
            $stmt = $pdo->prepare("UPDATE settings 
                                   SET site_title = :site_title, 
                                       site_description = :site_description, 
                                       contact_email = :contact_email, 
                                       social_facebook = :social_facebook, 
                                       social_twitter = :social_twitter 
                                   WHERE id = 1");
            $stmt->execute([
                ':site_title'       => $site_title,
                ':site_description' => $site_description,
                ':contact_email'    => $contact_email,
                ':social_facebook'  => $social_facebook,
                ':social_twitter'   => $social_twitter
            ]);
            $success = "Cài đặt đã được cập nhật thành công.";
        } catch (PDOException $e) {
            $error = "Lỗi truy vấn: " . $e->getMessage();
        }
    }
}

// Lấy dữ liệu cài đặt hiện tại từ bảng settings
try {
    $stmt = $pdo->query("SELECT * FROM settings WHERE id = 1");
    $settings = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$settings) {
        // Nếu không tìm thấy, khởi tạo giá trị mặc định
        $settings = [
            'site_title'       => '',
            'site_description' => '',
            'contact_email'    => '',
            'social_facebook'  => '',
            'social_twitter'   => ''
        ];
    }
} catch (PDOException $e) {
    die("Lỗi truy vấn: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cài đặt Website</title>
    <!-- Nhúng Bootstrap CSS từ CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <!-- Nhúng Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <!-- CSS tùy chỉnh -->
    <link rel="stylesheet" href="../componer/css/style.css">
    <style>
    body {
        background-color: #f4f6f9;
        font-family: 'Roboto', sans-serif;
    }

    .main-content {
        padding: 20px;
    }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Include Sidebar -->
            <?php include 'sidebar.php'; ?>

            <!-- Nội dung chính -->
            <main class="col-md-10 main-content">
                <div class="container mt-4">
                    <h1>Cài đặt Website</h1>
                    <?php if (!empty($success)): ?>
                    <div class="alert alert-success"><?php echo $success; ?></div>
                    <?php endif; ?>
                    <?php if (!empty($error)): ?>
                    <div class="alert alert-danger"><?php echo $error; ?></div>
                    <?php endif; ?>
                    <form action="" method="post">
                        <div class="mb-3">
                            <label for="site_title" class="form-label">Tiêu đề Website</label>
                            <input type="text" name="site_title" id="site_title" class="form-control"
                                value="<?php echo htmlspecialchars($settings['site_title']); ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="site_description" class="form-label">Mô tả Website</label>
                            <textarea name="site_description" id="site_description" rows="3" class="form-control"
                                required><?php echo htmlspecialchars($settings['site_description']); ?></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="contact_email" class="form-label">Email liên hệ</label>
                            <input type="email" name="contact_email" id="contact_email" class="form-control"
                                value="<?php echo htmlspecialchars($settings['contact_email']); ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="social_facebook" class="form-label">Facebook (URL)</label>
                            <input type="url" name="social_facebook" id="social_facebook" class="form-control"
                                value="<?php echo htmlspecialchars($settings['social_facebook']); ?>">
                        </div>
                        <div class="mb-3">
                            <label for="social_twitter" class="form-label">Twitter (URL)</label>
                            <input type="url" name="social_twitter" id="social_twitter" class="form-control"
                                value="<?php echo htmlspecialchars($settings['social_twitter']); ?>">
                        </div>
                        <button type="submit" class="btn btn-primary">Cập nhật cài đặt</button>
                    </form>
                </div>
            </main>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>