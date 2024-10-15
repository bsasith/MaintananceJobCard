<?php
include '../connect.php';


 //the SQL query to be executed
 $query = "SELECT 
    JobPostingDev, 
    ROUND(SUM(TIME_TO_SEC(DownTime)) / 3600, 2) AS TotalDownTimeInHours
FROM 
    jobdatasheet
WHERE 
    MONTH(JobPostingDateTime) = MONTH(CURRENT_DATE())
    AND YEAR(JobPostingDateTime) = YEAR(CURRENT_DATE())
GROUP BY 
    JobPostingDev;";
 //storing the result of the executed query
 $result = $con->query($query);

 /////////////////////////////////////////////////////////////////////////
 //initialize the array to store the processed data
 $jsonArray = array();
 //check if there is any data returned by the SQL Query
 if ($result->num_rows > 0) {
   //Converting the results into an associative array
   while($row = $result->fetch_assoc()) {
     $jsonArrayItem = array();
     $jsonArrayItem['label'] = $row['JobPostingDev'];
     $jsonArrayItem['value'] = $row['TotalDownTimeInHours'];
     //append the above created object into the main array.
     header('Content-type: application/json');
     array_push($jsonArray, $jsonArrayItem);
   }
 }
 $con->close();
 //set the response content type as JSON
 //header('Content-type: application/json');
 //output the return value of json encode using the echo function.
 echo json_encode($jsonArray);
?>
