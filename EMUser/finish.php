<?php
include '../connect.php';
include '../session.php';
//This validates user type
if (!($_SESSION['type']=='euser'))
{
    header('location:..\login.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Finish job</h1>
</body>
</html>