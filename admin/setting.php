<?php include "header.php";
if($_SESSION['role'] == '0'){
header("location: http://localhost/NEWS-Management-System/admin/post.php");
}
include "config.php";
$query = "select * from settings limit 1";
$sql = mysqli_query($conn,$query);
if(mysqli_num_rows($sql) > 0){
$rows = mysqli_fetch_assoc($sql);
}else{
$rows = array("websitename" => "NEWS SITE","logo" => "news-logo.svg","footerdesc" => "");
}
?>
<div id="admin-content">
<div class="container">
<div class="row">
<div class="col-md-12"><h1 class="admin-heading">Website Settings</h1></div>
<div class="col-md-offset-4 col-md-4">
<form action="save-setting.php" method="POST" enctype="multipart/form-data">
<div class="form-group">
<label>Website Name</label>
<input type="text" name="websitename" class="form-control" value="<?php echo $rows['websitename']; ?>" required>
</div>
<div class="form-group">
<label for="logo">Website logo</label>
<input type="file" name="logo">
<?php if($rows['logo'] != ""){ ?>
<img src="images/<?php echo $rows['logo']; ?>" style="max-width:150px; margin-top:10px;">
<?php } ?>
<input type="hidden" name="old-image" value="<?php echo $rows['logo']; ?>">
</div>
<div class="form-group">
<label>Footer description</label>
<input type="text" name="footerdesc" class="form-control" value="<?php echo $rows['footerdesc']; ?>" required>
</div>
<input type="submit" name="submit" class="btn btn-primary" value="SAVE">
</form>
</div>
</div>
</div>
</div>
<?php include "footer.php"; ?>