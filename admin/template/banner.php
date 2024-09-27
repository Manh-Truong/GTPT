<?php ob_start(); ?>
<?php if(!isset($_SESSION)) { 
session_start(); 
} ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Banner</title>
</head>
<body>
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="">
            <div class="sidebar-brand-icon rotate-n-15">
                <i class="fas fa-laugh-wink"></i>
            </div>
            <div class="sidebar-brand-text mx-3">Admin</div>
        </a>

        <hr class="sidebar-divider my-0">

        <?php if($_SESSION['ROLE'] == 1) {?>

        <li class="nav-item active">
            <a class="nav-link" href="find_arr.php">
                <i class="fas fa-home"></i> Trang chủ</a>
        </li>

        <li class="nav-item active dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-tasks"></i> Quản lý
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="view-baidang.php">Quản lý bài đăng</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="view-motel.php">Quản lý phòng trọ</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="view-user.php">Quản lý người dùng</a>
            </div>
        </li>

        <li class="nav-item active">
            <a class="nav-link" href="profile.php">
                <i class="fas fa-user-circle"></i> Thông tin cá nhân</a>
        </li>

        <?php } ?>

    </ul>
</body>
</html>
<?php ob_end_flush(); ?>