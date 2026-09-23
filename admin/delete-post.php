<?php
include "config.php";
$post_id = $_GET['id'];
$cat_id = $_GET['cat_id'];

$query1 = "select * from post where post_id = {$post_id}";
$sql1 = mysqli_query($conn,$query1);
$row = mysqli_fetch_assoc($sql1);

unlink("upload/".$row['post_img']);

$query = "delete from post where post_id = {$post_id};";
$query .= "update category set post = post-1 where category_id = {$cat_id}";

if(mysqli_multi_query($conn,$query) > 0){
header("location: http://localhost/NEWS-Management-System/admin/post.php");
}
?>