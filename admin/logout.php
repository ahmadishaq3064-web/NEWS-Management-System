<?php 
session_start();
session_unset();
session_destroy();
header("location: http://localhost/news-110-124/admin/");
?>
