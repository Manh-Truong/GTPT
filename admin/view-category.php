<?php ob_start(); ?>
<?php session_start(); ?>
<?php include '../check.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách loại phòng trọ</title>
</head>
<body id="page-top">
    <div id="wrapper">

        <?php include '../admin/template/banner.php'?>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">

                <?php include '../admin/template/header.php'?>
                <div class="container-fluid">

                    <a href="#addCategory" data-toggle="modal" class="btn btn-primary"><i class="fas fa-plus"></i> Thêm mới</a>
                    <?php include 'add-category.php' ?>
                    
                    <div class="my-2"></div>

                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-dark">Danh sách loại phòng trọ</h6>
                        </div>
                        <div class="card-body">
                            <?php
                                if(isset($_SESSION['success']) && $_SESSION['success'] != ''){
                                    echo "<script> alert('" .$_SESSION['success']."')</script>";
                                    unset($_SESSION['success']);
                                }
                                
                                if(isset($_SESSION['status']) && $_SESSION['status'] != ''){
                                    echo "<script> alert('" .$_SESSION['status']."')</script>";
                                    unset($_SESSION['status']);
                                }
                            ?>
                            <div class="table-responsive">
                                <table id="dataTableCategory" class="table table-striped table-bordered" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Mã loại phòng</th>
                                            <th>Tên loại phòng</th>
                                            <th colspan=2 style="text-align:center;">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            include("../connect.php"); 
                                            $query = "SELECT * FROM category";     
                                            $values = mysqli_query ($conn, $query);   
                                            while($row = mysqli_fetch_array($values)){
                                        ?>
                                        <tr>
                                            <td><?php echo $row['category_id']; ?></td>
                                            <td><?php echo $row['categoryName']; ?></td>
                                            <td style="text-align:center;">
                                                <a href="#edit_category<?php echo $row['category_id']; ?>" data-toggle="modal" class="btn btn-warning"><i class="far fa-edit"></i></a>
                                                <?php include 'edit-category.php' ?>
                                            </td>
                                            <td style="text-align:center;">
                                                <a href="delete-category.php?category_id=<?php echo $row['category_id']; ?>" class="btn btn-danger"><i class="far fa-trash-alt"></i></a>
                                            </td>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    
</body>
</html>
<?php ob_end_flush(); ?>