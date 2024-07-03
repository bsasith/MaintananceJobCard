<?php
include '../connect.php'; //require database connection file

$per_page = 3;

//






$curr_page = (isset($_GET['page'])) ? (int) $_GET['page'] : 1;
$start = ($curr_page - 1) * $per_page;



$sql = "Select * from jobdatasheet ";

$result = mysqli_query($con, $sql);
$pages_query = mysqli_num_rows($result);
$num_of_pages = ceil($pages_query / $per_page);
//$query = "SELECT id, name FROM mytable LIMIT $start, $per_page";
//$query_run = mysqli_query($query) or die($error . mysqli_error());

while ($row = mysqli_fetch_assoc($result)) {
    $id = $row['id'];
    $JobCodeNo = $row['JobCodeNo'];
    
    echo "<p>" . $id . ". " . $JobCodeNo . "</p>";//you can display whatever you want here from your table

}
echo "<hr>";
if (($curr_page - 2) == 0) {
    $range_min = $curr_page - 1;
    $range_max = $curr_page + 3;
} else if (($curr_page - 1) == 0) {
    $range_min = $curr_page;
    $range_max = $curr_page + 4;
} else if (($curr_page + 1) == $num_of_pages) {
    $range_min = $curr_page - 3;
    $range_max = $curr_page + 1;
} else if ($curr_page == $num_of_pages) {
    $range_min = $curr_page - 4;
    $range_max = $curr_page;
} else {
    $range_min = $curr_page - 2;
    $range_max = $curr_page + 2;
}
if ($num_of_pages > 1 && $curr_page <= $num_of_pages) {
    echo "<a href=\"?page=1\">First</a>... ";




    if ($curr_page > 1 && $curr_page < $num_of_pages) {
        echo "<a href=\"?page=" . ($curr_page - 1) . "\">Prev</a> ";
        for ($x = $range_min; $x <= $range_max; $x++) {




            //to make the current page link bold
            echo ($x == $curr_page) ? "<b><a href=\"?page=" . $x . "\">" . $x . "</a></b> " : "<a href=\"?page=" . $x . "\">" . $x . "</a> ";
        }
        echo "<a href=\"?page=" . ($curr_page + 1) . "\">Next</a> ";
    } else if ($curr_page == 1) {
        for ($x = $range_min; $x <= $range_max; $x++) {




            //to make the current page link bold
            echo ($x == $curr_page) ? "<b><a href=\"?page=" . $x . "\">" . $x . "</a></b> " : "<a href=\"?page=" . $x . "\">" . $x . "</a> ";
        }
        echo "<a href=\"?page=" . ($curr_page + 1) . "\">Next</a> ";
    } else if ($curr_page == $num_of_pages) {
        echo "<a href=\"?page=" . ($curr_page - 1) . "\">Prev</a> ";
        for ($x = $range_min; $x <= $range_max; $x++) {




            //to make the current page link bold
            echo ($x == $curr_page) ? "<b><a href=\"?page=" . $x . "\">" . $x . "</a></b> " : "<a href=\"?page=" . $x . "\">" . $x . "</a> ";
        }
    }
    echo "...<a href=\"?page=" . $num_of_pages . "\">Last</a>";
}
?>