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
    <title>Sửa người dùng</title>
    
    <script src="../ckeditor/ckeditor.js"></script>
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
    <div class="modal fade" id="edit<?php echo $row['Motel_Id']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
        <?php
            include("../connect.php");
            $sql = "SELECT * FROM motel m INNER JOIN user u ON m.user_id = u.user_id WHERE Motel_Id='".$row['Motel_Id']."'" ;
            $query = mysqli_query($conn, $sql);
            $row = mysqli_fetch_array($query);
        ?>
        <form action="edit-baidang.php?Motel_Id=<?php echo $row['Motel_Id']; ?>" method="POST" enctype="multipart/form-data">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Kiểm duyệt phòng trọ</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <input type="hidden" class="form-control" name="Motel_Id" value="<?php echo $row['Motel_Id']; ?>">
                <div class="input-group mb-3">
                    <div class="input-group-append">
                        <span class="input-group-text">Tiêu đề</span>
                    </div>
                    <input type="text" class="form-control" name="title" value="<?php echo $row['title']; ?>" readonly>
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-append">
                        <span class="input-group-text">Mô tả</span>
                    </div>
                    <textarea name="description" id="description" rows="5" cols="100" readonly><?php echo $row['description']; ?></textarea>
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-append">
                        <span class="input-group-text">Giá</span>
                    </div>
                    <input type="number" class="form-control" name="price" value="<?php echo $row['price']; ?>" readonly>
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-append">
                        <span class="input-group-text">Diện tích</span>
                    </div>
                    <input type="text" class="form-control" name="area" value="<?php echo $row['area']; ?>" readonly>
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-append">
                        <span class="input-group-text">Địa chỉ</span>
                    </div>
                    <input type="text" class="form-control" name="address" value="<?php echo $row['address']; ?>" readonly>
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-append">
                        <span class="input-group-text">Hình ảnh</span>
                    </div>
                    <img src="../photo/user/<?php echo $row['images']; ?>" style="height: 200px; width: 300px;">
                    <!-- <input type="file" class="form-control" name="images" id="images" style="height: 100%;" accept=".jpg, .png, .svg" readonly> -->
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-append">
                        <span class="input-group-text">Số điện thoại</span>
                    </div>
                    <input type="text" class="form-control" name="phone" value="<?php echo $row['phone']; ?>" readonly>
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-append">
                        <span class="input-group-text">Lượt xem</span>
                    </div>
                    <input type="text" class="form-control" name="count_view" value="<?php echo $row['count_view']; ?>" readonly>
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-append">
                        <span class="input-group-text">Tiện ích</span>
                    </div>
                    <input type="text" class="form-control" name="utilities" value="<?php echo $row['utilities']; ?>" readonly>
                </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Thoát</button>
                <button type="submit" class="btn btn-success" name="duyet_motel">Duyệt</button>
                <button type="submit" class="btn btn-danger" name="not_duyet_motel">Sai nội dung</button>
            </div>
            </div>
            <script>CKEDITOR.replace('description');</script>
        </form>
        </div>
    </div>        
</body>
</html>
<?php
    include '../connect.php';
    if(isset($_POST['Motel_Id'])){
        $motel_id = $_POST['Motel_Id'];
        $sql = "SELECT DISTINCT status FROM motel WHERE Motel_Id='$motel_id'";
        $query_run = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($query_run);
    }
    if(isset($_SESSION["user"])){ $user_id = $_SESSION["user"]; }

    if(isset($_POST['duyet_motel'])) 
    {
        if($row['status'] == 1){
            $_SESSION['success'] = "Phòng này đã kiểm duyệt rồi.";
            header('Location: ../admin/view-baidang.php');
        }
        else if($row['status'] == 2){
            $_SESSION['success'] = "Phòng này đã sai nội dung.";
            header('Location: ../admin/view-baidang.php');
        } else{
            $sql1 = "UPDATE motel SET status=1, user_id='$user_id' WHERE Motel_Id='$motel_id'";
            $query_run1 = mysqli_query($conn, $sql1);
            if($query_run1){
                $_SESSION['success'] = "Kiểm duyệt thành công";
                header('Location: ../admin/view-baidang.php');
            }else{
                $_SESSION['success'] = "Kiểm duyệt không thành công";
                header('Location: ../admin/view-baidang.php');
            }
        }
    }

    if(isset($_POST['not_duyet_motel'])) 
    { 
        if($row['status'] == 1){
            $_SESSION['success'] = "Phòng này đã kiểm duyệt rồi.";
            header('Location: ../admin/view-baidang.php');
        }
        else if($row['status'] == 2){
            $_SESSION['success'] = "Phòng này đã sai nội dung.";
            header('Location: ../admin/view-baidang.php');
        } else{
            $sql2 = "UPDATE motel SET status=2, user_id='$user_id' WHERE Motel_Id='$motel_id'";
            $query_run2 = mysqli_query($conn, $sql2);
            if($query_run2){
                $_SESSION['success'] = "Kiểm duyệt thành công";
                header('Location: ../admin/view-baidang.php');
            }else{
                $_SESSION['success'] = "Kiểm duyệt không thành công";
                header('Location: ../admin/view-baidang.php');
            }
        }
    }
    mysqli_close($conn); 
?>
<?php ob_end_flush(); ?>