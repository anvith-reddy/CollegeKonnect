<?php
include("../../../includes/session.php");
include("../../../includes/functions.php");
include("../../../includes/config.php");
$fid = $_GET['fid'];
$aid = $_GET['achievement'];
$user=$_SESSION['login_user'];

	$sql="delete from achievements where id='$aid'";
	$sql2="delete from files where categoryid='$fid' AND category='achievement'";
	if((mysqli_query($db,$sql)) && (mysqli_query($db,$sql2)))
	{
		header("location: index.php?message=deleted");
	}
?>