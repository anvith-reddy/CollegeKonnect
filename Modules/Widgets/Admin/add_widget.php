<?php
include("../../../includes/session.php");
include("../../../includes/functions.php");
include("../../../includes/config.php");
$user=$_SESSION['login_user'];
date_default_timezone_set('Asia/Kolkata');
$category = $_POST["category"];
$title = $_POST["title"];
$content = $_POST["content"];
$mdate = date("Y-m-d H:i:s");
$file_count = count(array_filter($_FILES['userfile']['name']));
if ($file_count == 0) $attachment = "0";
	else $attachment = "1";
	
if ($category == ""){ echo '<b style="color:red;">Please select category</b>'; }
else if($title == "") { echo '<b style="color:red;">Check all fields</b>'; }
else
{
	$query = "INSERT INTO `widgets` (`by_user`, `posted_on`, `type`, `title`, `content`, `files`) 
					VALUES ('$user','$mdate','$category','$title','$content','$file_count')";
		if ($db->query($query) === TRUE)
		{
			$inserted = $db->insert_id;
			if ($attachment == "1")
			{
				for($i=0;$i<$file_count;$i++)
				{
					$filename = $_FILES['userfile']['name'][$i];
					$tmpname = $_FILES['userfile']['tmp_name'][$i];
					$file_size = $_FILES['userfile']['size'][$i];
					$file_type = $_FILES['userfile']['type'][$i];
					$ext = pathinfo($filename, PATHINFO_EXTENSION);
				
					$fp      = fopen($tmpname, 'r');
					$content = fread($fp, filesize($tmpname));
					$content = addslashes($content);
					fclose($fp);
				
					$final = "INSERT INTO `files`(`by_user`,`name`, `type`, `size`, `data`, `category`, `categoryid`) 
					VALUES('$user','$filename','$file_type','$file_size','$content','$category','$inserted')";
					if(mysqli_query($db,$final)) { echo '<b style="color:green;">Form submitted Successfully</b>'; }
					else 
					{
						$delete = "delete from widgets where id = '$inserted'";
						if (mysqli_query($db,$delete)) { echo '<b style="color:red;"> File Upload failed.Please check your files and try again</b>'; }
						else { echo '<b style="color:red;"> Some unknown error occured.Try again</b>'; }
					}
				}
			}
			else { echo '<b style="color:green;">Form submitted successfully</b>'; }
		}
		else { echo '<b style="color:red;">Please check your form inputs and try again</b>'; }
}
?>