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
    <title>Thêm người dùng</title>
    
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
    <div class="modal fade" id="addUser" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
        <form action="add-user.php" method="POST" enctype="multipart/form-data">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Thêm người dùng</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div class="input-group mb-3">
                    <div class="input-group-append">
                        <span class="input-group-text">Tên người dùng</span>
                    </div>
                    <input type="text" class="form-control" name="Name">
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-append">
                        <span class="input-group-text">Tên tài khoản</span>
                    </div>
                    <input type="text" class="form-control" name="Username">
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-append">
                        <span class="input-group-text">Email</span>
                    </div>
                    <input type="email" class="form-control" name="Email">
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-append">
                        <span class="input-group-text">Mật khẩu</span>
                    </div>
                    <input type="password" class="form-control" name="Password">
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-append">
                        <span class="input-group-text">Số điện thoại</span>
                    </div>
                    <input type="text" class="form-control" name="Phone">
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-append">
                        <span class="input-group-text">Hình ảnh</span>
                    </div>
                    <input type="file" class="form-control" name="Avatar" id="Avatar" style="height: 100%;" accept=".jpg, .png, .svg">
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Thoát</button>
                <button type="submit" class="btn btn-primary" name="add_user">Lưu</button>
            </div>
            </div>
        </form>
        </div>
    </div>
</body>
</html>
<?php
    include "../connect.php";
    if (isset($_POST["add_user"])) {
        $Name = $_POST["Name"];
        $Username = $_POST["Username"];
        $Email = $_POST["Email"];
        $Password = $_POST["Password"];
        $Phone = $_POST["Phone"];
        $Role = $_SESSION['ROLE'];
        $img_name = $_FILES['Avatar']['name'];

        $salt = random_bytes(32);
        $staticSalt = 'G4334#';
        $new_password = md5($staticSalt.$Password.$salt);

        if(file_exists("../photo/user/".$img_name)) {
            $str = $_FILES['Avatar']['name'];
            $_SESSION['status'] = "Images already exists. '.$str.'";
            header('Location: ../admin/view-user.php');
            die();
        }
        else{
            $sql = "INSERT INTO user(Name, Username, Email, Password, Role, Phone, Avatar) 
            VALUES ('$Name', '$Username', '$Email', '$new_password', '$Role', '$Phone', '$img_name')";

            $query_run = mysqli_query($conn, $sql);
            if($query_run){
                move_uploaded_file($_FILES['Avatar']['tmp_name'], '../photo/user/'.$img_name);
                $_SESSION['success'] = "Thêm thành công";
                header('Location: ../admin/view-user.php');
            }else{
                $_SESSION['success'] = "Thêm không thành công";
                header('Location: ../admin/view-user.php');
            }
        }
        
        mysqli_close($conn); 
    }
?>
<?php ob_flush() ?>