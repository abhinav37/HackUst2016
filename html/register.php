
<?php

session_start();
if(isset($_SESSION['user'])!="")
{
 header("Location: home.php");
}
include_once 'dbconnect.php';


	$fName= mysql_real_escape_string($_POST['fName']);
	$lName= mysql_real_escape_string($_POST['lName']);
  $uName = mysql_real_escape_string($_POST['user']);
 
  $uPass = md5(mysql_real_escape_string($_POST['pass']));
 
 if(mysql_query("INSERT INTO user(userID,username,password,firstName,lastName) VALUES('','$uName','$uPass','$fName','$lName',)"))
 {
  ?>
        <script>alert('successfully registered ');</script>
        <?php
 }
 else
 {
  ?>
        <script>alert('error while registering you...');</script>
        <?php
 }
