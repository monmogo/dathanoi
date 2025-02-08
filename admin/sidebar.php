<!-- admin/sidebar.php -->
<style>
/* Sidebar container styling */
.sidebar {
    background: linear-gradient(135deg, #343a40, #212529);
    color: #fff;
    min-height: 100vh;
    padding-top: 20px;
    transition: all 0.3s ease-in-out;
    box-shadow: 2px 0 8px rgba(0, 0, 0, 0.15);
}

/* Sidebar nav container */
.sidebar .nav {
    margin: 0;
    padding: 0;
    list-style: none;
}

/* Sidebar nav links styling */
.sidebar .nav-link {
    display: block;
    color: #adb5bd;
    padding: 12px 20px;
    margin: 5px 10px;
    border-radius: 8px;
    transition: all 0.3s ease;
    font-size: 16px;
}

/* Hover and active state */
.sidebar .nav-link:hover,
.sidebar .nav-link.active {
    background-color: rgba(255, 255, 255, 0.15);
    color: #fff;
}

/* Icon styling */
.sidebar .nav-link i {
    margin-right: 10px;
    font-size: 18px;
}
</style>

<aside class="col-md-2 sidebar">
    <nav class="nav flex-column">
        <a class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'admin.php') ? 'active' : ''; ?>"
            href="admin.php">
            <i class="fas fa-tachometer-alt"></i> Admin Panel
        </a>
        <a class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'news_list.php') ? 'active' : ''; ?>"
            href="news_list.php">
            <i class="fas fa-newspaper"></i> Quản lý Tin tức
        </a>
        <a class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'users_list.php') ? 'active' : ''; ?>"
            href="users_list.php">
            <i class="fas fa-users"></i> Quản lý Người dùng
        </a>
        <a class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'areas_list.php') ? 'active' : ''; ?>"
            href="areas_list.php">
            <i class="fas fa-map-marker-alt"></i> Quản lý Khu vực
        </a>
        <a class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'projects_list.php') ? 'active' : ''; ?>"
            href="projects_list.php">
            <i class="fas fa-briefcase"></i> Quản lý Dự án
        </a>
        <a class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'settings.php') ? 'active' : ''; ?>"
            href="settings.php">
            <i class="fas fa-cogs"></i> Cài đặt
        </a>
    </nav>
</aside>