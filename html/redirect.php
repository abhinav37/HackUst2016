<?php
session_start();
if(isset($_SESSION['userID']))
 	header("Location: home.html");
else
	header("Location: index.php");
?>