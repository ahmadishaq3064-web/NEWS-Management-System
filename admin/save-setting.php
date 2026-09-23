<?php
include "config.php";
if(isset($_POST['submit'])){
$websitename = mysqli_real_escape_string($conn,$_POST['websitename']);
$footerdesc = mysqli_real_escape_string($conn,$_POST['footerdesc']);

$query_old = "select * from settings limit 1";
$sql_old = mysqli_query($conn,$query_old);

if(empty($_FILES['logo']['name'])){
if(mysqli_num_rows($sql_old) > 0){
$old_row = mysqli_fetch_assoc($sql_old);
$filename = $old_row['logo'];
}else{
$filename = "news-logo.svg";
}
}else{
$errors = [];
$filename = $_FILES['logo']['name'];
$filesize = $_FILES['logo']['size'];
$filetmpname = $_FILES['logo']['tmp_name'];
$ext = explode(".", $filename);
$fileext = strtolower(end($ext));
$extensions = ["jpeg","jpg","png","svg"];
if(in_array($fileext,$extensions) === false){
$errors[] = "this extention file is not allowed , please upload jpeg,png,jpg or svg file ..";
}
if($filesize > 2097152){
$errors[] = "file size must be 2mb or lower";
}
if(empty($errors) === true){
move_uploaded_file($filetmpname,"images/".$filename);
}else{
print_r($errors);
die();
}
}

if(mysqli_num_rows($sql_old) > 0){
$query = "update settings set websitename = '{$websitename}',logo = '{$filename}',footerdesc = '{$footerdesc}'";
}else{
$query = "insert into settings (websitename,logo,footerdesc) values ('{$websitename}','{$filename}','{$footerdesc}')";
}

if(mysqli_query($conn,$query)){
header("location: http://localhost/NEWS-Management-System/admin/setting.php");
exit();
}
}
?>