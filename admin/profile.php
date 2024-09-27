<?php ob_start(); ?>
<?php session_start(); ?>
<?php include '../check.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông tin cá nhân</title> 
</head>
<body id="page-top">
    <div id="wrapper">

        <?php include '../admin/template/banner.php'?>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">

                <?php include '../admin/template/header.php'?>
                <div class="container-fluid">
                    
                    <div class="my-2"></div>

                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-dark">Thông tin cá nhân</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="dataTableUser" class="table table-striped table-bordered" width="100%" cellspacing="0">
                                    <tbody>
                                        <tr>
                                            <th>Tên người dùng</th>
                                            <td><?php if(isset($_SESSION['Name'])) { echo $_SESSION['Name']; }?></td>
                                        </tr>
                                        <tr>
                                            <th>Email</th>
                                            <td><?php if(isset($_SESSION['Email'])) { echo $_SESSION['Email']; }?></td>
                                        </tr>
                                        <tr>
                                            <th>Số điện thoại</th>
                                            <td><?php if(isset($_SESSION['Phone'])) { echo $_SESSION['Phone']; }?></td>
                                        </tr>
                                        <tr>
                                            <th>Hình ảnh</th>
                                            <td><img src="../photo/user/<?php if(isset($_SESSION['Avatar'])) { echo $_SESSION['Avatar'];} ?>" style="height: 200px;"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</body>
</html>
<?php ob_end_flush(); ?>