<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Chi tiết phòng trọ</title>
</head>
<body>
    <div class="container" style="margin-top: 50px;">
        <div class="row" style="padding-left: 10px;">
            <div class="col-md-10" style="background: lightgoldenrodyellow;">
                <div class="row">
                    <div class="col-md-6">
                        <div>
                            
                        <?php
                            $Motel_Id = $_GET['Motel_Id'];
                            include("connect.php"); 
                            $values = mysqli_query($conn,"select * from Motel m INNER JOIN user u ON m.user_id = u.user_id where Motel_Id='$Motel_Id'"); 
                            $row = mysqli_fetch_array($values);
                        ?>

                            <div>
                                <div class="carousel-indicators">
                                    <img src="photo/<?php echo $row['images']; ?>" class="d-block w-100" style="height: 300px;">
                                </div>
                            </div>
                            
                        </div>
                    </div>

                    <div class="col-md-6" style="margin-top: 20px; padding-left: 50px; color: black;">
                        <h4><?php echo $row['title']; ?></h4>
                        <div>
                            </br>
                            <p><i class="fa fa-user"></i> Người đăng: <?php echo $row['Name']; ?></p>
                            <p><i class="fa fa-eye"></i> Lượt xem: <?php echo $row['count_view']; ?></p>
                        </div>
                        <hr>
                        <div>
                            <p><i class="fa fa-area-chart"></i> Diện tích: <?php echo $row['area']; ?> m2</p>
                            <p><i class="fa fa-map-marker"></i> Địa chỉ: <?php echo $row['address']; ?></p>
                            <p><i class="fa fa-dollar"></i> Giá: <?php echo number_format($row['price'], 0, ",", "."); ?></p>
                        </div>
                        
                    </div>
                </div>        
            </div>    
        </div>

        <div class="container">
            <div class="row">
                <ul class="nav nav-tabs">
                    <li class="nav-item" role="presentation">
                        <a href="#!" class="nav-link active" data-bs-target="#description" type="button" aria-controls="description" aria-selected="true">Mô tả</a>
                    </li>
                </ul>

                    <div class="tab-content" style="color: black; margin-top: 20px;">
                        <div class="tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="description-tab">
                            <p><?php echo $row['description']; ?></p>
                        </div>
                    </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function(){
          $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
</body>

</html>