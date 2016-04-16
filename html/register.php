
<?php

include_once 'dbconnect.php';


	$fName= mysql_real_escape_string($_POST['fName']);
	$lName= mysql_real_escape_string($_POST['lName']);
  $uName = mysql_real_escape_string($_POST['user']);
 
  $uPass = md5(mysql_real_escape_string($_POST['pass']));

 $query = "INSERT INTO user (userID,username,password,firstName,lastName) VALUES ('','$uName','$uPass','$fName','$lName')";
echo $query;

 if(mysqli_query($conn, $query))
 {

        echo "successfully ";
 }
 else
 {
    echo "fail";
 }
?>