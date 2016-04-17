<?php
	session_start();
	include_once "dbconnect.php";

	if(isset($_SESSION['userID']))
	{
		session_unset();
		session_destroy();
		
	}
?>
<script>
	window.location.replace("index.php");
</script>




