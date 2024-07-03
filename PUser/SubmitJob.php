<?php
include '../connect.php';
include '../session.php';

date_default_timezone_set('Asia/Colombo');
$date = date("Y-m-d G:i:s");
if (!($_SESSION['type'] == 'puser')) {
    header('location:..\index.php');
}

if (isset($_POST['submit'])) {

    $JobCodeNo = $_POST['JobCodeNo'];
    $JobIssuingDivision = $_POST['JobIssuingDivision'];
    $MachineName = $_POST['MachineName'];
    $priority = $_POST['priority'];
    $ReportTo = $_POST['ReportTo'];
    $BriefDescription = $_POST['BriefDescription'];
    $username = $_SESSION['username'];
    $JobStatusE = null;
    $JobStatusM = null;
   // echo $ReportTo;
    if($ReportTo=='Both'){
        $JobStatusE = 'Pending';
        $JobStatusM = 'Pending';
      }elseif($ReportTo=='Electrical'){
        $JobStatusE = 'Pending';
        $JobStatusM = 'NA';
      }
    elseif($ReportTo=='Mechanical'){
        $JobStatusE = 'NA';
        $JobStatusM = 'Pending';
      }
 //echo $JobStatusE;
 //echo $JobStatusM;
    $_SESSION['SubmitJobSucess']=true;

    $insert = "insert into jobdatasheet (JobCodeNo,JobPostingDateTime,JobPostingDev,MachineName,Priority,ReportTo,BDescription,Username,JobStatusE,JobStatusM) values 
    ('$JobCodeNo','$date','$JobIssuingDivision','$MachineName','$priority','$ReportTo','$BriefDescription','$username','$JobStatusE','$JobStatusM')";

    if ($con->query($insert) == TRUE) {
        $_SESSION['SubmitJobSucess']=true;
        // echo "Sucessfully add data";
        // echo $ReportTo;
        // echo $JobStatusE;
        // echo $JobStatusM;
     header('location:..\PUser\SubmitJobSuccess.php');
   
    } else {

        echo mysqli_error($con);
      //  header('location:location:..\PUser\indexPUser.php');
    }
    //$insert->close();
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

<body onload="eee();divSelect()">
    <div class="topbar">
        <h1 class="topbar-text">Welcome <?php echo $_SESSION['workplace']?> User</h1>

        <a href="\MaintananceJobCard\logout.php">
            <h1 class="topbar-logout">Logout &nbsp</h1>
        </a>
        <h1 class="topbar-username"><?php echo $_SESSION['username'] ?>&nbsp</h1>

    </div>
    <div class="container mt-5 ">
        <h1> Job Submit Form</h1>
        <div class="mt-3">
            <form method="POST">
                <table>
                    <div class="form-group">
                        <tr>

                            <td style="width:200px;padding:5px">
                                <label class="pr-3">Job code No</label>
                            </td>
                            <td style="width:500px;padding:5px">
                                <input type="text" name="JobCodeNo" class="form-control" id="JobCodeNo" readonly required>
                            </td>

                        </tr>

                        <!-- Row of input fields -->
                        <tr>

                            <td style="width:200px;padding:5px">
                                <label class="pr-3">Job Issuing Division</label>
                            </td>
                            <td style="width:500px;padding:5px">
                                <select name="JobIssuingDivision" id="dept" onchange='divSelect()' class="form-select"
                                    required  >
                                    <?php if($_SESSION['workplace']=="ACF")
                                    {
                                        echo "<option value='ACF'>ACF</option>";
                                    }
                                    if($_SESSION['workplace']=="CCF")
                                    {
                                        echo "<option value='CCF'>CCF</option>";
                                    }
                                    if($_SESSION['workplace']=="DR")
                                    {
                                        echo "<option value='DR'>DR</option>";
                                    }
                                    if($_SESSION['workplace']=="Flexible")
                                    {
                                        echo "<option value='Flexible'>Flexible</option>";
                                    }
                                    if($_SESSION['workplace']=="Aluminium Rodmill")
                                    {
                                        echo "<option value='Aluminium Rodmill'>Aluminium Rodmill</option>";
                                    }
                                    if($_SESSION['workplace']=="Ceylon Copper")
                                    {
                                        echo "<option value='Ceylon Copper'>Ceylon Copper</option>";
                                    }
                                ?>
                                    <!-- <option value="ACF" <?php if($_SESSION['workplace']=="ACF"){echo "selected";}?> >ACF</option>
                                    <option value="CCF" <?php if($_SESSION['workplace']=="CCF"){echo "selected";}?> >CCF</option>
                                    <option value="DR" <?php if($_SESSION['workplace']=="DR"){echo "selected";}?> >DR</option>
                                    <option value="Flexible" <?php if($_SESSION['workplace']=="Flexible"){echo "selected";}?> >Flexible</option>
                                    <option value="Aluminium Rodmill" <?php if($_SESSION['workplace']=="Aluminium Rodmill"){echo "selected";}?> >Aluminium Rodmill</option>
                                    <option value="Ceylon Copper" <?php if($_SESSION['workplace']=="Ceylon Copper"){echo "selected";}?> >Ceylon Copper</option> -->
                                </select>
                            </td>
                        </tr>
                        <!-- Row of input fields -->
                        <tr>

                            <td style="width:200px;padding:5px">
                                <label class="pr-3">Name of the Machine</label>
                            </td>
                            <td style="width:500px;padding:5px">

                                <select id='division' class="form-select" name="MachineName" required>
                                    <!-- <option selected>Choose Machine</option> -->
                                    <option></option>
                                </select>
                            </td>
                        </tr>
                        <!-- Row of input fields -->
                        <tr>

                            <td style="width:200px;padding:5px">
                                <label class="pr-3">Priority</label>
                            </td>
                            <td style="width:500px;padding:5px">
                                <select name="priority" id="dept" onchange='divSelect()' class="form-select" required
                                    placeholder="Choose Priority">

                                    <option value="Low">Low</option>
                                    <option value="High">High</option>
                                    <option value="Critical">Critical</option>
                                </select>
                            </td>
                        </tr>
                        <!-- Row of input fields -->
                        <tr>

                            <td style="width:200px;padding:5px">
                                <label class="pr-3">Report to</label>
                            </td>
                            <td style="width:500px;padding:5px">
                                <select name="ReportTo"  class="form-select" required placeholder="Report To">

                                    <option value="Electrical">Electrical</option>
                                    <option value="Mechanical">Mechanical</option>
                                    <option value="Both">Both</option>
                                </select>
                            </td>
                        </tr>
                        <!-- Row of input fields -->
                        <tr>

                            <td style="width:200px;padding:5px">
                                <label class="pr-3">Breif Description</label>
                            </td>
                            <td style="width:500px;padding:5px">
                                <textarea name="BriefDescription" class="form-control" id="exampleFormControlTextarea1" rows="3" required></textarea>
                            </td>

                        </tr>
                    </div>
        </div>
        </table>
        <button type="submit" class="btn btn-primary mt-3" name="submit">Submit</button>
        <button type="back" class="btn btn-danger mt-3" name="back" ><a href="\MaintananceJobCard\PUser\indexPUser.php" style="text-decoration:none;color:white">Back to Main</a></button>
        </form>
    </div>
    </div>
    <script>
        function divSelect() {

            var select = document.getElementById('division');
            var dept = document.getElementById('dept').value;
            var x = Array("");
            var a = Array("A20", "A30", "A40", "A50");
            var b = Array("B20", "B30", "B40", "B50");
            var c = Array("C20", "C30", "C40", "C50");
            var d = Array("D20", "D30", "D40", "D50");
            var e = Array("E20", "E30", "E40", "E50");
            var f = Array("F20", "F30", "F40", "F50");

            select.options.length = 0;

            if (dept === "") {
                for (var i = 0; i < x.length; ++i) {
                    select[select.length] = new Option(x[i], x[i]);
                }
            } else if (dept === "ACF") {
                for (var i = 0; i < a.length; ++i) {
                    select[select.length] = new Option(a[i], a[i]);
                }
            } else if (dept === "CCF") {
                for (var i = 0; i < b.length; ++i) {
                    select[select.length] = new Option(b[i], b[i]);
                }
            } else if (dept === "DR") {
                for (var i = 0; i < b.length; ++i) {
                    select[select.length] = new Option(c[i], c[i]);
                }
            } else if (dept === "Flexible") {
                for (var i = 0; i < b.length; ++i) {
                    select[select.length] = new Option(d[i], d[i]);
                }
            } else if (dept === "Aluminium Rodmill") {
                for (var i = 0; i < b.length; ++i) {
                    select[select.length] = new Option(e[i], e[i]);
                }
            } else if (dept === "Ceylon Copper") {
                for (var i = 0; i < b.length; ++i) {
                    select[select.length] = new Option(f[i], f[i]);
                }
            }

        }
    </script>

    <script>
        var char = "123456759",
            serialLenght = 6;

        function eee() {
            'use strict';

            var randomKey = "";
            for (var i = 0; i < serialLenght; ++i) {
                var randomSingle = char[Math.floor(Math.random() * char.length)];
                randomKey += randomSingle;

            }
            console.log(randomKey)
            document.getElementById('JobCodeNo').value = "JO" + randomKey
        }
    </script>
</body>
</body>