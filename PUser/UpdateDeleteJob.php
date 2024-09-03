<?php
include '../connect.php';
include '../session.php';
date_default_timezone_set('Asia/Colombo');
$date = date("Y-m-d G:i:s");
if (!($_SESSION['type'] == 'puser')) {
    header('location:..\index.php');
}
//
$idu = $_GET['updateid'];

$sql = "Select * from jobdatasheet where id='$idu'";

$result = mysqli_query($con, $sql);

$row = mysqli_fetch_assoc($result);

$id = $row['id'];
$JobCodeNo = $row['JobCodeNo'];
$username = $_SESSION['username'];
$JobIssuingDateTime = $row['JobPostingDateTime'];
$JobIssuingDivision = $row['JobPostingDev'];
$MachineName = $row['MachineName'];
$priority = $row['Priority'];
$ReportTo = $row['ReportTo'];
$BriefDescription = $row['BDescription'];

// $gen = explode(",",$gender);
// $lang = explode(",",$datas);
// $pl = explode(",",$place);

//echo  $BriefDescription;



// update operation
if (isset($_POST['update'])) {

$JobType=$_POST['JobType'];
    //$JobCodeNo = $_POST['JobCodeNo'];
    $JobIssuingDivision = $_POST['JobIssuingDivision'];
    $MachineName = $_POST['MachineName'];
    $priority = $_POST['priority'];
    $ReportTo = $_POST['ReportTo'];
    $BriefDescription = $_POST['BriefDescription'];
    $username = $_SESSION['username'];
if ($JobType=="JobOrder")
{
    $JobCodeNo="JO".(substr($JobCodeNo, 2));
}
if ($JobType=="WorkOrder")
{
    $JobCodeNo="WO".(substr($JobCodeNo, 2));
}
    $_SESSION['UpdateJobSucess'] = true;
    if ($ReportTo == 'Electrical') {
        $insert = "update jobdatasheet set JobCodeNo='$JobCodeNo',JobPostingDateTime='$date',JobPostingDev='$JobIssuingDivision',MachineName='$MachineName',Priority='$priority',ReportTo='$ReportTo',BDescription='$BriefDescription',Username='$username',JobStatusE='Pending',JobStatusM='NA' where id='$idu'";
    } elseif ($ReportTo == 'Mechanical') {
        $insert = "update jobdatasheet set JobCodeNo='$JobCodeNo',JobPostingDateTime='$date',JobPostingDev='$JobIssuingDivision',MachineName='$MachineName',Priority='$priority',ReportTo='$ReportTo',BDescription='$BriefDescription',Username='$username',JobStatusE='NA',JobStatusM='Pending' where id='$idu'";
    } else {
        $insert = "update jobdatasheet set JobCodeNo='$JobCodeNo',JobPostingDateTime='$date',JobPostingDev='$JobIssuingDivision',MachineName='$MachineName',Priority='$priority',ReportTo='$ReportTo',BDescription='$BriefDescription',Username='$username',JobStatusM='Pending',JobStatusE='Pending' where id='$idu'";
    }


    if ($con->query($insert) == TRUE) {
        //$_SESSION['SubmitJobSucess']=true;
        //echo "Sucessfully updated data";

        header('location:.\UpdateJobSuccess.php');

    } else {

        echo mysqli_error($con);
        //  header('location:location:..\PUser\indexPUser.php');
    }
    //$insert->close();
}




// delete operation
if (isset($_POST['delete'])) {

    $sql = "delete  from `jobdatasheet` where id='$idu'";
    $result = mysqli_query($con, $sql);
    $_SESSION['DeleteJobSucess'] = true;
    header('location:.\DeleteJobSuccess.php');



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

<body onload="divSelect()">
    <div class="topbar">
        <h1 class="topbar-text">Welcome <?php echo $_SESSION['workplace'] ?> User</h1>

        <a href="\MaintananceJobCard\logout.php">
            <h1 class="topbar-logout">Logout &nbsp</h1>
        </a>
        <h1 class="topbar-username"><?php echo $_SESSION['username'] ?>&nbsp</h1>

    </div>
    <div class="container mt-5 ">
        <h1> Update or Delete Job </h1>
        <div class="mt-3">
            <form method="POST">
                <table>
                    <div class="form-group">
                        <tr>

                            <td style="width:200px;padding:5px">
                                <label class="pr-3">Job Type</label>
                            </td>
                            <td style="width:500px;padding:5px">
                                <select name="JobType" id="JobType" class="form-select" onchange="eee()" required>

                                    <option value="JobOrder"<?php if((substr($JobCodeNo, 0, 2))=="JO"){echo "selected";}?>>Job Order</option>
                                    <option value="WorkOrder"<?php if((substr($JobCodeNo, 0, 2))=="WO"){echo "selected";}?>>Work Order</option>

                            </td>

                        </tr>
                        <!-- Row of input fields -->
                        <tr>

                            <td style="width:200px;padding:5px">
                                <label class="pr-3">Job code No</label>
                            </td>
                            <td style="width:500px;padding:5px">
                                <input type="text" name="JobCodeNo" class="form-control" id="JobCodeNo"
                                    value="<?php echo $JobCodeNo; ?>" readonly required>
                            </td>

                        </tr>

                        <!-- Row of input fields -->
                        <tr>

                            <td style="width:200px;padding:5px">
                                <label class="pr-3">Job Issuing Division</label>
                            </td>
                            <td style="width:500px;padding:5px">
                                <select name="JobIssuingDivision" id="dept" onchange='divSelect()' class="form-select"
                                    required>

                                    <?php if ($_SESSION['workplace'] == "ACF") {
                                        echo "<option value='ACF'>ACF</option>";
                                    }
                                    if ($_SESSION['workplace'] == "CCF") {
                                        echo "<option value='CCF'>CCF</option>";
                                    }
                                    if ($_SESSION['workplace'] == "DR") {
                                        echo "<option value='DR'>DR</option>";
                                    }
                                    if ($_SESSION['workplace'] == "Flexible") {
                                        echo "<option value='Flexible'>Flexible</option>";
                                    }
                                    if ($_SESSION['workplace'] == "Aluminium Rodmill") {
                                        echo "<option value='Aluminium Rodmill'>Aluminium Rodmill</option>";
                                    }
                                    if ($_SESSION['workplace'] == "Ceylon Copper") {
                                        echo "<option value='Ceylon Copper'>Ceylon Copper</option>";
                                    }
                                    if ($_SESSION['workplace'] == "Bail Room") {
                                        echo "<option value='Bail Room'>Bail Room</option>";
                                    }
                                    if ($_SESSION['workplace'] == "Drum Yard") {
                                        echo "<option value='Drum Yard'>Drum Yard</option>";
                                    }
                                    if ($_SESSION['workplace'] == "Carpentry") {
                                        echo "<option value='Carpentry'>Carpentry</option>";
                                    }
                                    ?>
                                    <!-- <option value="ACF" <?php if ($JobIssuingDivision == "ACF") {
                                        echo "selected";
                                    } ?>>ACF</option>>ACF</option>
                                    <option value="CCF" <?php if ($JobIssuingDivision == "CCF") {
                                        echo "selected";
                                    } ?>>CCF</option>
                                    <option value="DR" <?php if ($JobIssuingDivision == "DR") {
                                        echo "selected";
                                    } ?>>DR</option>
                                    <option value="Flexible" <?php if ($JobIssuingDivision == "Flexible") {
                                        echo "selected";
                                    } ?>>Flexible</option>
                                    <option value="Aluminium Rodmill" <?php if ($JobIssuingDivision == "Aluminium Rodmill") {
                                        echo "selected";
                                    } ?>>Aluminium Rodmill</option>
                                    <option value="Ceylon Copper" <?php if ($JobIssuingDivision == "Ceylon Copper") {
                                        echo "selected";
                                    } ?>>Ceylon Copper</option> -->
                                </select>
                            </td>
                        </tr>
                        <!-- Row of input fields -->
                        <tr>
                            <?php echo $MachineName; ?>
                            <td style="width:200px;padding:5px">
                                <label class="pr-3">Name of the Machine</label>
                            </td>
                            <td style="width:500px;padding:5px">

                                <select id='division' class="form-select" name="MachineName" required>
                                    <?php
                                    $workplace = $_SESSION['workplace'];
                                    if ($workplace == 'ACF') {
                                        $Factory = 'acfmachines';
                                    }
                                    if ($workplace == 'CCF') {
                                        $Factory = 'ccfmachines';
                                    }
                                    if ($workplace == 'DR') {
                                        $Factory = 'drmachines';
                                    }
                                    if ($workplace == 'Flexible') {
                                        $Factory = 'flexiblemachines';
                                    }
                                    if ($workplace == 'Ceylon Copper') {
                                        $Factory = 'ceyloncoppermachines';
                                    }
                                    if ($workplace == 'Aluminium Rodmill') {
                                        $Factory = 'aluminiumrodmillmachines';
                                    }
                                    if ($workplace == 'Drum Yard') {
                                        $Factory = 'drumyardmachines';
                                    }

                                    if ($workplace == 'Bail Room') {
                                        $Factory = 'bailmachines';
                                    }
                                    if ($workplace == 'Carpentry') {
                                        $Factory = 'carpentrymachines';
                                    }

                                    $query = "SELECT * FROM $Factory";
                                    $result = $con->query($query);

                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) { ?>

                                            <option value="<?php echo $row['MachineName']; ?> " <?php if ($MachineName == $row['MachineName']) {
                                                     echo 'selected';
                                                 } ?>>
                                                <?php echo $row['MachineName']; ?></option>
                                        <?php }
                                    } else {
                                        echo '<option value="">No data available</option>';
                                    }
                                    ?>
                                    <!-- <option value="<?php $MachineName ?>" <?php if ($MachineName != null) {
                                          echo "selected";
                                      } ?>tion> -->

                                </select>
                            </td>
                        </tr>
                        <!-- Row of input fields -->
                        <tr>

                            <td style="width:200px;padding:5px">
                                <label class="pr-3">Priority</label>
                            </td>
                            <td style="width:500px;padding:5px">
                                <select name="priority" id="dept" class="form-select" required
                                    placeholder="Choose Priority">

                                    <option value="Low" <?php if ($priority == "Low") {
                                        echo "selected";
                                    } ?>>Low</option>
                                    <option value="High" <?php if ($priority == "High") {
                                        echo "selected";
                                    } ?>>High</option>
                                    <option value="Critical" <?php if ($priority == "Critical") {
                                        echo "selected";
                                    } ?>>
                                        Critical</option>
                                </select>
                            </td>
                        </tr>
                        <!-- Row of input fields -->
                        <tr>

                            <td style="width:200px;padding:5px">
                                <label class="pr-3">Report to</label>
                            </td>
                            <td style="width:500px;padding:5px">
                                <select name="ReportTo" class="form-select" required placeholder="Report To">

                                    <option value="Electrical" <?php if ($ReportTo == "Electrical") {
                                        echo "selected";
                                    } ?>>
                                        Electrical</option>
                                    <option value="Mechanical" <?php if ($ReportTo == "Mechanical") {
                                        echo "selected";
                                    } ?>>
                                        Mechanical</option>
                                    <option value="Both" <?php if ($ReportTo == "Both") {
                                        echo "selected";
                                    } ?>>Both</option>
                                </select>
                            </td>
                        </tr>
                        <!-- Row of input fields -->
                        <tr>

                            <td style="width:200px;padding:5px">
                                <label class="pr-3">Breif Description</label>
                            </td>
                            <td style="width:500px;padding:5px">
                                <textarea name="BriefDescription" class="form-control" value="" rows="3"
                                    required><?php echo $BriefDescription; ?></textarea>
                            </td>

                        </tr>
                    </div>
        </div>
        </table>
        <button type="submit" class="btn btn-success mt-3" name="update"
            onclick="return confirm('Are you sure?')">Update</button>
        <button type="submit" class="btn btn-warning mt-3" name="delete"
            onclick="return confirm('Are you sure?')">Delete</button>
        <button type="back" class="btn btn-danger mt-3" name="back"><a href="\MaintananceJobCard\PUser\indexPUser.php"
                style="text-decoration:none;color:white">Back to Main</a></button>
        </form>
    </div>
    </div>
    <!-- <select name="priority" id="dept" class="form-select" required placeholder="Choose Priority">
        <?php
        // $query = "SELECT * FROM acfmachines";
        // $result = $con->query($query);
        
        // if ($result->num_rows > 0) {
        //     while ($row = $result->fetch_assoc()) {
        //         echo '<option value="' . $row['id'] . '">' . $row['MachineName'] . '</option>';
        //     }
        // } else {
        //     echo '<option value="">No data available</option>';
        // }
        ?> -->
    <!-- <script>
        function divSelect() {

            var select = document.getElementById('division');
            var dept = document.getElementById('dept').value;
            var x = Array("");
            var a = Array(,"JOHN ROYLE EXTRUDER","GENERAL ENGINEERING EXTRUDER","HIGH SPEED BOW STRANDER","MAJI LAYING UP MACHINE","ALIND STRANDER I","ALIND STRANDER II","SKIP STRANDER","BABCOCK W/D MACHINE I","BABCOCK W/D MACHINE II","AGEING FURNACE","CURING CHAMBER","REVOMAX STEAM BOILER","SM STRANDER II","HOSN 1600 BUNCHER","HOLD W/D MACHINE","AEI STRANDER","SCREW COMPRESSOR - 1   [ELANG]","PISTON TYPE COMPRESSOR - ATLAS COPCO","PISTON TYPE COMPRESSOR ","SCREW COMPRESSOR - LANG","SCREW COMPRESSOR - CICCATO");
            var b = Array("SICTRA W/D MACHINE","RIGID STRANDER","GOLDEN EXTRUDER 120+45/60+45mm","YOSHIDA DRUM TWISTER","MAPRE EXTRUDER","GENERAL ENGINEERING EXTRUDER","BEKEART W/D MACHINE","DRUM TWISTER","ARMOURING MACHINE ","REELING WINDER ","MAJI ARMOURING MACHINE","SETIC BUNCHER  1250mm","TINNING PLANT","CUTTING WINDER I & II","PIONEER MEDIUM W/D MACHINE  [DB 17]","1250 PIONEER DOUBLE TWIST BUNCHER","SCREW COMPRESSOR - 1   [LANG]","SCREW COMPRESSOR - 2   [LANG]","PISTON TYPE COMPRESSOR - 1   [ATLAS]","PISTON TYPE COMPRESSOR - 2   [ATLAS]","PISTON TYPE COMPRESSOR - 3   [KIRLOSCAR]","PISTON TYPE COMPRESSOR - 4   [KIRLOSCAR]","PISTON TYPE COMPRESSOR - 5   [KIRLOSCAR]");
            var c = Array("MICA TAPING MACHINE I","MICA TAPING MACHINE II","KU KA MA BUNCHER","FRANCIS SHAW MACHINE ","GOLDEN TEC. 80+45/90+45 EXTRUDER","NMC TANDEM EXTRUDER LINE","PIONEER EXTRUDER","REEL 'O' TECH CUTTING WINDER","CUTTING WINDER","NORTHEMPTON EXTRUDER","PIONEER TANDEM EXTRUDER 70+60mm","SCREW COMPRESSOR - LANG");
            var d = Array("SETIC BUNCHER 630","ANDOURT EXTRUDER","CORTINOVIS BUNCHER","MULTI W/D MACHINE","CUTTING WINDER WITH PIONEER AUTO COILER","CUTTING WINDER WITH AUTO COILER","CUTTING WINDER I","CUTTING WINDER II","BOW TWINER");
            var e = Array("MELTING FURNACE","HOLDING FURNACE","CASTING MACHINE","INDUCTION HEATER","ROD ROLLING MACHINE","TAKEUP 1 & 2","GANTRY CRANE 2T","GANTRY CRANE 3T","SCREW COMPRESSOR - LANG");
            var f = Array("CONTINUOUS CASTING MACHINE 8-17mm ","BUSBAR MACHINE","PIONEER FURNACE","COMPRESSOR","PISTON TYPE COMPRESSOR - ATLAS COPCO");
            var g = Array("FIREFOX MACHINE","PULAVERISER MACHINE","COMPACT MACHINE","STRIP MACHINE I , II , III","BAIL MACHINE I , II , III","HYDRAULIC CUTTER");
            var h = Array("GANTRY CRANE 20T","CUTTING WINDER I , II , III","SCREW COMPRESSOR - CICCATO ");
            var k = Array("WOOD PLANER MACHINE - 1 [LIDA]","WOOD PLANER MACHINE - 2","HOLE SAW MACHINE - 1","HOLE SAW MACHINE - 2","CIRCULAR SAW MACHINE - 1","CIRCULAR SAW MACHINE - 2","BAND SAW MACHINE - 1","BAND SAW MACHINE - 2","CUTOFF MACHINE","LATHE MACHINE - 1","LATHE MACHINE - 2","BUT WELDER","BENCH GRINDER");
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
                for (var i = 0; i < c.length; ++i) {
                    select[select.length] = new Option(c[i], c[i]);
                }
            } else if (dept === "Flexible") {
                for (var i = 0; i < d.length; ++i) {
                    select[select.length] = new Option(d[i], d[i]);
                }
            } else if (dept === "Aluminium Rodmill") {
                for (var i = 0; i < e.length; ++i) {
                    select[select.length] = new Option(e[i], e[i]);
                }
            } else if (dept === "Ceylon Copper") {
                for (var i = 0; i < f.length; ++i) {
                    select[select.length] = new Option(f[i], f[i]);
                }
            } else if (dept === "Bail Room") {
                for (var i = 0; i < g.length; ++i) {
                    select[select.length] = new Option(g[i], g[i]);
                }
            } else if (dept === "Drum Yard") {
                for (var i = 0; i < h.length; ++i) {
                    select[select.length] = new Option(h[i], h[i]);
                }
            }else if (dept === "Carpentry") {
                for (var i = 0; i < k.length; ++i) {
                    select[select.length] = new Option(k[i], k[i]);
                }
            }


        }
    </script> -->


</body>
</body>