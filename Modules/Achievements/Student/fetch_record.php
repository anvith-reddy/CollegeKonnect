<?php
//Include database connection
include("../../../includes/session.php");
include("../../../includes/functions.php");
include("../../../includes/config.php");
$user=$_SESSION['login_user'];
echo "anvith";
$id = $_POST['theId'];
echo $id;
if($_POST['theId']) {
    $id = $_POST['theId']; //escape string
    // Run the Query
    // Fetch Records
    // Echo the data you want to show in modal
	echo $id;
	$query="select * from achievements where id = '$id'";
	$result = mysqli_fetch_assoc(mysqli_query($db,$query));
	echo $result['id'];
	echo $result['user'];
	echo $result['event'];
	echo $result['place'];
 }
?>