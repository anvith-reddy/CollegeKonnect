<?php
include("../../../includes/session.php");
include("../../../includes/functions.php");
include("../../../includes/config.php");
date_default_timezone_set('Asia/Kolkata');
$posted_on = date("Y-m-d");
$post_time = date("H:i:s");
$by_user = $_SESSION['login_user'];
$icon = $_POST['icon'];
$content = $_POST['content'];
$identifier = $_POST['identifier'];
$theme = $_POST['theme'];
if (empty($_FILES['userfile']['name']))
{
	echo '<b class="fa fa-exclamation" style="color:red;">&nbsp; No Image Attached.</b>';
}
else
{
	$sql = "INSERT INTO `time_line`(`by_user`, `posted_on`, `type`, `icon`, `identifier`, `theme`, `content`, `post_time`) 
	VALUES ('$by_user','$posted_on','image','$icon','$identifier','$theme','$content','$post_time')";
	if ($db->query($sql) === TRUE)
		{
			$inserted = $db->insert_id;
				$filename = $_FILES['userfile']['name'];
				$tmpname = $_FILES['userfile']['tmp_name'];
				$file_size = $_FILES['userfile']['size'];
				$file_type = $_FILES['userfile']['type'];
				$ext = pathinfo($filename, PATHINFO_EXTENSION);
			
				$fp      = fopen($tmpname, 'r');
				$content = fread($fp, filesize($tmpname));
				$content = addslashes($content);
				fclose($fp);
				
				$final = "INSERT INTO `files`(`by_user`, `name`, `type`, `size`, `data`, `category`, `categoryid`) 
				VALUES('$by_user', '$filename','$file_type','$file_size','$content','timeline','$inserted')";
				if(mysqli_query($db,$final))
				{
					echo '<b class="fa fa-check-circle-o" style="color:green;">Post Successfully Added.</b>';
				}
				else
				{
					echo '<b class="fa fa-check-circle-o" style="color:green;">Error. Please Try Again</b>';
				}
		}
		else
		{
			'<b class="fa fa-check-circle-o" style="color:green;">Error Please Try Again</b>';
		}
}
?>