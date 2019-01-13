<?php
include("../../../includes/session.php");
include("../../../includes/functions.php");
include("../../../includes/config.php");
date_default_timezone_set('Asia/Kolkata');
$posted_on = date("Y-m-d");
$post_time = date("H:i:s");
$by_user = $_SESSION['login_user'];
$icon = $_POST['icon'];
$type = $_POST['type'];
$identifier = $_POST['identifier'];
$theme = $_POST['theme'];
$content = $_POST['content'];
if ( $identifier == "" && $theme == "" && $content == "")
{
	echo '<b class="fa fa-exclamation" style="color:red;">&nbsp;Please check your inputs and Try Again.</b>';
}
else
{
	$sql = "INSERT INTO `time_line`(`by_user`, `posted_on`, `type`, `icon`, `identifier`, `theme`, `content`, `post_time`) 
	VALUES ('$by_user','$posted_on','$type','$icon','$identifier','$theme','$content','$post_time')";
	if (mysqli_query($db,$sql))
	{
		echo '<b class="fa fa-check-circle-o" style="color:green;">Post Successfully Added.</b>';
	}
	else
	{
		echo '<b class="fa fa-exclamation" style="color:red;">Somethings wrong.Please Check and Try Again.</b>';
	}
}
?>