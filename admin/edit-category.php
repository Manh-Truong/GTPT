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
    <title>Sửa loại phòng trọ</title>

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
    <div class="modal fade" id="edit_category<?php echo $row['category_id']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
        <?php
            include("../connect.php");
            $sql = "SELECT * FROM category WHERE category_id='".$row['category_id']."'";
            $query = mysqli_query($conn, $sql);
            $row = mysqli_fetch_array($query);
        ?>
        <form action="edit-category.php?category_id=<?php echo $row['category_id']; ?>" method="POST" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Sửa loại phòng</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <input type="hidden" class="form-control" name="category_id" value="<?php echo $row['category_id']; ?>">
                    <div class="input-group mb-3">
                        <div class="input-group-append">
                            <span class="input-group-text">Tên loại phòng</span>
                        </div>
                        <input type="text" class="form-control" name="categoryName" value="<?php echo $row['categoryName']; ?>">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Thoát</button>
                    <button type="submit" class="btn btn-primary" name="edit_category">Lưu</button>
                </div>
            </div>
        </form>
        </div>
    </div>
</body>
</html>
<?php
    if(isset($_POST['edit_category'])) 
    {   
        $category_id = $_POST['category_id'];
        $categoryName = $_POST['categoryName'];
        
        $sql = "UPDATE category SET categoryName='$categoryName' WHERE category_id='$category_id'";

        $query_run = mysqli_query($conn, $sql);
        if($query_run){
            $_SESSION['success'] = "Cập nhật thành công";
            header('Location: ../admin/view-category.php');
        }else{
            $_SESSION['success'] = "Cập nhật không thành công";
            header('Location: ../admin/view-category.php');
        }

        mysqli_close($conn); 
    }
?>
<?php ob_end_flush(); ?>