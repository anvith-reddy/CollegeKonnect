<?php
include("../../../includes/config.php");
include("../../../includes/session.php");
include("../../../includes/functions.php");
$thread=$_GET['qid'];
$query = "select status from forum_q where id='$thread'";
$result = mysqli_fetch_array(mysqli_query($db,$query));
echo "got you";
echo $result["status"];
if ($result["status"]=="closed")
{
	$status = "open";
	$open_query = "update `forum_q` set `status` = '$status' where id = '$thread'";
	mysqli_query($db,$open_query);
}
else if ($result["status"]=="open")
{
	$status = "closed";
	$close_query = "update `forum_q` set `status` = '$status' where id = '$thread'";
	mysqli_query($db,$close_query);
}
?>