<?php
include "config.php";
$page = basename($_SERVER['PHP_SELF']);
switch($page){

case "single.php":
if(isset($_GET['id'])){
$query_title = "select * from post where post_id = {$_GET['id']}";
$sql_title = mysqli_query($conn,$query_title);
$row_title = mysqli_fetch_assoc($sql_title); 
$page_title = $row_title['title'];
}
else{
echo $row_title = " ";
}
break;

case "category.php":
if(isset($_GET['cid'])){
$query_title = "select * from category where category_id = {$_GET['cid']}";
$sql_title = mysqli_query($conn,$query_title);
$row_title = mysqli_fetch_assoc($sql_title); 
$page_title = $row_title['category_name'];
}
else{
echo $row_title = " ";
}
break;
case "author.php";
if(isset($_GET['aid'])){
$query_title = "select * from user where user_id = {$_GET['aid']}";
$sql_title = mysqli_query($conn,$query_title);
$row_title = mysqli_fetch_assoc($sql_title); 
$page_title = $row_title['first_name'] . " " . $row_title['last_name'];
}
else{
echo $row_title = " ";
}
break;

case "search.php":
if(isset($_GET['search'])){
$page_title = $_GET['search']; 
}
else{
echo $page_title = " ";
}
break;
default:
$page_title = "NEWS SITE";
break;

} 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title><?php echo $page_title;?></title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="css/font-awesome.css">
    <!-- Custom stlylesheet -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<!-- HEADER -->
<div id="header">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <!-- LOGO -->
            <div class=" col-md-offset-4 col-md-4">
             <?php 
            include "config.php";
            $query = "select * from settings";
            $sql = mysqli_query($conn,$query);
            if(mysqli_num_rows($sql) > 0){   
            while($rows = mysqli_fetch_assoc($sql)){
            if($rows['logo'] == ""){
            echo '<a href="index.php"><h1>'.$rows['websitename'].'</h1></a>';     
            }
            else{
            echo '<a href="index.php" id="logo"><img src="admin/images/'.$rows['logo'].'"></a>';   
            }
            }}
            ?>
            </div>
            <!-- /LOGO -->
        </div>
    </div>
</div>
<!-- /HEADER -->
<!-- Menu Bar -->
<div id="menu-bar">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php 
                include "config.php";
                // agar value set hai url me to isko variable me store kr ly taky hum neechy menu ko active krny ky liye use kr sakein
                if(isset($_GET['cid'])){
                $cat_id = $_GET['cid'];    
                }
                $query = "select * from category where post > 0";
                $sql = mysqli_query($conn,$query);
                if(mysqli_num_rows($sql) > 0){
                $active = "";
                echo "<ul class='menu'>";  
                echo "<li><a href='http://localhost/news-110-124/index.php'>HOME</a></li>";  
                while($rows = mysqli_fetch_assoc($sql)){  
                if(isset($_GET['cid'])){
                if($rows['category_id'] == $cat_id){
                $active = "active";
                }
                else{
                $active = "";
                } 
                }     
                echo "<li><a class='{$active}' href='category.php?cid={$rows['category_id']}'>{$rows['category_name']}</a></li>";
                }
                echo "</ul>";
                } 
                ?>
            </div>
        </div>
    </div>
    
</div>
<!-- /Menu Bar -->
