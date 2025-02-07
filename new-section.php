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