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
    <title>Thay đổi mật khẩu người dùng</title>
    <script src="../ckeditor/ckeditor.js"></script>
</head>
<body>
    <div class="modal fade" id="changepass_user<?php echo $row['user_id']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
        <?php
            include("../connect.php");
            $sql = "SELECT * FROM user WHERE user_id='".$row['user_id']."'";
            $query = mysqli_query($conn, $sql);
            $row = mysqli_fetch_array($query);
        ?>
        <form action="changepass.php?user_id=<?php echo $row['user_id']; ?>" method="POST" enctype="multipart/form-data">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Sửa mật khẩu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <input type="hidden" class="form-control" name="user_id" value="<?php echo $row['user_id']; ?>">
                <div class="input-group mb-3">
                    <div class="input-group-append">
                        <span class="input-group-text">Tên người dùng</span>
                    </div>
                    <input type="text" class="form-control" name="Name" value="<?php echo $row['Name']; ?>" readonly>
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-append">
                        <span class="input-group-text">Mật khẩu cũ</span>
                    </div>
                    <input type="password" class="form-control" name="pass">
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-append">
                        <span class="input-group-text">Mật khẩu mới</span>
                    </div>
                    <input type="password" class="form-control" name="new_pass">
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-append">
                        <span class="input-group-text">Nhập lại mật khẩu mới</span>
                    </div>
                    <input type="password" class="form-control" name="renew_pass">
                </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Thoát</button>
                <button type="submit" class="btn btn-primary" name="change_pass">Lưu</button>
            </div>
            </div>
        </form>
        </div>
    </div> 
</body>
</html>
<?php
    include "../connect.php";
    if (isset($_POST["change_pass"])) {
        $user_id = $_POST['user_id'];
        $password = $_POST["pass"];
        $new_password = $_POST["new_pass"];
        $renew_password = $_POST["renew_pass"];

        $sql1 = "SELECT Password FROM user WHERE user_id = '$user_id' AND Password = '$password'";
        $result = mysqli_query($conn, $sql1);
        $count = mysqli_num_rows($result);
            
        if ($count == 0) {
            echo "<script> alert('Mật khẩu không đúng !') </script>";
        }  
        else if($new_password != $renew_password){
            echo "<script> alert('Mật khẩu không khớp !') </script>";
        }
        else {
            $salt = random_bytes(32);
            $staticSalt = 'G4334#';
            $new_password = md5($staticSalt.$new_password.$salt);
            $sql2 = "UPDATE user SET Password = '$new_password' WHERE user_id = '$user_id'";
            $query = mysqli_query($conn, $sql2);

            if($query){
                $_SESSION['success'] = "Thay đổi mật khẩu thành công";
                header('Location: ../admin/view-user.php');
            }else{
                $_SESSION['success'] = "Thay đổi mật khẩu không thành công";
                header('Location: ../admin/view-user.php');
            }
        }
        mysqli_close($conn); 
    }
?>
<?php ob_end_flush(); ?>