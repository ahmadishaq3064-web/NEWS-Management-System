<?php 
include "config.php";
if(isset($_FILES['fileToUpload'])){
$errors = [];
$filename = $_FILES['fileToUpload']['name'];
$filesize = $_FILES['fileToUpload']['size'];
$filetmpname = $_FILES['fileToUpload']['tmp_name'];
$filetype = $_FILES['fileToUpload']['type'];
$ext = explode(".", $filename);
$fileext = strtolower(end($ext));
$extensions = ["jpeg","jpg","png"];
$create_name = time() . "-" . $filename;
$new_name = $create_name;
if(in_array($fileext,$extensions) === false){
$errors[] = "this extention file is not allowed , please upload jpeg,png or jpg file ..";
}
if($filesize > 2097152){
$errors[] = "file size must be 2mb or lower";
}
if(empty($errors) === true){
move_uploaded_file($filetmpname,"upload/".$new_name);
}
else{
print_r($errors);
die();
}
session_start();
$post_title = mysqli_real_escape_string($conn,$_POST['post_title']);
$postdesc = mysqli_real_escape_string($conn,$_POST['postdesc']);
$category = mysqli_real_escape_string($conn,$_POST['category']);
$date = date("d M, Y");
$author = $_SESSION['user_id'];
$query = "insert into post(title,description,category,post_date,author,post_img) values('{$post_title}','{$postdesc}',{$category},'{$date}',{$author},'{$new_name}');";
$query .= "update category set post = post + 1 where category_id = {$category};";
if(mysqli_multi_query($conn,$query) > 0){
header("location: http://localhost/news-110-124/admin/post.php");
}
}
?>