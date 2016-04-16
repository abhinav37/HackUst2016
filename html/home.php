<?php
session_start();
include_once 'dbconnect.php';
?>
	<script> 
		console.log("HEllo");

	</script>
<?php
echo $_SESSION['userID'];
if(isset($_SESSION['userID']))
{
 	header("Location: home.html");
}else{
	echo $_SESSION['userID'];
	//header("Location: index.php");
}

?>