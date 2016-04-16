<?php
session_start();
include_once 'dbconnect.php';

if(!isset($_SESSION['userID']))
{
 header("Location: index.html");
}else{
	header("Location: home.html");
}

?>