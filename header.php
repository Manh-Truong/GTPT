<style>
    #sub-header ul li:hover,
    body.home li.home,
    body.contact li.contact {
        background-color: #000;
    }

    #sub-header ul li:hover a,
    body.home li.home a,
    body.contact li.contact a {
        color: #fff;
    }
</style>
<nav class="navbar navbar-default shadow-sm p-3 mb-5 bg-white rounded ">
    <div class="container-fluid ">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">Phòng trọ</a>
        </div>
        <ul class="nav navbar-nav">
            <li class="home"><a href="#">Trang chủ</a></li>
            <li class="content"><a href="#">Trọ thường</a></li>
            <li class="contract"><a href="#">Trọ khép kín</a></li>
        </ul>
        <form method="post" style="margin-top: 8px;">
            <select name="address" id="address" class="form-control" aria-describedby="emailHelp">
                <?php
                include "connect.php";
                $records = mysqli_query($conn, "SELECT DISTINCT address FROM Motel");

                while ($row = mysqli_fetch_array($records)) {
                    echo "<option value='" . $row['address'] . "' selected='selected'>" . $row['address'] . "</option>";
                }
                ?>
            </select>
            <!-- <input type="text" class="form-control"  placeholder="Search" name="address" id="address"> -->
            
            <button type="submit" name="timkiem" class="btn btn-danger">
                <i class="glyphicon glyphicon-search"></i>
            </button>
        </form>
        <ul class="nav navbar-nav navbar-right">
            <li style="display: flex;">
                <img src="<?php echo $_SESSION['Avatar']; ?>" alt="img">
                <a href=""><?php echo $_SESSION["Name"]; ?></a>
            </li>
            <li><a href="./index.php"><span class="glyphicon glyphicon-log-in"></span> Đăng xuất</a></li>
        </ul>
        <p class="navbar-text navbar-right" style="margin-right: 9rem;">
            <?php
            echo date("l") . " - " . date("d/m/Y");
            ?>
        </p>
    </div>
</nav>
<script>
    $(function() {
        // this will get the full URL at the address bar
        var url = window.location.href;

        // passes on every "a" tag 
        $("#sub-header a").each(function() {
            // checks if its the same on the address bar
            if (url == (this.href)) {
                $(this).closest("li").addClass("active");
            }
        });
    });
</script>