<?php
$conn=mysqli_connect('localhost','root','') or die ('Failed to Connect '.mysqli_error($conn));
mysqli_select_db($conn,'hackust') or die ('Failed to Access DB'.mysqli_error($conn));

$user = mysql_real_escape_string($_POST['user']);
$uPass = mysql_real_escape_string($_POST['pass']);

$query = "select * from `user` where `userName` = \"$user\" ";
echo $query;

$res=mysqli_query($conn, $query) or die ('Failed to query');
$row=mysqli_fetch_array($res);
echo $row['password'];
 
 if($row['password']==$uPass)
 {
	echo "yes";
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
