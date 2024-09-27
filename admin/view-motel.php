<?php ob_start(); ?>
<?php session_start(); ?>
<?php include '../check.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách phòng trọ</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
</head>

<body id="page-top">
    <div id="wrapper">

        <?php include '../admin/template/banner.php'; ?>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">

                <?php include '../admin/template/header.php'; ?>
                <div class="container-fluid">

                    <a href="#addMotel" data-toggle="modal" class="btn btn-primary"><i class="fas fa-plus"></i> Thêm mới</a>
                    <?php include 'add-motel.php' ?>

                    <div class="my-2"></div>

                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-dark">Danh sách các phòng trọ</h6>
                        </div>
                        <div class="card-body">
                            <?php
                            if (isset($_SESSION['success']) && $_SESSION['success'] != '') {
                                echo "<script> alert('" . $_SESSION['success'] . "')</script>";
                                unset($_SESSION['success']);
                            }

                            if (isset($_SESSION['status']) && $_SESSION['status'] != '') {
                                echo "<script> alert('" . $_SESSION['status'] . "')</script>";
                                unset($_SESSION['status']);
                            }
                            ?>

                            <div class="table-responsive">
                                <table id="dataTableMotel" class="table table-striped table-bordered" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Tiêu đề</th>
                                            <th>Danh mục</th>
                                            <th>Giá phòng</th>
                                            <th>Tình trạng</th>
                                            <th>Trạng thái</th>
                                            <th colspan=2 style="text-align:center;">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        include("../connect.php");
                                        $query = "SELECT * FROM Motel m INNER JOIN category c ON c.category_id = m.category_id WHERE status=1";
                                        $values = mysqli_query($conn, $query);
                                        while ($row = mysqli_fetch_array($values)) {
                                        ?>
                                            <tr>
                                                <td><?php echo $row['Motel_Id']; ?></td>
                                                <td><?php echo $row['title']; ?></td>
                                                <td><?php echo $row['categoryName']; ?></td>
                                                <td><?php echo number_format($row['price'], 0, ",", "."); ?></td>
                                                <?php if ($row['approve'] == 1) : ?>
                                                    <td><span class="badge badge-success">Có sẵn</span></td>
                                                <?php elseif ($row['approve'] == 0) : ?>
                                                    <td><span class="badge badge-danger">Không có sẵn</span></td>
                                                <?php endif; ?>
                                                <?php if ($row['status'] == 0) : ?>
                                                    <td><span class="badge badge-warning">Chưa kiểm duyệt</span></td>
                                                <?php elseif ($row['status'] == 1) : ?>
                                                    <td><span class="badge badge-success">Đã kiểm duyệt</span></td>
                                                <?php elseif ($row['status'] == 2) : ?>
                                                    <td><span class="badge badge-danger">Sai nội dung</span></td>
                                                <?php endif; ?>
                                                <td style="text-align:center;">
                                                    <a href="#edit_motel<?php echo $row['Motel_Id']; ?>" data-toggle="modal" class="btn btn-warning"><i class="far fa-edit"></i></a>
                                                    <?php include 'edit-motel.php' ?>
                                                </td>
                                                <td style="text-align:center;">
                                                    <a href="delete-motel.php?Motel_Id=<?php echo $row['Motel_Id']; ?>" class="btn btn-info"><i class="far fa-trash-alt"></i></a>
                                                </td>
                                            </tr>
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

    <script>
        $(document).ready(function() {
            $('#dataTableMotel').DataTable({
                "iDisplayLength": 5,
                "aLengthMenu": [
                    [5, 10, 25, 50, 100, -1],
                    [5, 10, 25, 50, 100, "All"]
                ],
                "language": {
                    "lengthMenu": "Hiển thị _MENU_ bản ghi",
                    "zeroRecords": "Không tìm thấy gì",
                    "info": "Đang hiển thị trang _PAGE_ trên tổng _PAGES_ trang",
                    "infoEmpty": "Không có bản ghi nào có sẵn",
                    "infoFiltered": "(lọc được _MAX_ bản ghi)",
                    "search": "Tìm kiếm:",
                    "paginate": {
                        "first": "First",
                        "last": "Last",
                        "next": "Next",
                        "previous": "Previous"
                    }
                }
            });
        });
    </script>

</body>

</html>
<?php ob_end_flush(); ?>