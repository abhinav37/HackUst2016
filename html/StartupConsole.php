<?php
include_once 'dbconnect.php';


	$evaluation= mysql_real_escape_string($_POST['CuEval']);
	$profit= mysql_real_escape_string($_POST['profit']);
  $activeUsers = mysql_real_escape_string($_POST['activeUsers']);
  $description = mysql_real_escape_string($_POST['description']);
 
  
  
 $query = "UPDATE startup SET evaluation = '$evaluation', annualProfit='$profit',activeUsers='$activeUsers', about='$description' WHERE startupID = 1" ;
 	$fileName = $_FILES['fileToUpload1']['name'];
	$tmpName  = $_FILES['fileToUpload1']['tmp_name'];
	$target_file = "files/" . basename($fileName);
	var_dump($fileName);
	move_uploaded_file($tmpName, $target_file);
 
  
 if(mysqli_query($conn, $query))
 {

        echo "successfully ";
 }
 else
 {
    echo "fail";
 } //annualProfit='$profit',activeUsers='$activeUsers', about='$description'
?>

