<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Phân trang</title>

    <style>
    .pagination {   
        display: inline-block;   
        float: right; 
        margin-right: 120px;
    }   
    .pagination a {      
        font-size:18px;   
        color: black;   
        float: left;   
        padding: 0px 10px;   
        text-decoration: none;   
        border: 1px solid gray;   
    }   
    .pagination a:hover {   
        background-color: skyblue;   
    }  
    .pagination strong a {   
        background-color: orange;   
    }
  
</style>
</head>
<body>

    <div class="pagination">    
        <?php  
            // $query = "SELECT COUNT(*) FROM Motel";   
            $query = "SELECT COUNT(Motel_Id) as Motel_Id FROM Motel";   
            $rs_result = mysqli_query($conn, $query);     
            // $row = mysqli_fetch_row($rs_result);     
            // $total_records = $row[0];
            $row = mysqli_fetch_assoc($rs_result);        
            $total_records = $row['Motel_Id'];  
            
            echo "</br>";       
            $total_pages = ceil($total_records / $per_page_record);     
            $pageLink = "";       
        
            if($page >= 2){   
                echo "<a href='view.php?page=".($page-1)."'> Prev </a>";   
            }                  
            for ($i = 1; $i <= $total_pages; $i++) {   
            if ($page == $i) {   
                $pageLink .= "<strong><a href='view.php?page=".$i."'> ".$i." </a></strong>";   
            }               
            else  {   
                $pageLink .= "<a href='view.php?page=".$i."'> ".$i." </a>";     
            }   
            };     
            echo $pageLink;   
    
            if($page < $total_pages){   
                echo "<a href='view.php?page=".($page+1)."'> Next </a>";   
            }   
        ?>    
    </div>  

</body>
</html>
