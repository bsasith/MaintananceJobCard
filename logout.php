<?php
session_start();
session_destroy();
unset($_SESSION['userID']);
//header('location:/sample/index.php');
header('location:index.php');
exit();
?>