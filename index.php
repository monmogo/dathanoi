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

    <!-- Styles -->
    <link rel="stylesheet" href="componer/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <!-- Nhúng Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <!-- Scripts -->
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script defer src="componer/js/main.js"></script>
</head>

<body>

    <!-- Header -->
    <?php include 'header.php'; ?>

    <!-- Banner -->
    <div class="banner">
        <div class="container-m">
            <div class="search-box">
                <!-- Tabs -->
                <div class="search-tabs">
                    <button class="tab active" onclick="changeTab(this, 'duan')">Chuyển đổi mục đích sử dụng
                        đất</button>
                    <button class="tab" onclick="changeTab(this, 'quyhoach')">Thủ tục tách thửa</button>
                    <button class="tab" onclick="changeTab(this, 'giadat')">Thủ tục cấp sổ đỏ mới</button>
                </div>

                <!-- Search Box -->
                <div class="search-input">
                    <input type="text" class="form-control" placeholder="Tìm kiếm dự án">
                    <button class="btn btn-primary">Tìm kiếm</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Phần giới thiệu đại lý -->
    <section class="agency-section">
        <div class="container text-center">
            <h2 class="agency-title">Bạn Là Đại Lý Bất Động Sản?</h2>
            <p class="agency-subtitle">Chúng tôi sẽ giúp sự nghiệp của bạn lên một tầm cao mới</p>

            <!-- Thêm div .agency-list-container để xử lý cuộn ngang -->
            <div class="agency-list-container">
                <div class="agency-list">
                    <div class="agency-item">
                        <img src="componer/asset/image/longbien.jpg" alt="Long Biên">
                        <span class="agency-label">LONG BIÊN</span>
                    </div>
                    <div class="agency-item">
                        <img src="componer/asset/image/longbien.jpg" alt="Hoài Đức">
                        <span class="agency-label">HOÀI ĐỨC</span>
                    </div>
                    <div class="agency-item">
                        <img src="componer/asset/image/longbien.jpg" alt="Nam Từ Liêm">
                        <span class="agency-label">NAM TỪ LIÊM</span>
                    </div>
                    <div class="agency-item">
                        <img src="componer/asset/image/longbien.jpg" alt="Hoàng Mai">
                        <span class="agency-label">HOÀNG MAI</span>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Phần Dự Án Mới Cập Nhật -->
    <section class="projects-section">
        <div class="container">
            <div class="projects-header">
                <h2>Dự án mới cập nhật</h2>
                <a href="#" class="view-all">Xem tất cả</a>
            </div>

            <!-- Danh sách dự án -->
            <div class="projects-grid" id="projectsGrid">
                <?php
                $projects = [
                    ["title" => "Liền kề Vinadic Cầu Diễn", "size" => "9,120 m²", "type" => "Liền kề", "status" => "Đã bàn giao", "image" => "componer/asset/image/duan.jpg"],
                    ["title" => "Biệt thự Sunshine City", "size" => "12,500 m²", "type" => "Biệt thự", "status" => "Sắp bàn giao", "image" => "componer/asset/image/duan.jpg"],
                    ["title" => "Chung cư The Matrix One", "size" => "25,000 m²", "type" => "Chung cư", "status" => "Đang xây dựng", "image" => "componer/asset/image/duan.jpg"],
                    ["title" => "Nhà phố Vinhomes", "size" => "5,800 m²", "type" => "Nhà phố", "status" => "Mở bán", "image" => "componer/asset/image/duan.jpg"],
                    ["title" => "Shophouse Grand World", "size" => "7,200 m²", "type" => "Shophouse", "status" => "Sẵn sàng bàn giao", "image" => "componer/asset/image/duan.jpg"],
                    ["title" => "Dự án Green Bay", "size" => "15,300 m²", "type" => "Căn hộ", "status" => "Hoàn thiện", "image" => "componer/asset/image/duan.jpg"],
                ];

                foreach ($projects as $index => $project) {
                    $hiddenClass = ($index >= 3) ? "hidden" : "";
                    echo '
                <div class="project-card ' . $hiddenClass . '">
                    <img src="' . $project["image"] . '" alt="' . $project["title"] . '">
                    <div class="project-info">
                        <h3>' . $project["title"] . '</h3>
                        <p>Diện tích: ' . $project["size"] . '</p>
                        <p>Loại hình: ' . $project["type"] . '</p>
                        <span class="status">' . $project["status"] . '</span>
                    </div>
                </div>';
                }
                ?>
            </div>

            <!-- Nút Xem thêm -->
            <button style="  display: none;" class="see-more-btn" id="seeMoreBtn">Xem thêm</button>
        </div>
    </section>
    <!-- Phần Tư Vấn Dịch Vụ -->
    <section class="service-section">
        <div class="service-container">
            <div class="service-content">
                <h2 class="service-title">Tư vấn dịch vụ</h2>

                <div class="service-item">
                    <i class="fas fa-exchange-alt service-icon"></i>
                    <div class="service-text">
                        <h3>Chuyển đổi mục đích sử dụng đất</h3>
                        <p>Hỗ trợ tư vấn các thủ tục pháp lý liên quan đến chuyển đổi mục đích sử dụng đất.</p>
                    </div>
                </div>

                <div class="service-item">
                    <i class="fas fa-cut service-icon"></i>
                    <div class="service-text">
                        <h3>Thủ tục tách thửa</h3>
                        <p>Cung cấp thông tin và hướng dẫn quy trình tách thửa đất theo quy định pháp luật.</p>
                    </div>
                </div>

                <div class="service-item">
                    <i class="fas fa-file-alt service-icon"></i>
                    <div class="service-text">
                        <h3>Thủ tục cấp sổ đỏ mới</h3>
                        <p>Hỗ trợ xin cấp sổ đỏ mới cho chủ sở hữu theo quy trình nhanh chóng.</p>
                    </div>
                </div>

                <button class="service-btn">LIÊN HỆ NGAY</button>
            </div>

            <div class="service-image">
                <img src="componer/asset/image/longbien.jpg" alt="Tư vấn dịch vụ">
            </div>
        </div>
    </section>
    <!-- Phần Tin Tức -->
    <section class="news-section">
        <div class="news-container">
            <!-- Header -->
            <div class="news-header">
                <div class="news-title">
                    <i class="fa-solid fa-newspaper"></i>
                    <div>
                        <h2>Tin tức</h2>
                        <p>Tin tức bất động sản mới nhất cả nước</p>
                    </div>
                </div>
                <a href="tin-tuc.php" class="view-all">Xem tất cả →</a>
            </div>

            <!-- Danh sách tin tức -->
            <div class="news-grid">
                <?php
                $news = [
                    ["title" => "Vì sao giá chung cư tại Hà Nội không ngừng tăng cao?", "image" => "componer/asset/image/duan.jpg"],
                    ["title" => "Dự án tuyến đường ven sông Hồng: Nâng cao giao thông và bảo vệ an toàn cho thủ đô Hà Nội", "image" => "componer/asset/image/duan.jpg"],
                    ["title" => "Bất động sản ven Vành đai 4 'nóng' giá tăng nhanh", "image" => "componer/asset/image/duan.jpg"],
                    ["title" => "Nỗi lo chung của người dân khi giá nhà ở Hà Nội ngày một 'thăng hoa'", "image" => "componer/asset/image/duan.jpg"],
                    ["title" => "Dự án công viên đa chức năng 173 tỷ đồng: Dấu ấn mới cho Long Biên", "image" => "componer/asset/image/duan.jpg"],
                    ["title" => "Dự án công viên đa chức năng 173 tỷ đồng: Dấu ấn mới cho Long Biên", "image" => "componer/asset/image/duan.jpg"]
                ];

                foreach ($news as $index => $item) {
                    $extraClass = ($index == 0) ? "large" : "";
                    $hiddenClass = ($index >= 5) ? "hidden-pc" : ""; // Ẩn bài viết thứ 6 trở đi trên PC
                    $hiddenMobile = ($index >= 2) ? "hidden-mobile" : ""; // Ẩn bài thứ 3 trở đi trên Mobile
                
                    echo '
                    <div class="news-item ' . $extraClass . ' ' . $hiddenClass . ' ' . $hiddenMobile . '">
                        <img src="' . $item["image"] . '" alt="' . $item["title"] . '">
                        <div class="news-overlay">
                            <p>' . $item["title"] . '</p>
                        </div>
                    </div>';
                }
                ?>
            </div>

            <!-- Nút Xem thêm -->
            <button class="see-more-btn" id="seeMoreBtn" onclick="window.location.href='tin-tuc.php'">Xem thêm</button>
        </div>
    </section>
    <!-- Phần Thông Tin Khu Vực -->
    <section class="area-section">
        <div class="area-container">
            <!-- Header -->
            <div class="area-header">
                <div class="area-title">
                    <i class="fa-solid fa-binoculars"></i>
                    <div>
                        <h2>Thông tin khu vực</h2>
                        <p>Danh sách thông tin khu vực trên cả nước</p>
                    </div>
                </div>
                <a href="khu-vuc.php" class="view-all">Xem tất cả →</a>
            </div>

            <!-- Danh sách khu vực -->
            <div class="area-grid">
                <?php
                $areas = [
                    ["name" => "Huyện Cần Giờ", "image" => "componer/asset/image/duan.jpg"],
                    ["name" => "Huyện Nhà Bè", "image" => "componer/asset/image/duan.jpg"],
                    ["name" => "Huyện Bình Chánh", "image" => "componer/asset/image/duan.jpg"],
                    ["name" => "Huyện Củ Chi", "image" => "componer/asset/image/duan.jpg"],
                    ["name" => "Huyện Hóc Môn", "image" => "componer/asset/image/duan.jpg"],
                    ["name" => "Huyện Mê Linh", "image" => "componer/asset/image/duan.jpg"]
                ];

                foreach ($areas as $index => $area) {
                    $extraClass = ($index >= 4) ? "wide" : ""; // 2 ô cuối sẽ rộng hơn
                    echo '
                <div class="area-item ' . $extraClass . '">
                    <img src="' . $area["image"] . '" alt="' . $area["name"] . '">
                    <div class="area-overlay">
                        <p>' . $area["name"] . '</p>
                    </div>
                </div>';
                }
                ?>
            </div>
        </div>
    </section>
    <section class="contact-section">
        <div class="contact-container">
            <h2>Liên hệ với tôi</h2>
            <p>Điền vào biểu mẫu bên dưới để gửi tin nhắn.</p>

            <form action="process_contact.php" method="post" class="contact-form">
                <div class="input-group">
                    <input type="text" id="name" name="name" placeholder="Tên của bạn *" required>
                </div>
                <div class="input-group">
                    <input type="number" id="sdt" name="sdt" placeholder="Số điện thoại *" required>
                </div>
                <div class="input-group">
                    <textarea id="message" name="message" rows="4" placeholder="Thông điệp *" required></textarea>
                </div>
                <button type="submit" class="contact-btn">Gửi tin nhắn</button>
            </form>
        </div>
    </section>




    <?php include 'footer.php'; ?>

    <script>
    function changeTab(element, type) {
        document.querySelectorAll('.tab').forEach(tab => tab.classList.remove('active'));
        element.classList.add('active');
    }
    document.addEventListener("DOMContentLoaded", function() {
        const seeMoreBtn = document.getElementById("seeMoreBtn");
        const hiddenProjects = document.querySelectorAll(".project-card.hidden");

        if (hiddenProjects.length === 0) {
            seeMoreBtn.style.display = "none"; // Ẩn nút nếu không có dự án nào bị ẩn
        }

        seeMoreBtn.addEventListener("click", function() {
            hiddenProjects.forEach(project => {
                project.classList.remove("hidden"); // Hiển thị tất cả dự án
            });

            seeMoreBtn.style.display = "none"; // Ẩn nút sau khi bấm
        });
    });
    </script>

</body>

</html>