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
<title>Login</title>
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
<h3 class="heading">Login</h3>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
<div class="form-group"><label>Username</label><input type="text" name="username" class="form-control" required></div>
<div class="form-group"><label>Password</label><input type="password" name="password" class="form-control" required></div>
<div class="login">
<input type="submit" name="login" class="btn btn-primary" value="Login">
<a href="index.php" class="btn ">View Website</a>
</div>
<br>
<label>Don't have an account ?</label>
<a href="register.php">Register</a>
</form>
<?php
if(isset($_POST['login'])){
include "config.php";
if(empty($_POST['username']) || empty($_POST['password'])){
echo "<div class='alert alert-danger'>please enter username and password first ..</div>";
}else{
$username = mysqli_real_escape_string($conn,$_POST['username']);
$password = md5($_POST['password']);
$query = "select user_id,username,password,role from user where username = '{$username}' and password = '{$password}'";
$sql = mysqli_query($conn,$query);
if(mysqli_num_rows($sql) > 0){
$rows = mysqli_fetch_assoc($sql);
$_SESSION['username'] = $rows['username'];
$_SESSION['user_id'] = $rows['user_id'];
$_SESSION['role'] = $rows['role'];
header("location: http://localhost/NEWS-Management-System/admin/post.php");
exit();
}else{
echo "<div class='alert alert-danger'>Invalid username or password.</div>";
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
