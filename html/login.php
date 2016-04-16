<?php

session_start();
include_once("dbconnect.php");

$user = mysql_real_escape_string($_POST['user']);
$uPass = mysql_real_escape_string($_POST['pass']);

$query = "select * from `user` where `username` = \"$user\" ";


$res=mysqli_query($conn, $query) or die ('Failed to query');
$row=mysqli_fetch_array($res);

 if($row['password']==$uPass)
 {
	

	$_SESSION['userID']= $row['userID'];
	echo "Successfully logged in as " . $row['username'];
 }
 else
 {
 	echo "Cannot log in";
 }
 

?>
