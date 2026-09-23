<?php 
session_start();
session_unset();
session_destroy();
header("location: http://localhost/NEWS-Management-System/login.php");
?>
