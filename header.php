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
}else{
$page_title = "NEWS SITE";
}
break;

case "category.php":
if(isset($_GET['cid'])){
$query_title = "select * from category where category_id = {$_GET['cid']}";
$sql_title = mysqli_query($conn,$query_title);
$row_title = mysqli_fetch_assoc($sql_title);
$page_title = $row_title['category_name'];
}else{
$page_title = "NEWS SITE";
}
break;

case "author.php":
if(isset($_GET['aid'])){
$query_title = "select * from user where user_id = {$_GET['aid']}";
$sql_title = mysqli_query($conn,$query_title);
$row_title = mysqli_fetch_assoc($sql_title);
$page_title = $row_title['first_name'] . " " . $row_title['last_name'];
}else{
$page_title = "NEWS SITE";
}
break;

case "search.php":
if(isset($_GET['search'])){
$page_title = $_GET['search'];
}else{
$page_title = "NEWS SITE";
}
break;

default:
$page_title = "NEWS SITE";
break;
}

$websitename = "NEWS SITE";
$weblogo = "";
$query_settings = "select * from settings limit 1";
$sql_settings = mysqli_query($conn,$query_settings);
if($sql_settings && mysqli_num_rows($sql_settings) > 0){
$settings = mysqli_fetch_assoc($sql_settings);
$websitename = $settings['websitename'];
$weblogo = $settings['logo'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $page_title; ?></title>
    <link rel="icon" type="image/svg+xml" href="images/news-logo.svg">
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/font-awesome.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div id="header">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <?php
                if($weblogo == ""){
                    echo '<a href="index.php"><h1>'.$websitename.'</h1></a>';
                }else{
                    echo '<a href="index.php" id="logo"><img src="admin/images/'.$weblogo.'" alt="'.$websitename.'"></a>';
                    echo '<div style="margin-top:5px;color:white;"><strong>'.$websitename.'</strong></div>';
                }
                ?>
            </div>
            <div class="col-md-8 text-right" style="padding-top:25px;">
                <?php
                session_start();
                if(isset($_SESSION['username'])){
                    echo '<a class="btn btn-primary" href="admin/post.php">Back to Dashboard</a> ';
                    echo '<a class="btn btn-danger" href="admin/logout.php">Logout</a>';
                }else{
                    echo '<a class="btn btn-primary" href="login.php">Login</a> ';
                    echo '<a class="btn btn-success" href="register.php">Register</a>';
                }
                ?>
            </div>
        </div>
    </div>
</div>

<div id="menu-bar">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php
                if(isset($_GET['cid'])){
                    $cat_id = $_GET['cid'];
                }
                $query = "select * from category where post > 0";
                $sql = mysqli_query($conn,$query);
                if(mysqli_num_rows($sql) > 0){
                    $active = "";
                    echo "<ul class='menu'>";
                    echo "<li><a href='index.php'>HOME</a></li>";
                    while($rows = mysqli_fetch_assoc($sql)){
                        if(isset($_GET['cid'])){
                            if($rows['category_id'] == $cat_id){
                                $active = "active";
                            }else{
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
