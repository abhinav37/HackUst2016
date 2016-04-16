<?php

	$conn=mysqli_connect('localhost','root','') or die ('Failed to Connect '.mysqli_error($conn));
	mysqli_select_db($conn,'hackust') or die ('Failed to Access DB'.mysqli_error($conn));
?>