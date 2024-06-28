<?php
include 'connect.php';
include 'session.php';

if (!(($_SESSION['type'] == 'puser') or ($_SESSION['type'] == 'muser') or ($_SESSION['type'] == 'euser'))) {
    header('location:..\index.php');
}
//fetch data from database

$idu = $_SESSION['userID'];

$sql = "Select * from users where id='$idu'";

$result = mysqli_query($con, $sql);

$row = mysqli_fetch_assoc($result);

$id = $row['id'];
$username = $row['username'];
$password = $row['password'];



//submit data
if (isset($_POST['submit'])) {

    $username = $_POST['username'];
    $oldpassword = $_POST['oldpassword'];
    $newpassword1 = $_POST['newpassword1'];
    $newpassword2 = $_POST['newpassword2'];

    if ($newpassword1 == $newpassword2 and $oldpassword == $password) {
        $insert = "update users set password='$newpassword1' where id=$id";

        if ($con->query($insert) == TRUE) {
            $_SESSION['ChangePassword'] = true;

            echo "<div class='alert alert-success' role='alert'>
   <strong>Password Change Successful</strong> 
</div>";
            header( 'refresh:2; .\login.php');


        } else {

            echo mysqli_error($con);
            //  header('location:location:..\PUser\indexPUser.php');
        }
        //$insert->close();
    } else {
        echo "
        <div class='alert alert-danger' role='alert'>
  <strong>Password Does not match.</strong> Please try again.
</div>
    ";
    }
}





?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jockey+One&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="\MaintananceJobCard\styles\SubmitJobstyle.css">

    <style>
        h1 {
            font-family: "Jockey One", sans-serif;
        }
    </style>
</head>

<body>
    <div class="topbar">
        <h1 class="topbar-text">Welcome <?php echo $_SESSION['workplace'] ?> User</h1>

        <a href="\MaintananceJobCard\logout.php">
            <h1 class="topbar-logout">Logout &nbsp</h1>
        </a>
        <h1 class="topbar-username"><?php echo $_SESSION['username'] ?>&nbsp</h1>

    </div>
    <div class="container mt-5 ">
        <h1> Change Account info</h1>
        <div class="mt-3">
            <form method="POST">
                <table>
                    <div class="form-group">
                        <!-- Row of input fields -->
                        <tr>

                            <td style="width:200px;padding:5px">
                                <label class="pr-3">Username</label>
                            </td>
                            <td style="width:500px;padding:5px">
                                <input type="text" name="username" class="form-control" value="<?php echo $username ?>"
                                    required readonly>
                            </td>

                        </tr>
                        <!-- Row of input fields -->
                        <!-- Row of input fields -->
                        <tr>

                            <td style="width:200px;padding:5px">
                                <label class="pr-3">Old password</label>
                            </td>
                            <td style="width:500px;padding:5px">
                                <input type="password" name="oldpassword" class="form-control" required>
                            </td>

                        </tr>
                        <!-- Row of input fields -->
                        <tr>

                            <td style="width:200px;padding:5px">
                                <label class="pr-3">New Password</label>
                            </td>
                            <td style="width:500px;padding:5px">
                                <input type="password" name="newpassword1" class="form-control" required>
                            </td>

                        </tr>
                        <!-- Row of input fields -->
                        <tr>

                            <td style="width:200px;padding:5px">
                                <label class="pr-3">Re-enter new Password</label>
                            </td>
                            <td style="width:500px;padding:5px">
                                <input type="password" name="newpassword2" class="form-control" required>
                            </td>

                        </tr>
                        <!-- Row of input fields -->
                        <tr>

                            <td style="width:200px;padding:5px">
                                <label class="pr-3"></label>
                            </td>
                            <td style="width:500px;padding:5px">
                                <button type="submit" class="btn btn-primary mt-3" name="submit">Update</button>
                                <button type="back" class="btn btn-danger mt-3" name="back"><a
                                        href="\MaintananceJobCard\PUser\indexPUser.php"
                                        style="text-decoration:none;color:white">Back to Main</a></button>
                            </td>

                        </tr>
                    </div>
        </div>
        </table>

        </form>
    </div>
    </div>



</body>
</body>