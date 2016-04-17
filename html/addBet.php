<?php
	include_once 'dbconnect.php';
	$amount= mysql_real_escape_string($_POST['amount']);
	$odds = $_POST['odds'];
	$startupID = $_POST['startupID'];
	//$userID = $_SESSION['userID'];
	$userID = 1;

 	$query = "INSERT INTO bets (betID,startupID,userID,amount,odds) VALUES ('','$startupID','$userID','$amount','$odds')";

	 if(mysqli_query($conn, $query))
	 	echo "Successfully placed bet!";
	 else
	 	echo "Failed to place bet, try again!";
?>