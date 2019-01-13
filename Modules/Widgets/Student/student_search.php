<?php
//get the q parameter from URL
include("../../../includes/config.php");
include("../../../includes/functions.php");
$arr = array();

if (!empty($_POST['keywords'])) {
	$keywords = $db->real_escape_string($_POST['keywords']);
	$sql = "SELECT uid,fname,mname,lname FROM users WHERE (uid LIKE '%".$keywords."%' OR fname LIKE '%".$keywords."%' OR mname LIKE '%".$keywords."%' OR lname LIKE '%".$keywords."%')";
	$result = $db->query($sql) or die($mysqli->error);
	if ($result->num_rows > 0) {
		while ($obj = $result->fetch_object()) {
			$arr[] = array('uid' => $obj->uid, 'fname' => $obj->fname,'mname' => $obj->mname,'lname' => $obj->lname);
		}
	}
}

echo json_encode($arr);
?>