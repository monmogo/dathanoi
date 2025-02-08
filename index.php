<?php
// index.php

// Kiểm tra banner: Nếu ảnh banner chính không tồn tại, dùng ảnh mặc định.
$bannerImagePath = 'componer/asset/image/banner-bg.jpg';
$defaultBanner = 'componer/css/banner.jpg';
if (!file_exists($bannerImagePath)) {
    $bannerImagePath = $defaultBanner;
}
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Chủ - Dân Đầu Tư</title>

    <!-- SEO Meta -->
    <meta name="description" content="Dân Đầu Tư - Cập nhật thông tin bất động sản, dự án và quy hoạch chính xác.">
    <meta name="keywords" content="bất động sản, dự án, quy hoạch, giá đất">
    <meta name="author" content="Dân Đầu Tư">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="componer/css/style.css">

    <!-- Scripts -->
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script defer src="componer/js/main.js"></script>

    <style>
    body {
        font-family: 'Roboto', sans-serif;
        background-color: #f4f6f9;
    }

    /* Banner Section */
    .banner {
        background: url('<?php echo $bannerImagePath; ?>') no-repeat center center/cover;
        padding: 100px 0;
        position: relative;
        color: #fff;
    }

    .banner::after {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.4);
        z-index: 1;
    }

    .banner .container {
        position: relative;
        z-index: 2;
    }

    .search-box {
        background-color: rgba(0, 0, 0, 0.6);
        padding: 20px;
        border-radius: 8px;
        max-width: 800px;
        margin: auto;
    }

    .search-tabs .tab {
        background: transparent;
        border: 1px solid #fff;
        color: #fff;
        padding: 10px 20px;
        margin-right: 5px;
        border-radius: 4px;
        cursor: pointer;
        transition: background 0.3s, color 0.3s;
    }

    .search-tabs .tab.active,
    .search-tabs .tab:hover {
        background: #fff;
        color: #333;
    }

    .search-input input.form-control {
        max-width: 500px;
        border-radius: 0;
    }

    /* Các style khác cho các section đã được tích hợp từ các file include */
    </style>
</head>

<body>
    <!-- Header -->
    <?php include 'header.php'; ?>

    <!-- Banner Section -->
    <div class="banner">
        <div class="container text-center">
            <div class="search-box">
                <!-- Tabs -->
                <div class="search-tabs mb-3">
                    <button class="tab active" onclick="changeTab(this, 'duan')">Chuyển đổi mục đích sử dụng
                        đất</button>
                    <button class="tab" onclick="changeTab(this, 'quyhoach')">Thủ tục tách thửa</button>
                    <button class="tab" onclick="changeTab(this, 'giadat')">Thủ tục cấp sổ đỏ mới</button>
                </div>
                <!-- Search Input -->
                <div class="search-input d-flex justify-content-center">
                    <input type="text" class="form-control me-2" placeholder="Tìm kiếm dự án" style="max-width: 500px;">
                    <button class="btn btn-primary">Tìm kiếm</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Agency Section -->
    <section class="agency-section py-5">
        <div class="container text-center">
            <h2 class="agency-title">Bạn Là Đại Lý Bất Động Sản?</h2>
            <p class="agency-subtitle">Chúng tôi sẽ giúp sự nghiệp của bạn lên một tầm cao mới</p>
            <div class="agency-list-container mt-4">
                <div class="agency-list d-flex justify-content-center gap-4 flex-wrap">
                    <div class="agency-item">
                        <img src="componer/asset/image/longbien.jpg" alt="Long Biên" class="rounded-circle"
                            style="width:150px; height:150px; object-fit: cover;">
                        <span class="agency-label d-block mt-2">LONG BIÊN</span>
                    </div>
                    <div class="agency-item">
                        <img src="componer/asset/image/longbien.jpg" alt="Hoài Đức" class="rounded-circle"
                            style="width:150px; height:150px; object-fit: cover;">
                        <span class="agency-label d-block mt-2">HOÀI ĐỨC</span>
                    </div>
                    <div class="agency-item">
                        <img src="componer/asset/image/longbien.jpg" alt="Nam Từ Liêm" class="rounded-circle"
                            style="width:150px; height:150px; object-fit: cover;">
                        <span class="agency-label d-block mt-2">NAM TỪ LIÊM</span>
                    </div>
                    <div class="agency-item">
                        <img src="componer/asset/image/longbien.jpg" alt="Hoàng Mai" class="rounded-circle"
                            style="width:150px; height:150px; object-fit: cover;">
                        <span class="agency-label d-block mt-2">HOÀNG MAI</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Projects Section -->
    <?php include 'project.php'; ?>

    <!-- Service Section -->
    <section class="service-section py-5 bg-light">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h2 class="service-title mb-4">Tư vấn dịch vụ</h2>
                    <div class="service-item d-flex mb-3">
                        <i class="fas fa-exchange-alt service-icon me-3"></i>
                        <div class="service-text">
                            <h3 class="mb-1">Chuyển đổi mục đích sử dụng đất</h3>
                            <p>Hỗ trợ tư vấn các thủ tục pháp lý liên quan đến chuyển đổi mục đích sử dụng đất.</p>
                        </div>
                    </div>
                    <div class="service-item d-flex mb-3">
                        <i class="fas fa-cut service-icon me-3"></i>
                        <div class="service-text">
                            <h3 class="mb-1">Thủ tục tách thửa</h3>
                            <p>Cung cấp thông tin và hướng dẫn quy trình tách thửa đất theo quy định pháp luật.</p>
                        </div>
                    </div>
                    <div class="service-item d-flex mb-3">
                        <i class="fas fa-file-alt service-icon me-3"></i>
                        <div class="service-text">
                            <h3 class="mb-1">Thủ tục cấp sổ đỏ mới</h3>
                            <p>Hỗ trợ xin cấp sổ đỏ mới cho chủ sở hữu theo quy trình nhanh chóng.</p>
                        </div>
                    </div>
                    <button class="service-btn mt-3">LIÊN HỆ NGAY</button>
                </div>
                <div class="col-md-6">
                    <img src="componer/asset/image/longbien.jpg" alt="Tư vấn dịch vụ" class="img-fluid rounded">
                </div>
            </div>
        </div>
    </section>

    <!-- News Section -->
    <?php include 'new-section.php'; ?>

    <!-- Area Section -->
    <?php include 'area_grid.php'; ?>

    <!-- Contact Section -->
    <section class="contact-section py-5">
        <div class="contact-container text-center">
            <h2>Liên hệ với tôi</h2>
            <p>Điền vào biểu mẫu bên dưới để gửi tin nhắn.</p>
            <form action="process_contact.php" method="post" class="contact-form">
                <div class="input-group mb-3">
                    <input type="text" id="name" name="name" class="form-control" placeholder="Tên của bạn *" required>
                </div>
                <div class="input-group mb-3">
                    <input type="number" id="sdt" name="sdt" class="form-control" placeholder="Số điện thoại *"
                        required>
                </div>
                <div class="input-group mb-3">
                    <textarea id="message" name="message" rows="4" class="form-control" placeholder="Thông điệp *"
                        required></textarea>
                </div>
                <button type="submit" class="btn btn-primary contact-btn">Gửi tin nhắn</button>
            </form>
        </div>
    </section>

    <!-- Footer -->
    <?php include 'footer.php'; ?>

    <script>
    // Chuyển đổi tab trong banner
    function changeTab(element, type) {
        document.querySelectorAll('.tab').forEach(tab => tab.classList.remove('active'));
        element.classList.add('active');
    }

    // Xử lý nút "Xem thêm" cho phần dự án nếu cần
    document.addEventListener("DOMContentLoaded", function() {
        const seeMoreBtn = document.getElementById("seeMoreBtn");
        const hiddenProjects = document.querySelectorAll(".project-card.hidden");

        if (hiddenProjects.length === 0) {
            seeMoreBtn.style.display = "none";
        }

        seeMoreBtn.addEventListener("click", function() {
            hiddenProjects.forEach(project => {
                project.classList.remove("hidden");
            });
            seeMoreBtn.style.display = "none";
        });
    });
    </script>
</body>

</html>