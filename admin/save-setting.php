<?php 
include "config.php";
if(empty($_FILES['logo']['name'])){
$filename = $_POST['old-image'];
}
else
{
$errors = [];
$filename = $_FILES['logo']['name'];
$filesize = $_FILES['logo']['size'];
$filetmpname = $_FILES['logo']['tmp_name'];
$filetype = $_FILES['logo']['type'];
$ext = explode(".", $filename);
$fileext = strtolower(end($ext));
$extensions = ["jpeg","jpg","png"];
if(in_array($fileext,$extensions) === false){
$errors[] = "this extention file is not allowed , please upload jpeg,png or jpg file ..";
}
if($filesize > 2097152){
$errors[] = "file size must be 2mb or lower";
}
if(empty($errors) === true){
move_uploaded_file($filetmpname,"images/".$filename);
}
else{
print_r($errors);
die();
}
}
$query = "update settings set websitename = '{$_POST['websitename']}',logo = '{$filename}',footerdesc = '{$_POST['footerdesc']}'";
if(mysqli_query($conn,$query) > 0){
header("location: http://localhost/news-110-124/admin/setting.php");
}

?>