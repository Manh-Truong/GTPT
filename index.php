<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->

    <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/5.0.0/mdb.min.css" rel="stylesheet"/> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <title>Phòng trọ</title>
</head>


<body>
    <section class="vh-100" style="background-color: #9A616D;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-xl-10">
                    <div class="card" style="border-radius: 1rem;">
                        <div class="row g-0">
                            <div class="col-md-6 col-lg-5 d-none d-md-block">
                                <img src="https://xaydungthuanphuoc.com/wp-content/uploads/2022/09/mau-phong-tro-co-gac-lung-dep2028-5.jpg" alt="login form" class="img-fluid h-100 w-100" style="border-radius: 1rem 0 0 1rem;" />
                            </div>
                            <div class="col-md-6 col-lg-7 d-flex align-items-center">
                                <div class="card-body p-4 p-lg-5 text-black">
                                    <form action="index.php" method="POST">
                                        <div class="d-flex align-items-center mb-3 pb-1">
                                            <i class="fas fa-cubes fa-2x me-3" style="color: #ff6219;"></i>
                                            <span class="h1 fw-bold mb-0">Phòng trọ</span>
                                        </div>

                                        <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Đăng nhập</h5>

                                        <div class="form-outline mb-4">
                                            <input class="form-control form-control-lg" type="text" name="Username" require='require' placeholder="Enter username" />

                                        </div>

                                        <div class="form-outline mb-4">
                                            <input type="password" class="form-control form-control-lg" type="password" name="Password" require='require' placeholder="Enter password" />

                                        </div>

                                        <div class="pt-1 mb-4">
                                            <button class="btn btn-dark btn-lg btn-block" type="submit" name="btn_login">Đăng nhập</button>
                                        </div>

                                        <a class="small text-muted" href="register.php">Đăng ký</a>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php
    session_start();
    include 'connect.php';
    if (isset($_POST["btn_login"])) {
        $username = $_POST["Username"];
        $password = $_POST["Password"];

        if ($username == "" || $password == "") {
            echo "<script> alert('Username hoặc password bạn không được để trống!') </script>";
        } else {

            $sql = "SELECT * FROM user u INNER JOIN motel m ON m.user_id = m.user_id INNER JOIN category c
         ON c.category_id = m.category_id WHERE u.Username = '$username' AND u.Password = '$password'";
            $result = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($result);

            if ($count == 0) {
                echo "<script> alert('Tên đăng nhập hoặc mật khẩu không đúng !') </script>";
            } else {
                $_SESSION['Username'] = $username;
                $_SESSION['Password'] = $password;

                $row = mysqli_fetch_array($result);
                $_SESSION['user'] = $row['user_id'];
                $_SESSION['category'] = $row['category_id'];
                $_SESSION['districts'] = $row['district_id'];
                $_SESSION['ROLE'] = $row['Role'];
                $_SESSION['IS_LOGIN'] = 'yes';
                $_SESSION['Name'] = $row['Name'];
                $_SESSION['Email'] = $row['Email'];
                $_SESSION['Phone'] = $row['Phone'];
                $_SESSION['Avatar'] = $row['Avatar'];

                if ($row['Role'] == 1) {
                    header('location: view.php');
                    die();
                }
                if($row['Role'] == 0){
                    header('location: view.php');
                    die();
                } 
            }
        }
    }

    ?>
</body>

</html>