<?php
//get the q parameter from URL
include("../../../includes/config.php");
include("../../../includes/functions.php");
$arr = array();

if (!empty($_POST['keywords'])) {
	$keywords = $db->real_escape_string($_POST['keywords']);
	$sql = "SELECT * FROM forum_q WHERE question LIKE '%".$keywords."%'";
	$result = $db->query($sql) or die($mysqli->error);
	if ($result->num_rows > 0) {
		while ($obj = $result->fetch_object()) {
			$arr[] = array('id' => $obj->id, 'user' => $obj->display_name,'date' => $obj->posted_on,'status' => $obj->status,'category' => $obj->category, 'question' => $obj->question);
		}
	}
}

echo json_encode($arr);
?>