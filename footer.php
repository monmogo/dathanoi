<style>
/* 🌟 Footer */
.footer {
    background: #e8e8e8;
    padding: 40px 0;
    font-size: 14px;
    color: #333;
}

.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
}

/* 🌟 Bố cục 3 cột */
.footer-content {
    display: flex;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 20px;
}

/* 🌟 Cột 1: Logo & Thông tin liên hệ */
.footer-info {
    flex: 1;
    min-width: 250px;
}

.footer-logo {
    width: 150px;
    margin-bottom: 10px;
}

.footer-info p {
    margin: 5px 0;
}

/* 🌟 Social Icons */
.footer-info a {
    margin-right: 10px;
    font-size: 16px;
    color: #333;
    transition: 0.3s;
}

.footer-info a:hover {
    color: #007bff;
}

/* 🌟 Cột 2: Link menu */
.footer-links {
    flex: 1;
    min-width: 200px;
}

.footer-links h4 {
    font-size: 16px;
    font-weight: bold;
    margin-bottom: 10px;
}

.footer-links ul {
    list-style: none;
    padding: 0;
}

.footer-links li {
    margin-bottom: 5px;
}

.footer-links a {
    text-decoration: none;
    color: #333;
    transition: 0.3s;
}

.footer-links a:hover {
    color: #007bff;
}

/* 🌟 Cột 3: Đăng ký theo dõi */
.footer-subscribe {
    flex: 1;
    min-width: 250px;
}

.footer-subscribe h4 {
    font-size: 16px;
    font-weight: bold;
    margin-bottom: 10px;
}

.footer-subscribe form {
    display: flex;
    align-items: center;
    background: white;
    border-radius: 5px;
    overflow: hidden;
    margin-top: 10px;
}

.footer-subscribe input {
    flex: 1;
    padding: 10px;
    border: none;
    outline: none;
    font-size: 14px;
}

.footer-subscribe button {
    background: #f7b500;
    border: none;
    padding: 10px;
    cursor: pointer;
}

.footer-subscribe button i {
    color: #fff;
    font-size: 16px;
}

.footer-subscribe .footer-certificates {
    margin-top: 10px;
}

.footer-certificates img {
    height: 25px;
    margin-right: 5px;
}

/* 🌟 Footer Bottom */
.footer-bottom {
    text-align: center;
    margin-top: 20px;
    padding-top: 10px;
    border-top: 1px solid #ccc;
}

/* 🌟 Responsive */
@media (max-width: 768px) {
    .footer-content {
        flex-direction: column;
        text-align: center;
    }

    .footer-info,
    .footer-links,
    .footer-subscribe {
        text-align: center;
    }

    .footer-subscribe form {
        justify-content: center;
    }

    .footer-subscribe input {
        width: 70%;
    }

    .footer-subscribe button {
        width: 50px;
    }
}
</style>
<footer class="footer">
    <div class="container">
        <div class="footer-content">
            <!-- Cột 1: Logo & Thông tin liên hệ -->
            <div class="footer-info">
                <img src="componer/asset/image/logo.png" alt="Dandautu Logo" class="footer-logo">
                <p><strong>E-mail:</strong> lienhe@dandautu.vn</p>
                <p><strong>Điện thoại:</strong> 0123 456 789</p>
                <p><strong>Địa chỉ:</strong> M4-L20 Khu Đô Thị Mới Dương Nội, Quận Hà Đông, TP Hà Nội.</p>
                <p><strong>Social:</strong>
                    <a href="#"><i class="fa-brands fa-facebook"></i></a>
                    <a href="#"><i class="fa-brands fa-twitter"></i></a>
                    <a href="#"><i class="fa-brands fa-youtube"></i></a>
                    <a href="#"><i class="fa-brands fa-telegram"></i></a>
                </p>
            </div>

            <!-- Cột 2: Về chúng tôi -->
            <div class="footer-links">
                <h4>Về chúng tôi</h4>
                <ul>
                    <li><a href="#">Giới thiệu</a></li>
                    <li><a href="#">Liên hệ</a></li>
                    <li><a href="#">Chính sách hoạt động</a></li>
                    <li><a href="#">Chính sách bảo mật</a></li>
                    <li><a href="#">Quy định đăng tin</a></li>
                </ul>
            </div>

            <!-- Cột 3: Đăng ký theo dõi -->
            <div class="footer-subscribe">
                <h4>Đăng ký theo dõi dandautu.vn</h4>
                <p>Nhận tin tức, biến động thị trường bất động sản nhanh nhất & chính xác nhất.</p>
                <form action="#" method="post">
                    <input type="email" placeholder="Nhập Email..." required>
                    <button type="submit"><i class="fa-solid fa-paper-plane"></i></button>
                </form>
                <div class="footer-certificates">
                    <img src="componer/asset/image/bo-cong-thuong.png" alt="Bộ Công Thương">
                    <img src="componer/asset/image/dmca-protected.png" alt="DMCA Protected">
                </div>
            </div>
        </div>

        <!-- Bản quyền -->
        <div class="footer-bottom">
            <p>CÔNG TY CỔ PHẦN THƯƠNG MẠI BILLIONS</p>
            <p>Số ĐKKD 0107704947 do Sở Kế hoạch và Đầu tư TP Hà Nội cấp ngày 13 tháng 01 năm 2017.</p>
            <p>Bản quyền thuộc về <strong>dandautu.vn</strong> © 2018 - 2023.</p>
        </div>
    </div>
</footer>