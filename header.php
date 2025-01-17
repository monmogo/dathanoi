<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Header - DATHANOI</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="componer/css/header.css">
</head>

<body>
    <!-- Thanh điều hướng -->
    <header class="navbar navbar-expand-lg bg-white shadow-sm">
        <div class="container d-flex justify-content-between align-items-center">
            <!-- Logo -->
            <a class="navbar-brand" href="index.php">
                <img src="componer/asset/image/logo.png" alt="DATHANOI">
            </a>

            <!-- Nút menu (trên mobile) & nút tư vấn -->
            <div class="d-flex align-items-center">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>

            </div>

            <!-- Menu chính -->
            <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="index.php">TRANG CHỦ</a></li>
                    <li class="nav-item"><a class="nav-link" href="du-an.php">DỰ ÁN</a></li>
                    <li class="nav-item"><a class="nav-link" href="mua-ban.php">MUA BÁN</a></li>
                    <li class="nav-item"><a class="nav-link" href="tin-tuc.php">TIN TỨC</a></li>
                </ul>
            </div>
            <a href="lien-he.php" class="btn btn-outline-primary ms-3">NHẬN TƯ VẤN NGAY</a>
        </div>
    </header>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>