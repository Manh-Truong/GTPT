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
    <div class="modal fade" id="edit_user<?php echo $row['user_id']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
        <?php
            include("../connect.php");
            $sql = "SELECT * FROM user WHERE user_id='".$row['user_id']."'";
            $query = mysqli_query($conn, $sql);
            $row = mysqli_fetch_array($query);
        ?>
        <form action="edit-user.php?user_id=<?php echo $row['user_id']; ?>" method="POST" enctype="multipart/form-data">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Sửa người dùng</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <input type="hidden" class="form-control" name="user_id" value="<?php echo $row['user_id']; ?>">
                <div class="input-group mb-3">
                    <div class="input-group-append">
                        <span class="input-group-text">Tên người dùng</span>
                    </div>
                    <input type="text" class="form-control" name="Name" value="<?php echo $row['Name']; ?>">
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-append">
                        <span class="input-group-text">Tên tài khoản</span>
                    </div>
                    <input type="text" class="form-control" name="Username" value="<?php echo $row['Username']; ?>">
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-append">
                        <span class="input-group-text">Email</span>
                    </div>
                    <input type="email" class="form-control" name="Email" value="<?php echo $row['Email']; ?>">
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-append">
                        <span class="input-group-text">Số điện thoại</span>
                    </div>
                    <input type="text" class="form-control" name="Phone" value="<?php echo $row['Phone']; ?>">
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-append">
                        <span class="input-group-text">Hình ảnh</span>
                    </div>
                    <img src="../photo/user/<?php echo $row['Avatar']; ?>" style="height: 200px; width: 300px;">
                    <input type="file" class="form-control" name="Avatar" id="Avatar" style="height: 100%;" accept=".jpg, .png, .svg">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Thoát</button>
                <button type="submit" class="btn btn-primary" name="edit_user">Lưu</button>
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
    if(isset($_POST['edit_user'])) 
    {   
        $user_id = $_POST['user_id'];
        $name = $_POST['Name'];
        $username = $_POST['Username'];
        $email = $_POST['Email'];
        $phone = $_POST['Phone'];
        
        $img_name = $_FILES['Avatar']['name'];

        if(file_exists("../photo/user/".$img_name)) {
            $str = $_FILES['Avatar']['name'];
            $_SESSION['status'] = "Ảnh đã tồn tại '.$str.'";
            header('Location: ../admin/view-user.php');
        }
        else{
            $sql = "UPDATE user SET Name='$name', Username='$username', Email='$email', 
            Phone='$phone', Avatar='$img_name' WHERE user_id='$user_id'";
            $query_run = mysqli_query($conn, $sql);

            if($query_run){
                move_uploaded_file($_FILES['Avatar']['tmp_name'], '../photo/user/'.$img_name);
                $_SESSION['success'] = "Cập nhật thành công";
                header('Location: ../admin/view-user.php');
            }else{
                $_SESSION['success'] = "Cập nhật không thành công";
                header('Location: ../admin/view-user.php');
            }
        }
        mysqli_close($conn); 
    }
?>
<?php ob_end_flush(); ?>