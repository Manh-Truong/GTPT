<?php ob_start(); ?>
<?php if(!isset($_SESSION)) { 
session_start(); 
} ?>
<?php include '../check.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm loại phòng trọ</title>
    
    <style>
        td{
            padding-right: 30px;
            color: black;
        }

        tr td{
            padding-top: 15px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-control {
            border-radius: 0;
            box-shadow   : none;
            height: 45px;

            &:hover {
                box-shadow: none;
            }

            &.active,
            &:focus {
                box-shadow: none;
            }
        }

        .col-form-label{
            padding-left: 30px;
        }

    </style>
</head>
<body>
    <div class="modal fade" id="addCategory" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
        <form action="add-category.php" method="POST" enctype="multipart/form-data">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Thêm loại phòng</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div class="input-group mb-3">
                    <div class="input-group-append">
                        <span class="input-group-text">Tên loại phòng</span>
                    </div>
                    <input type="text" class="form-control" name="categoryName">
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Thoát</button>
                <button type="submit" class="btn btn-primary" name="add_category">Lưu</button>
            </div>
            </div>
        </form>
        </div>
    </div>
</body>
</html>
<?php
    include("../connect.php");
    if (isset($_POST["add_category"])) {
        $categoryName = $_POST["categoryName"];
        $sql = "INSERT INTO category(categoryName) VALUES ('$categoryName')";
        $query_run = mysqli_query($conn, $sql);
        if($query_run){
            $_SESSION['success'] = "Thêm thành công";
            header('Location: ../admin/view-category.php');
        }else{
            $_SESSION['success'] = "Thêm không thành công";
            header('Location: ../admin/view-category.php');
        }
        mysqli_close($conn); 
    }
?>
<?php ob_flush() ?>