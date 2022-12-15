<?php ob_start(); ?>
<?php if (!isset($_SESSION)) {
    session_start();
} ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Bài đăng - Admin</title>
    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>

<body id="page-top">
    <div id="wrapper">
        <!-- Sidebar -->
        <?php include 'sidebar.php' ?>
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
                <?php include 'topbar.php' ?>
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Quản lý các bài đăng</h1>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Danh sách bài đăng</h6>
                        </div>
                        <div class="card-body">
                            <?php
                                if (isset($_SESSION['success']) && $_SESSION['success'] != '') {
                                    echo "<script> alert('" . $_SESSION['success'] . "')</script>";
                                    unset($_SESSION['success']);
                                }
                            ?>
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Tên phòng trọ</th>
                                            <th>Hình ảnh</th>
                                            <th>Phân loại trọ</th>
                                            <th>Giá phòng</th>
                                            <th>Trạng thái</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        include("../connect.php");
                                        $query = "SELECT * FROM Motel m INNER JOIN Category c ON m.category_id = c.id";
                                        $values = mysqli_query($connect, $query);
                                        while ($row = mysqli_fetch_array($values)) {
                                        ?>
                                            <tr>
                                                <td><?php echo $row['motel_id']; ?></td>
                                                <td><?php echo $row['title']; ?></td>
                                                <td><img src="../uploads/<?php echo $row['images']; ?>" style="height: 100px; width: 160px;"></td>
                                                <td><?php echo $row['name']; ?></td>
                                                <td><?php echo number_format($row['price'], 0, ",", "."); ?></td>
                                                <?php if ($row['status'] == 0) : ?>
                                                    <td><span class="badge badge-success">Chưa kiểm duyệt</span></td>
                                                <?php elseif ($row['status'] == 1) : ?>
                                                    <td><span class="badge badge-danger">Đã kiểm duyệt</span></td>
                                                <?php elseif ($row['status'] == 2) : ?>
                                                    <td><span class="badge badge-warning">Sai nội dung</span></td>
                                                <?php endif; ?>
                                                <td style="text-align:center;">
                                                    <a href="#edit<?php echo $row['motel_id']; ?>" data-toggle="modal" class="btn btn-info btn-sm">
                                                        <i class="far fa-eye"></i> Xem
                                                    </a>
                                                    <?php include 'edit-baidang.php' ?>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Logout Modal-->
    <?php include './function/logoutmodal.php' ?>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>

</body>

</html>