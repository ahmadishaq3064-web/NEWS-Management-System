<?php
include "config.php";
$cat_id = $_GET['id'];
$query = "delete from category where category_id = {$cat_id}";
if(mysqli_query($conn,$query)){
header("location: http://localhost/news-110-124/admin/category.php");
}
mysqli_close();
?>