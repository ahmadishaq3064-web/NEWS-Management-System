<?php
include "config.php";
$user_id = $_GET['id'];
$query = "delete from user where user_id = {$user_id}";
if(mysqli_query($conn,$query)){
header("location: http://localhost/NEWS-Management-System/admin/users.php");
}
mysqli_close();
?>