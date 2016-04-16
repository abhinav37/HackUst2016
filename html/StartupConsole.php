<?php
include_once 'dbconnect.php';


	$evaluation= mysql_real_escape_string($_POST['CuEval']);
	$profit= mysql_real_escape_string($_POST['profit']);
  $activeUsers = mysql_real_escape_string($_POST['activeUsers']);
  $description = mysql_real_escape_string($_POST['description']);
 
  

 $query = "UPDATE startup SET evaluation = '$evaluation', annualProfit='$profit',activeUsers='$activeUsers', about='$description') WHERE 'startupid' = 1" ;
 echo $evaluation;
  
 if(mysqli_query($conn, $query))
 {

        echo "successfully ";
 }
 else
 {
    echo "fail";
 }
?>