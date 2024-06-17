<?php
include '../connect.php';
include '../session.php';
if (!($_SESSION['type']=='admin'))
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
    <h1>Admin User</h1>
</body>
</html>