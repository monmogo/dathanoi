<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Font Awesome -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
<link rel="stylesheet" href="css/sidebar.css">

<!-- Sidebar -->
<div class="admin-sidebar d-flex flex-column flex-shrink-0 p-3 bg-light" style="width: 250px;">
    <a href="#" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-decoration-none">
        <i class="fa-solid fa-user-shield me-2"></i>
        <span class="fs-4">Admin Panel</span>
    </a>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
            <a href="admin_dashboard.php" class="nav-link active">
                <i class="fa-solid fa-house me-2"></i> Dashboard
            </a>
        </li>
        <li>
            <a href="manager_banners.php" class="nav-link">
                <i class="fa-solid fa-users me-2"></i> Quản lý Banner
            </a>
        </li>
        <li>
            <a href="manage_posts.php" class="nav-link">
                <i class="fa-solid fa-file-alt me-2"></i> Posts
            </a>
        </li>
        <li>
            <a href="settings.php" class="nav-link">
                <i class="fa-solid fa-cogs me-2"></i> Settings
            </a>
        </li>
    </ul>
    <hr>
    <div class="dropdown">
        <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle" id="dropdownUser"
            data-bs-toggle="dropdown" aria-expanded="false">
            <img src="https://via.placeholder.com/40" alt="" class="rounded-circle me-2">
            <strong>Admin</strong>
        </a>
        <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser">
            <li><a class="dropdown-item" href="profile.php">Profile</a></li>
            <li><a class="dropdown-item" href="logout.php">Sign out</a></li>
        </ul>
    </div>
</div>
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>