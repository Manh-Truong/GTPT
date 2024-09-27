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
    <title>Xoá loại phòng trọ</title>
</head>
<body>
    <?php
        $category_id=$_GET['category_id'];
        include("../connect.php"); 
        $query = "DELETE FROM category WHERE category_id='$category_id'";
        $query_run = mysqli_query($conn, $query);
        if($query_run){
            $_SESSION['success'] = "Xoá thành công";
            header('Location: ../admin/view-category.php');
        }else{
            $_SESSION['success'] = "Xoá không thành công";
            header('Location: ../admin/view-category.php');
        } 
        mysqli_close($conn);  
    ?>  
</body>
</html>
<?php ob_end_flush(); ?>