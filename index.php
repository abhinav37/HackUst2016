<?php
session_start();
include_once 'dbconnect.php';

if(isset($_SESSION['user'])!="")
{
 header("Location: home.php");
}

 $userName = mysql_real_escape_string($_POST['user']);
 $uPass = mysql_real_escape_string($_POST['pass']);
 $res=mysql_query("SELECT * FROM users WHERE username='$userName'");
 $row=mysql_fetch_array($res);
 if($row['password']==md5($uPass))
 {
  $_SESSION['user'] = $row['userID'];
  header("Location: home.php");
 }
 else
 {
  ?>
        <script>alert('wrong details');</script>
        <?php
 }
 

?>