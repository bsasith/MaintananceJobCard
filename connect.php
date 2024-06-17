<?php
// Connection Configuration
$con = mysqli_connect('localhost', 'root', '', 'maintenancejobcard');
if (!$con) {
    die(mysqli_error("Error",$con));
}
?>