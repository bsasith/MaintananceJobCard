<?php
include 'connect.php';

session_start();
// this Statement is for closed tab and if opened from new tab with same url
if (isset($_SESSION['userID'])) {

    if ($_SESSION['type'] == 'admin') {
        header('location:.\admin\indexAdminUser.php');
    }
    if ($_SESSION['type'] == 'puser') {
        header('location:.\PUser\indexPUser.php');
    }
    if ($_SESSION['type'] == 'euser' or $_SESSION['type'] == 'muser') {
        header('location:.\EMUser\indexEMUser.php');
    }
  
}


if (isset($_POST['login'])) {

    $user = $_POST['username'];
    $pass = $_POST['password'];


    $sql = "SELECT * FROM users where username = '$user' and password = '$pass'";

    $result = $con->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $_SESSION['LOOGEDIN']= true;
            $_SESSION['userID'] = $row['id'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['type'] = $row['type'];
            $_SESSION['workplace'] = $row['workplace'];

            if ($_SESSION['type'] == 'admin') {
                header('location:.\admin\indexAdminUser.php');
            }
            if ($_SESSION['type'] == 'puser') {
                header('location:.\PUser\indexPUser.php');
            }
            if ($_SESSION['type'] == 'euser' or $_SESSION['type'] == 'muser') {
                header('location:.\EMUser\indexEMUser.php');
            }
          
          //  header('location:.\admin\indexAdminUser.php');
        }

        ?>
        <!-- <script> alert('Welcome <?php echo $_SESSION['username'] ?>'); </script> -->
        <!-- <script>window.location='/MaintananceJobCard/admin/indexAdminUser.php';</script> -->
        <?php


    } else {
        echo "<center><p style=color:red;>Invalid username or password</p></center>";

    }
    $con->close();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        h1 {

            font-family: "Jockey One", sans-serif;
            margin-left: auto;
            margin-right: auto;


        }

        div .headingweb {
            margin-top: 100px;
        }

        div .loginform {
            max-width: fit-content;
            margin-left: auto;
            margin-right: auto;
        }
    </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login to Maintenance Job Card Web</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jockey+One&display=swap" rel="stylesheet">
</head>

<body>
    <div class="container">
        <div class="headingweb">
            <center>
                <div>
                    <img src="logo.jpg" style="height:100px; weight:200px" alt="">
                </div>
                <h1>Maintenance Job Card Web</h1>

            </center>
        </div>

        <div class="loginform">
            <form method="POST">

                <div class="mb-3 ">
                    <label for="exampleInputEmail1" class="form-label">Username</label>
                    <input type="text" class="form-control" name="username" id="exampleInputEmail1"
                        aria-describedby="emailHelp" placeholder="Username">

                </div>
                <div class="mb-3 ">
                    <label for="exampleInputPassword1" class="form-label">Password</label>

                    <input type="password" name="password" class="form-control" id="exampleInputPassword1"
                        placeholder="Password">
                </div>


                <button type="submit" class="btn btn-primary" name="login">Login</button>
            </form>
        </div>
    </div>

</body>

</html>