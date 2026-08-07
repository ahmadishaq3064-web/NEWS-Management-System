<?php 
include "config.php";
if(empty($_FILES['new-image']['name'])){
$new_name = $_POST['old-image'];
}
else
{
$errors = [];
$filename = $_FILES['new-image']['name'];
$filesize = $_FILES['new-image']['size'];
$filetmpname = $_FILES['new-image']['tmp_name'];
$filetype = $_FILES['new-image']['type'];
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
}
$query = "update post set title = '{$_POST['post_title']}',description = '{$_POST['postdesc']}',category = {$_POST['category']},post_img = '{$new_name}' where post_id = {$_POST['post_id']};";
if($_POST['category'] != $_POST['old-category']){
$query .= "update category set post = post+1 where category_id = {$_POST['category']};";
$query .= "update category set post = post-1 where category_id = {$_POST['old-category']};";
}
if(mysqli_multi_query($conn,$query)){
header("location: http://localhost/news-110-124/admin/post.php");
}

?>