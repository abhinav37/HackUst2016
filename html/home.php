<?php
session_start();
include_once 'dbconnect.php';
?>
	<script> 
		console.log("HEllo");

	</script>
<?php

if(isset($_SESSION['userID']))
{
 	header("Location: home.html");
}else{
	header("Location: index.html");
}

?>