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
    <title>Sửa địa chỉ phòng trọ</title>
    
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
    <div class="modal fade" id="edit_districts<?php echo $row['district_id']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
        <?php
            include("../connect.php");
            $sql = "SELECT * FROM districts WHERE district_id='".$row['district_id']."'";
            $query = mysqli_query($conn, $sql);
            $row = mysqli_fetch_array($query);
        ?>
        <form action="edit-districts.php?district_id=<?php echo $row['district_id']; ?>" method="POST" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Sửa địa chỉ phòng trọ</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <input type="hidden" class="form-control" name="district_id" value="<?php echo $row['district_id']; ?>">
                    <div class="input-group mb-3">
                        <div class="input-group-append">
                            <span class="input-group-text">Tên loại phòng trọ</span>
                        </div>
                        <input type="text" class="form-control" name="districtName" value="<?php echo $row['districtName']; ?>">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Thoát</button>
                    <button type="submit" class="btn btn-primary" name="edit_districts">Lưu</button>
                </div>
            </div>
        </form>
        </div>
    </div>
</body>
</html>
<?php
    if(isset($_POST['edit_districts'])) 
    {   
        $district_id = $_POST['district_id'];
        $districtName = $_POST['districtName'];
        
        $sql = "UPDATE districts SET districtName='$districtName' WHERE district_id='$district_id'";
        $ktra = mysqli_query($conn, $sql);

        $query_run = mysqli_query($conn, $sql);
        if($query_run){
            $_SESSION['success'] = "Cập nhật thành công";
            header('Location: ../admin/view-districts.php');
        }else{
            $_SESSION['success'] = "Cập nhật không thành công";
            header('Location: ../admin/view-districts.php');
        }

        mysqli_close($conn);  
    }
?>
<?php ob_end_flush(); ?>