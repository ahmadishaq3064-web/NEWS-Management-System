<?php
session_start();
if(isset($_SESSION['username'])){
header("location: http://localhost/NEWS-Management-System/admin/post.php");
}
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Register</title>
<link rel="icon" type="image/svg+xml" href="images/news-logo.svg">
<link rel="stylesheet" href="css/bootstrap.min.css" />
<link rel="stylesheet" href="css/font-awesome.css">
<link rel="stylesheet" href="css/style.css">
</head>
<body>
<div id="wrapper-admin" class="body-content">
<div class="container">
<div class="row">
<div class="col-md-offset-4 col-md-4">
<img class="logo" src="images/news-logo.svg">
<h3 class="heading">Create Account</h3>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" autocomplete="off">
<div class="form-group"><label>First Name</label><input type="text" name="fname" class="form-control" required></div>
<div class="form-group"><label>Last Name</label><input type="text" name="lname" class="form-control" required></div>
<div class="form-group"><label>Username</label><input type="text" name="username" class="form-control" required></div>
<div class="form-group"><label>Password</label><input type="password" name="password" class="form-control" required></div>
<input type="submit" name="register" class="btn btn-primary" value="Register">
<a href="login.php" class="btn btn-default">Login</a>
</form>
<?php
if(isset($_POST['register'])){
include "config.php";
$first_name = mysqli_real_escape_string($conn,$_POST['fname']);
$last_name = mysqli_real_escape_string($conn,$_POST['lname']);
$username = mysqli_real_escape_string($conn,$_POST['username']);
$password = md5($_POST['password']);
$query = "select username from user where username = '{$username}'";
$sql = mysqli_query($conn,$query);
if(mysqli_num_rows($sql) > 0){
echo "<div class='alert alert-danger'>username already exists</div>";
}else{
$query1 = "insert into user (first_name,last_name,username,password,role) values ('{$first_name}','{$last_name}','{$username}','{$password}',0)";
if(mysqli_query($conn,$query1)){
echo "<div class='alert alert-success'>Registration successful. Please login.</div>";
}else{
echo "<div class='alert alert-danger'>Registration failed.</div>";
}
}
}
?>
</div>
</div>
</div>
</div>
</body>
</html>
