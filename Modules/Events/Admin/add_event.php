<?php
include("../../../includes/session.php");
include("../../../includes/functions.php");
include("../../../includes/config.php");
$user=$_SESSION['login_user'];
date_default_timezone_set('Asia/Kolkata');


	$posted_on = date("Y-m-d H:i:s");
	$title=$_POST['title'];
	$start=$_POST['start'];
	$end=$_POST['end'];
	$contact1=$_POST['contact1'];
	$contact2=$_POST['contact2'];
	$email=$_POST['email'];
	$notes=$_POST['notes'];
	$scope = $_POST['scope'];
	$file_count = count(array_filter($_FILES['userfile']['name']));
	if ($file_count == 0) $attachment = "0";
	else $attachment = "1";
	$uploaded_files = 0;
	$fail_falg = 0;

	
	if ($title == "") { echo '<b style="color:red;">Enter Valid Event name</b>'; }
	else if($start == "" || $end == "") { echo '<b style="color:red;">Select Valid Event Start or End Dates</b>'; }
	else if($start > $end || $start < $posted_on || $end < $posted_on) { echo '<b style="color:red;">Start Date must be less than End Date</b>'; }
	else if($contact1=="") { echo '<b style="color:red;">Enter Valid Contact1 Number</b>'; }
	else if($email=="") { echo '<b style="color:red;">Enter Valid Email</b>'; }
	else if($email=="") { echo '<b style="color:red;">Enter Valid Event name</b>'; }
	else
	{	
		$query = "INSERT INTO `events`(`by_user`,`posted_on`, `title`, `start_date`, `end_date`, `contact1`, `contact2`, `email`, `scope`, `notes`, `attachment`)
		VALUES ('$user','$posted_on','$title','$start','$end','$contact1','$contact2','$email','$scope','$notes','$file_count')";
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
					VALUES('$user','$filename','$file_type','$file_size','$content','event','$inserted')";
					if(mysqli_query($db,$final)) { $uploaded_files = $uploaded_files+1; }
					else 
					{
						$fail_falg = 1;
					}
					if ($uploaded_files == $file_count) { echo '<b style="color:green;">Event Added Successfully</b>';break; }
					else if ($fail_falg == 1)
					{
						$delete = "delete from events where id = '$inserted'";
						if (mysqli_query($db,$delete)) { echo '<b style="color:red;"> One or More Files Upload failed.Please check your files and try again</b>'; }
						else { echo '<b style="color:red;"> Some unknown error occured.Try again</b>'; }
					}
				}
			}
			else { echo '<b style="color:green;">Event Added successfully</b>'; }
		}
		else { echo '<b style="color:red;">Please check your form inputs and try again</b>'; }
	}
?>