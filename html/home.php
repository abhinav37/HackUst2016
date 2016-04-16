<?php
session_start();
include_once 'dbconnect.php';

if(!isset($_SESSION['user']))
{
 header("Location: index.php");
}
$res=mysql_query("SELECT * FROM user WHERE userID=".$_SESSION['user']);
$userRow=mysql_fetch_array($res);
?>