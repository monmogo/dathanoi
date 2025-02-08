<?php
session_start();

// Kiểm tra đăng nhập và vai trò admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Dashboard</title>
    <!-- Nhúng Bootstrap CSS từ CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <!-- Nhúng Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
    /* Font toàn cục */
    body {
        font-family: 'Roboto', sans-serif;
        background-color: #f4f6f9;
        padding-top: 70px;
        /* Để không bị che bởi navbar cố định */
    }

    /* Navbar */
    .navbar {
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    /* Main content */
    .main-content {
        padding: 20px;
    }

    /* Footer */
    footer {
        background-color: #343a40;
        color: #adb5bd;
        padding: 20px 0;
        text-align: center;
        margin-top: 40px;
    }
    </style>
</head>

<body>
    <!-- Header: Navbar cố định -->
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Admin Panel</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <span class="nav-link">Chào mừng,
                                <?php echo htmlspecialchars($_SESSION['username']); ?>!</span>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php"><i class="fas fa-sign-out-alt"></i> Đăng xuất</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <!-- Layout chính với Sidebar và Nội dung -->
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar: Include file sidebar.php -->
            <?php include 'sidebar.php'; ?>

            <!-- Nội dung chính -->
            <main class="col-md-10 main-content">
                <div class="container">
                    <h1 class="mb-4">Dashboard</h1>
                    <p>Đây là trang quản trị chính của bạn.</p>
                    <!-- Ví dụ: Hiển thị Card thống kê -->
                    <div class="row">
                        <div class="col-md-4 mb-4">
                            <div class="card text-white bg-primary">
                                <div class="card-body">
                                    <h5 class="card-title"><i class="fas fa-newspaper"></i> Tin tức</h5>
                                    <p class="card-text">Số tin tức: <strong>120</strong></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-4">
                            <div class="card text-white bg-success">
                                <div class="card-body">
                                    <h5 class="card-title"><i class="fas fa-users"></i> Người dùng</h5>
                                    <p class="card-text">Số người dùng: <strong>85</strong></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-4">
                            <div class="card text-white bg-warning">
                                <div class="card-body">
                                    <h5 class="card-title"><i class="fas fa-briefcase"></i> Dự án</h5>
                                    <p class="card-text">Số dự án: <strong>45</strong></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Ví dụ: Biểu đồ/thông báo hoạt động -->
                    <div class="card mt-4">
                        <div class="card-header">
                            Thống kê hoạt động
                        </div>
                        <div class="card-body">
                            <p class="card-text">Nội dung báo cáo hoặc biểu đồ thống kê sẽ được hiển thị ở đây.</p>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <div class="container">
            <p>© <?php echo date("Y"); ?> Admin Panel. All rights reserved.</p>
        </div>
    </footer>

    <!-- Nhúng Bootstrap Bundle JS (bao gồm Popper) với thuộc tính defer -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" defer></script>
</body>

</html>