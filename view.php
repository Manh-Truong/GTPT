<?php session_start(); ?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/header.css">
    <link rel="stylesheet" href="./js/header.js">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css"> -->
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> -->
    <title>Danh sách phòng trọ</title>
    <style>
        .form-control-search {
            display: block;
            width: 92%;
            height: 100%;
            padding: 0.375rem 1.75rem;
            font-size: 15px;
            font-weight: 400;
            line-height: 1.5;
            color: #495057;

            border: 1px solid #ced4da;

        }

        .motel {
            padding-right: 70px;
            height: 265px;
            background-color: lightgoldenrodyellow;
            margin: 0px 0px 20px 0px;
        }

        form {
            display: inline-flex;
            padding-left: 20px;
        }

        button.btn.btn-danger,
        button.btn.btn-success {
            margin-left: 30px;
            height: 33px;
        }

        .price p {
            font-size: 18px;
        }

        .price #price2,
        .price #price1 {
            margin-left: 10px;
        }

        .find h4 {
            font-weight: bold;
        }

        .address,
        .price {
            display: inline-flex;
        }

        .address p,
        .price p {
            padding-top: 7px;
            font-size: 17px;
        }
    </style>
</head>

<body>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/2.1.3/TweenMax.min.js"></script>
    <!-- ============================ PHẦN HEADER =========================== -->
    <div>
        <?php include "./header.php"; ?>
    </div>

    <!-- Phần này là phần hiển thị theo bảng giá và địa chỉ phòng trọ -->
    <!-- <div class="container find" style="padding-top: 30px; padding-left: 30px;background: #fc8415; color: #fff;width: 100%;">
        
        <h4>Tìm kiếm theo</h4>

        <div class="address">
            <p>Địa điểm:</p>
            <form method="post">
                <select name="address" id="address" class="form-control">
                    <option disabled selected>-- Chọn địa chỉ --</option>
                    <?php
                    include "connect.php";
                    $records = mysqli_query($conn, "SELECT DISTINCT address FROM Motel");

                    while ($row = mysqli_fetch_array($records)) {
                        echo "<option value='" . $row['address'] . "' selected='selected'>" . $row['address'] . "</option>";
                    }
                    ?>
                </select>
                <button type="submit" name="timkiem" class="btn btn-danger">Tìm kiếm</button>
            </form>
        </div>

        <div class="price" style="margin-top: 20px;">
            <p>Khoảng giá:</p>
            <form method="post">
                <div style="display: inline-flex;" class="price">
                    <p> Từ </p>
                    <select name="price1" id="price1" class="form-control" style="width: 120px;">
                        <option disabled selected>-- Chọn giá --</option>
                        <?php
                        include "connect.php";
                        $records = mysqli_query($conn, "SELECT DISTINCT price FROM Motel");

                        while ($row = mysqli_fetch_array($records)) {
                            echo "<option value='" . $row['price'] . "' selected='selected'>" . number_format($row['price'], 0, ",", ".") . "</option>";
                        }
                        ?>
                    </select>

                    <p style="margin-left: 10px;"> đến </p>
                    <select name="price2" id="price2" class="form-control" style="width: 120px;">
                        <option disabled selected>-- Chọn giá --</option>
                        <?php
                        include "connect.php";
                        $records = mysqli_query($conn, "SELECT DISTINCT price FROM Motel");

                        while ($row = mysqli_fetch_array($records)) {
                            echo "<option value='" . $row['price'] . "' selected='selected'>" . number_format($row['price'], 0, ",", ".") . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <button type="submit" name="timkiem-price" class="btn btn-success">Tìm kiếm</button>
            </form>
        </div>
        <div style="margin-top: 30px;">
            <a href="./index.php">Đăng xuất</a>
        </div>
    </div> -->

    <!-- ============================ KẾT QUẢ TÌM KIẾM THEO ĐỊA ĐIỂM =========================== -->
    <div class="container" style="margin-top: 30px;">

        <?php
        if (isset($_POST['timkiem'])) {
            $addr = $_POST['address'];
            $records = mysqli_query($conn, "SELECT * FROM Motel m INNER JOIN user u ON m.user_id = u.user_id WHERE address LIKE '%$addr%'");
            while ($row = mysqli_fetch_array($records)) {
        ?>

                <div class="col-xs-12 col-md-6">
                    <div class="motel row">
                        <div class="col-md-5 col-sm-12 col-xs-12" style="margin-top: 20px;">
                            <div>
                                <a href="details.php?Motel_Id=<?php echo $row['Motel_Id']; ?>" style="text-decoration: none;">
                                    <img src="photo/<?php echo $row['images']; ?>" class="img-responsive" style="height: 200px;"></a>
                            </div>
                        </div>
                        <div class="col-md-7 col-sm-12 col-xs-12">
                            <div>
                                <h5>
                                    <a href="details.php?Motel_Id=<?php echo $row['Motel_Id']; ?>" style="text-decoration: none;">
                                        <h3><?php echo $row['title']; ?></h3>
                                    </a>
                                </h5>
                            </div>
                            <div style="display: inline-block; width: 500px;">
                                <div style="width: 220px; float: left;">
                                    <p><i class="fa fa-user"></i> Người đăng: <?php echo $row['Name']; ?></p>
                                    <p><i class="fa fa-area-chart"></i> Diện tích: <?php echo $row['area']; ?> m<sup>2</sup></p>
                                    <p><i class="fa fa-map-marker"></i> Địa chỉ: <?php echo $row['address']; ?></p>
                                    <p><i class="fa fa-dollar"></i> Giá: <?php echo number_format($row['price'], 0, ",", "."); ?></p>
                                </div>
                                <div style="width: 280px; float: right;">
                                    <p><i class="fa fa-eye"></i> Lượt xem: <?php echo $row['count_view']; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

        <?php
            }
        }
        ?>
    </div>


    <!-- ============================ KẾT QUẢ TÌM KIẾM THEO KHOẢNG GIÁ =========================== -->
    <div class="container" style="margin-top: 30px;">

        <?php
        if (isset($_POST['price1']) && isset($_POST['price2'])) {
            $price1 = $_POST['price1'];
            $price2 = $_POST['price2'];
            $records = mysqli_query($conn, "SELECT * FROM Motel m INNER JOIN user u ON m.user_id = u.user_id WHERE price BETWEEN $price1 AND $price2");
            while ($row = mysqli_fetch_array($records)) {

        ?>

                <div class="col-xs-12 col-md-6">
                    <div class="motel row">
                        <div class="col-md-5 col-sm-12 col-xs-12" style="margin-top: 20px;">
                            <div>
                                <a href="details.php?Motel_Id=<?php echo $row['Motel_Id']; ?>" style="text-decoration: none;"><img src="photo/<?php echo $row['images']; ?>" class="img-responsive" style="height: 200px;"></a>
                            </div>
                        </div>
                        <div class="col-md-7 col-sm-12 col-xs-12">
                            <div>
                                <h5>
                                    <a href="details.php?Motel_Id=<?php echo $row['Motel_Id']; ?>" style="text-decoration: none;">
                                        <h3><?php echo $row['title']; ?></h3>
                                    </a>
                                </h5>
                            </div>
                            <div style="display: inline-block; width: 500px;">
                                <div style="width: 220px; float: left;">
                                    <p><i class="fa fa-user"></i> Người đăng: <?php echo $row['Name']; ?></p>
                                    <p><i class="fa fa-area-chart"></i> Diện tích: <?php echo $row['area']; ?> m<sup>2</sup></p>
                                    <p><i class="fa fa-map-marker"></i> Địa chỉ: <?php echo $row['address']; ?></p>
                                    <p><i class="fa fa-dollar"></i> Giá: <?php echo number_format($row['price'], 0, ",", "."); ?></p>
                                </div>
                                <div style="width: 280px; float: right;">
                                    <p><i class="fa fa-eye"></i> Lượt xem: <?php echo $row['count_view']; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

        <?php
            }
        }
        ?>
    </div>


    <!-- ============================ PHÒNG TRỌ MỚI ĐĂNG NHẤT =========================== -->
    <div class="container" style="margin-top: 10px;">
        <h4 style="margin-left: 12px; font-size: 2rem;"> PHÒNG TRỌ MỚI ĐĂNG NHẤT</h4>

        <?php
        include("connect.php");

        $per_page_record = 4;
        if (isset($_GET["page"])) {
            $page  = $_GET["page"];
        } else {
            $page = 1;
        }
        $start_from = ($page - 1) * $per_page_record;

        $query = "SELECT * FROM Motel m INNER JOIN user u ON m.user_id = u.user_id order by created_at desc LIMIT $start_from, $per_page_record";
        $values = mysqli_query($conn, $query);
        while ($row = mysqli_fetch_array($values)) {
        ?>

            <div class="col-xs-12 col-md-6">
                <div class="motel row">
                    <div class="col-md-5 col-sm-12 col-xs-12" style="margin-top: 20px;">
                        <div>
                            <a href="details.php?Motel_Id=<?php echo $row['Motel_Id']; ?>" style="text-decoration: none;"><img src="photo/<?php echo $row['images']; ?>" class="img-responsive" style="height: 200px;"></a>
                        </div>
                    </div>
                    <div class="col-md-7 col-sm-12 col-xs-12 " style="margin-top: 40px;">
                        <div>
                            <h5>
                                <a href="details.php?Motel_Id=<?php echo $row['Motel_Id']; ?>" style="text-decoration: none;">
                                    <h3><?php echo $row['title']; ?></h3>
                                </a>
                            </h5>
                        </div>
                        <div style="display: inline-block; width: 500px;">
                            <div style="width: 220px; float: left;">
                                <p><i class="fa fa-user"></i> Người đăng: <?php echo $row['Name']; ?></p>
                                <p><i class="fa fa-area-chart"></i> Diện tích: <?php echo $row['area']; ?> m2</p>
                                <p><i class="fa fa-map-marker"></i> Địa chỉ: <?php echo $row['address']; ?></p>
                                <p><i class="fa fa-dollar"></i> Giá: <?php echo number_format($row['price'], 0, ",", "."); ?></p>
                            </div>
                            <div style="width: 280px; float: right;">
                                <p><i class="fa fa-eye"></i> Lượt xem: <?php echo $row['count_view']; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <?php
        }
        ?>
    </div>
    <?php include("pagination.php"); ?>


    <!-- ============================ PHÒNG TRỌ XEM NHIỀU NHẤT =========================== -->
    <div class="container" style="margin-top: 70px;">
        <h4 style="margin-left: 12px; font-size: 2rem;"> PHÒNG TRỌ XEM NHIỀU NHẤT</h4>

        <?php
        include("connect.php");

        $per_page_record = 4;
        if (isset($_GET["page"])) {
            $page  = $_GET["page"];
        } else {
            $page = 1;
        }
        $start_from = ($page - 1) * $per_page_record;

        $query = "SELECT * FROM Motel m INNER JOIN user u ON m.user_id = u.user_id order by count_view desc LIMIT $start_from, $per_page_record";
        $values = mysqli_query($conn, $query);
        while ($row = mysqli_fetch_array($values)) {
        ?>

            <div class="col-xs-12 col-md-6">
                <div class="motel row">
                    <div class="col-md-5 col-sm-12 col-xs-12" style="margin-top: 20px;">
                        <div>
                            <a href="details.php?Motel_Id=<?php echo $row['Motel_Id']; ?>" style="text-decoration: none;"><img src="photo/<?php echo $row['images']; ?>" class="img-responsive" style="height: 200px;"></a>
                        </div>
                    </div>
                    <div class="col-md-7 col-sm-12 col-xs-12" style="margin-top: 40px">
                        <div>
                            <h5>
                                <a href="details.php?Motel_Id=<?php echo $row['Motel_Id']; ?>" style="text-decoration: none;">
                                    <h3><?php echo $row['title']; ?></h3>
                                </a>
                            </h5>
                        </div>
                        <div style="display: inline-block; width: 500px;">
                            <div style="width: 220px; float: left;">
                                <p><i class="fa fa-user"></i> Người đăng: <?php echo $row['Name']; ?></p>
                                <p><i class="fa fa-area-chart"></i> Diện tích: <?php echo $row['area']; ?> m2</p>
                                <p><i class="fa fa-map-marker"></i> Địa chỉ: <?php echo $row['address']; ?></p>
                                <p><i class="fa fa-dollar"></i> Giá: <?php echo number_format($row['price'], 0, ",", "."); ?></p>
                            </div>
                            <div style="width: 280px; float: right;">
                                <p><i class="fa fa-eye"></i> Lượt xem: <?php echo $row['count_view']; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>
    </div>
    <div>
        <?php include("pagination.php"); ?>
    </div>

    <div style="display: block">
        <?php include("./footer.php") ?>
    </div>
</body>

</html>