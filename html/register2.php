
<?php
include_once 'dbconnect.php';

	$name= mysql_real_escape_string($_POST['name']);
	$about= mysql_real_escape_string($_POST['about']);
	$evaluation = mysql_real_escape_string($_POST['user']);
	$annualProfit = mysql_real_escape_string($_POST['annualProfit']);
	$activeUsers = mysql_real_escape_string($_POST['activeUsers']);
	$user = mysql_real_escape_string($_POST['user']);
	$pass = mysql_real_escape_string($_POST['pass']);

  	$query = "INSERT INTO startup(`startupID`, `name`, `about`, `evaluation`, `annualProfit`, `activeUsers`, `odds`) VALUES (,$name,$about,$evaluation,$annualProfit,$activeUsers)";
	 if(mysqli_query($conn, $query))
	 {
	        echo "Successfully registered!";
	 }
	 else{
	    echo "Sorry, please try again!";
	 }
?>