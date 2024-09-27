<?php ob_start(); ?>
<?php session_start(); ?>
<?php include '../check.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách các bài đăng</title>
</head>
<body id="page-top">
    <div id="wrapper">

        <?php include '../admin/template/banner.php';?>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">

                <?php include '../admin/template/header.php'; ?>
                <div class="container-fluid">

                    <div class="my-2"></div>

                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-dark">Danh sách các bài đăng</h6>
                        </div>
                        <div class="card-body">
                            <?php
                                if(isset($_SESSION['success']) && $_SESSION['success'] != ''){
                                    echo "<script> alert('" .$_SESSION['success']."')</script>";
                                    unset($_SESSION['success']);
                                }
                            ?>

                            <div class="table-responsive">
                                <table id="dataTableID" class="table table-striped table-bordered" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th class="col-md-5">Tiêu đề</th>
                                            <th>Danh mục</th>
                                            <th>Giá phòng</th>
                                            <th>Trạng thái</th>
                                            <th colspan=2 style="text-align: center;">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            include("../connect.php"); 
                                            $query = "SELECT * FROM Motel m INNER JOIN Category c ON m.category_id = c.category_id";     
                                            $values = mysqli_query ($conn, $query);   
                                            while($row = mysqli_fetch_array($values)){
                                        ?>
                                        <tr>
                                            <td><?php echo $row['Motel_Id']; ?></td>
                                            <td><?php echo $row['title']; ?></td>
                                            <td><?php echo $row['categoryName']; ?></td>
                                            <td><?php echo number_format($row['price'], 0, ",", "."); ?></td>
                                            <?php if($row['status'] == 1): ?>
                                                <td><span class="badge badge-success">Đã kiểm duyệt</span></td>
                                            <?php elseif($row['status'] == 2): ?>
                                                <td><span class="badge badge-danger">Sai nội dung</span></td>
                                            <?php elseif($row['status'] == 0): ?>
                                                <td><span class="badge badge-warning">Chưa kiểm duyệt</span></td>
                                            <?php endif; ?>
                                            <td style="text-align:center;">
                                                <a href="#edit<?php echo $row['Motel_Id']; ?>" data-toggle="modal" class="btn btn-info btn-sm"><i class="far fa-eye"></i> Xem</a>
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

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    
    <script>
        // $(document).ready(function() {
        //     $('#dataTableID').DataTable({
        //         "iDisplayLength": 5,
        //         "aLengthMenu": [[5, 10, 25, 50, 100, -1], [5, 10, 25, 50, 100, "All"]],
        //         "language": {
        //             "lengthMenu": "Hiển thị _MENU_ bản ghi",
        //             "zeroRecords": "Không tìm thấy gì",
        //             "info": "Đang hiển thị trang _PAGE_ trên tổng _PAGES_ trang",
        //             "infoEmpty": "Không có bản ghi nào có sẵn",
        //             "infoFiltered": "(lọc được _MAX_ bản ghi)",
        //             "search": "Tìm kiếm:",
        //             "paginate": {
        //                 "first": "First",
        //                 "last":  "Last",
        //                 "next":  "Next",
        //                 "previous": "Previous"
        //             }
        //         }
        //     }); 
        // });
    </script>
</body>
</html>
<?php ob_end_flush(); ?>