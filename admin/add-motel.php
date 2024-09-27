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
    <title>Thêm phòng trọ</title>
    
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
    <div class="modal fade" id="addMotel" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
        <form action="add-motel.php" method="POST" enctype="multipart/form-data">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Thêm phòng trọ</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div class="input-group mb-3">
                    <div class="input-group-append">
                        <span class="input-group-text">Tiêu đề</span>
                    </div>
                    <input type="text" class="form-control" name="title" placeholder="Nhập tiêu đề...">
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-append">
                        <span class="input-group-text">Mô tả</span>
                    </div>
                    <textarea name="description" id="description" rows="10" cols="150"></textarea>
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-append">
                        <span class="input-group-text">Giá</span>
                    </div>
                    <input type="number" class="form-control" name="price" min="1">
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-append">
                        <span class="input-group-text">Diện tích</span>
                    </div>
                    <input type="text" class="form-control" name="area">
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-append">
                        <span class="input-group-text">Địa chỉ</span>
                    </div>
                    <input type="text" class="form-control" name="address">
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-append">
                        <span class="input-group-text">Hình ảnh</span>
                    </div>
                    <input type="file" class="form-control" name="images" id="images" style="height: 100%;" accept=".jpg, .png, .svg">
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-append">
                        <span class="input-group-text">Số điện thoại</span>
                    </div>
                    <input type="text" class="form-control" name="phone">
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-append">
                        <span class="input-group-text">Lượt xem</span>
                    </div>
                    <input type="text" class="form-control" name="count_view">
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-append">
                        <span class="input-group-text">Tiện ích</span>
                    </div>
                    <input type="text" class="form-control" name="utilities">
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-append">
                        <span class="input-group-text">Tình trạng</span>
                    </div>
                    <input type="text" class="form-control" name="approve">
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-append">
                        <span class="input-group-text">Trạng thái</span>
                    </div>
                    <input type="text" class="form-control" name="status">
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Thoát</button>
                <button type="submit" class="btn btn-primary" name="addmotel">Lưu</button>
            </div>
            </div>
            <script>CKEDITOR.replace('description');</script>
        </form>
        </div>
    </div>
</body>
</html>
<?php
    include("../connect.php");
    if (isset($_POST["addmotel"])) {
        $title = $_POST["title"];
        $description = $_POST["description"];
        $price = $_POST["price"];
        $area = $_POST["area"];
        $address = $_POST["address"];
        $utilities = $_POST["utilities"];
        $count_view = $_POST["count_view"];
        $created_at = date('Y-m-d H:i:s');
        $phone = $_POST["phone"];
        $approve = $_POST["approve"];
        $status = $_POST["status"];
        
        if(isset($_SESSION["user"])){ $user_id = $_SESSION["user"]; }
        if(isset($_SESSION["category"])){ $category_id = $_SESSION["category"]; }
        if(isset($_SESSION["districts"])){ $district_id = $_SESSION["districts"]; }
        
        $img_name = $_FILES["images"]["name"];

        if(file_exists("../photo/".$img_name)) {
            $str = $_FILES["images"]["name"];
            $_SESSION["status"] = "Images already exists. ".$str."";
            header("Location: ../admin/view-motel.php");
        }
        else{
            $sql = "INSERT INTO motel(title, description, price, area, count_view, 
            address, images, utilities, created_at, phone, approve, user_id, category_id, 
            district_id) VALUES ('$title', '$description', '$price', '$area', '$count_view', 
            '$address', '$img_name', '$utilities', '$created_at', '$phone', '$approve', '$status', 
            '$user_id', '$category_id', '$district_id')";
            
            $query_run = mysqli_query($conn, $sql);
            if($query_run){
                move_uploaded_file($_FILES['images']['tmp_name'], '../photo/'.$img_name);
                $_SESSION['success'] = "Thêm thành công";
                header('Location: ../admin/view-motel.php');
            }else{
                $_SESSION['success'] = "Thêm không thành công";
                header('Location: ../admin/view-motel.php');
            }
        }
        
        mysqli_close($conn); 
    }
?>
<?php ob_end_flush(); ?>