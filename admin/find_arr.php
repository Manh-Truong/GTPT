<?php ob_start(); ?>
<?php session_start(); ?>
<?php include '../check.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách tất cả các phòng trọ</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
</head>
<body id="page-top">
    <div id="wrapper">

        <?php include '../admin/template/banner.php';?>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">

                <?php include '../admin/template/header.php'; ?>
                <div class="container-fluid">

                    <form method="POST">
                        <div class="form-row">
                            <div class="col-md-3 my-1">
                                <select class="custom-select mr-sm-2" name='find' id='find'>
                                    <option selected="selected">Chọn...</option>
                                    <option value="1">Tài khoản đăng</option>
                                    <option value="2">Khoảng thời gian đăng</option>
                                    <option value="3">Khoảng giá</option>
                                </select>
                            </div>
                            <div class="col-md-3 my-1">
                                <input type="text" class="form-control" name="input_find" id="input_find">
                            </div>
                            <div class="col-md-3 my-1">
                                <input type="text" class="form-control" name="find_price" id="find_price">
                            </div>
                            <div class="col-md-3 my-1">
                                <button type="submit" class="btn btn-primary" name="find_submit"><i class="fas fa-search-plus"></i> Tìm kiếm</button>
                            </div>
                        </div>
                    </form> 

                    <div class="my-2"></div>

                    <?php
                        function time_diff_string($from, $to, $full = false) {
                            $from = new DateTime($from);
                            $to = new DateTime($to);
                            $diff = $to->diff($from);
                        
                            $diff->w = floor($diff->d / 7);
                            $diff->d -= $diff->w * 7;
                        
                            $string = array(
                                'y' => 'năm',
                                'm' => 'tháng',
                                'w' => 'tuần',
                                'd' => 'ngày',
                                'h' => 'giờ',
                                'i' => 'phút',
                                's' => 'giây',
                            );
                            foreach ($string as $k => &$v) {
                                if ($diff->$k) {
                                    $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? '' : '');
                                } else {
                                    unset($string[$k]);
                                }
                            }
                        
                            if (!$full) $string = array_slice($string, 0, 1);
                            return $string ? implode(', ', $string) . ' trước ' : ' just now ';
                        }
                        // echo "<br>" .time_diff_string('2021-12-22 11:09:01', 'now');
                    ?>

                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-dark">Danh sách các phòng trọ</h6>
                        </div>
                        <div class="card-body">
                            <?php
                                if(isset($_SESSION['success']) && $_SESSION['success'] != ''){
                                    echo "<script> alert('" .$_SESSION['success']."')</script>";
                                    unset($_SESSION['success']);
                                }
                                
                                if(isset($_SESSION['status']) && $_SESSION['status'] != ''){
                                    echo "<script> alert('" .$_SESSION['status']."')</script>";
                                    unset($_SESSION['status']);
                                }
                            ?>

                            <div class="table-responsive">
                                <table id="dataTableID" class="table table-striped table-bordered" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Bài đăng</th>
                                            <th>Giá</th>
                                            <th>Trạng thái</th>
                                            <th style="text-align: center;">Thời gian</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            include("../connect.php"); 
                                            $query = "SELECT * FROM motel";     
                                            $values = mysqli_query ($conn, $query);   
                                            while($row = mysqli_fetch_array($values)){
                                        ?>
                                        <tr>
                                            <td><?php echo $row['Motel_Id']; ?></td>
                                            <td><?php echo $row['title']; ?></td>
                                            <td><?php echo number_format($row['price'], 0, ",", "."); ?></td>
                                            <?php if($row['approve'] == 0): ?>
                                                <td><span class="badge badge-success">Có sẵn</span></td>
                                            <?php elseif($row['approve'] == 1): ?>
                                                <td><span class="badge badge-danger">Không có sẵn</span></td>
                                            <?php endif; ?>
                                            <?php $time = $row['created_at']; ?>
                                            <td><?php echo time_diff_string($time, 'now') ." ";
                                                echo '<span class="badge badge-pill badge-primary">' .$row['created_at'] ."</span>"; 
                                                ?>
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
                    <?php
                        include("../connect.php");
                        if(isset($_POST['find_submit'])){
                            $select_find = $_POST['find'];
                            $input_fi = $_POST['input_find'];
                            $find_pr = $_POST['find_price'];
                            if($select_find == 1){
                            ?>
                                <!-- <script> 
                                    $(function(){
                                        $('#find_price').remove();
                                    });
                                </script> -->
                                <div class="card shadow mb-4">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-dark">Danh sách các phòng trọ theo tên bài đăng</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
                                                <thead>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>Bài đăng</th>
                                                        <th>Giá</th>
                                                        <th>Trạng thái</th>
                                                        <th style="text-align: center;">Thời gian</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                        $sql1 = "SELECT * FROM motel WHERE title LIKE '%$input_fi%'";
                                                        $query1 = mysqli_query($conn, $sql1);
                                                        while($row1 = mysqli_fetch_array($query1)){ ?>
                                                    <tr>
                                                        <td><?php echo $row1['Motel_Id']; ?></td>
                                                        <td><?php echo $row1['title']; ?></td>
                                                        <td><?php echo number_format($row1['price'], 0, ",", "."); ?></td>
                                                        <?php if($row1['approve'] == 0): ?>
                                                            <td><span class="badge badge-success">Có sẵn</span></td>
                                                        <?php elseif($row1['approve'] == 1): ?>
                                                            <td><span class="badge badge-danger">Không có sẵn</span></td>
                                                        <?php endif; ?>
                                                        <?php $time = $row1['created_at']; ?>
                                                        <td><?php echo time_diff_string($time, 'now') ." ";
                                                            echo '<span class="badge badge-pill badge-primary">' .$row1['created_at'] ."</span>"; 
                                                            ?>
                                                        </td>
                                                    </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                            <?php
                            }else if($select_find == 2){
                            ?>
                                <div class="card shadow mb-4">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-dark">Danh sách các phòng trọ theo khoảng thời gian đăng</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
                                                <thead>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>Bài đăng</th>
                                                        <th>Giá</th>
                                                        <th>Trạng thái</th>
                                                        <th style="text-align: center;">Thời gian</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                        $sql2 = "SELECT * FROM motel WHERE created_at BETWEEN '$input_fi' AND '$find_pr'";
                                                        $query2 = mysqli_query($conn, $sql2);
                                                        while($row2 = mysqli_fetch_array($query2)){?>
                                                    <tr>
                                                        <td><?php echo $row2['Motel_Id']; ?></td>
                                                        <td><?php echo $row2['title']; ?></td>
                                                        <td><?php echo number_format($row2['price'], 0, ",", "."); ?></td>
                                                        <?php if($row2['approve'] == 0): ?>
                                                            <td><span class="badge badge-success">Có sẵn</span></td>
                                                        <?php elseif($row2['approve'] == 1): ?>
                                                            <td><span class="badge badge-danger">Không có sẵn</span></td>
                                                        <?php endif; ?>
                                                        <?php $time = $row2['created_at']; ?>
                                                        <td><?php echo time_diff_string($time, 'now') ." ";
                                                            echo '<span class="badge badge-pill badge-primary">' .$row2['created_at'] ."</span>"; 
                                                            ?>
                                                        </td>
                                                    </tr>
                                                    <?php } ?> 
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            }else if($select_find == 3){
                            ?>
                                <div class="card shadow mb-4">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-dark">Danh sách các phòng trọ theo khoảng giá</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
                                                <thead>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>Bài đăng</th>
                                                        <th>Giá</th>
                                                        <th>Trạng thái</th>
                                                        <th style="text-align: center;">Thời gian</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                <?php
                                                    $sql3 = "SELECT * FROM motel WHERE price BETWEEN '$input_fi' AND '$find_pr'";
                                                    $query3 = mysqli_query($conn, $sql3);
                                                    while($row3 = mysqli_fetch_array($query3)){ ?>
                                                    <tr>
                                                        <td><?php echo $row3['Motel_Id']; ?></td>
                                                        <td><?php echo $row3['title']; ?></td>
                                                        <td><?php echo number_format($row3['price'], 0, ",", "."); ?></td>
                                                        <?php if($row3['approve'] == 0): ?>
                                                            <td><span class="badge badge-success">Có sẵn</span></td>
                                                        <?php elseif($row3['approve'] == 1): ?>
                                                            <td><span class="badge badge-danger">Không có sẵn</span></td>
                                                        <?php endif; ?>
                                                        <?php $time = $row3['created_at']; ?>
                                                        <td><?php echo time_diff_string($time, 'now') ." ";
                                                            echo '<span class="badge badge-pill badge-primary">' .$row3['created_at'] ."</span>"; 
                                                            ?>
                                                        </td>
                                                    </tr>
                                                <?php } ?> 
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            }  
                        }
                        mysqli_close($conn); 
                    ?>
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
            $('#dataTableID').DataTable({
                "iDisplayLength": 5,
                "aLengthMenu": [[5, 10, 25, 50, 100, -1], [5, 10, 25, 50, 100, "All"]],
                "language": {
                    "lengthMenu": "Hiển thị _MENU_ bản ghi",
                    "zeroRecords": "Không tìm thấy gì",
                    "info": "Đang hiển thị trang _PAGE_ trên tổng _PAGES_ trang",
                    "infoEmpty": "Không có bản ghi nào có sẵn",
                    "infoFiltered": "(lọc được _MAX_ bản ghi)",
                    "search": "Tìm kiếm:",
                    "paginate": {
                        "first": "First",
                        "last":  "Last",
                        "next":  "Next",
                        "previous": "Previous"
                    }
                }
            }); 
        });
    </script>
</body>
</html>
<?php ob_end_flush(); ?>
