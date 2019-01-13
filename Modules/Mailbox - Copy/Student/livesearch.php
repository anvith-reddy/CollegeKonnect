<?php
//get the q parameter from URL
include("../../../includes/config.php");
include("../../../includes/session.php");
include("../../../includes/functions.php");
$arr = array();

if (!empty($_POST['keywords'])) {
	$keywords = $db->real_escape_string($_POST['keywords']);
	$sql = "SELECT * FROM mail WHERE ((message LIKE '%".$keywords."%') AND ((sender = '$user') OR (receiver = '$user')))";
	$result = $db->query($sql) or die($mysqli->error);
	if ($result->num_rows > 0) {
		while ($obj = $result->fetch_object()) {
			$arr[] = array('id' => $obj->ID, 'message' => $obj->message);
		}
	}
}

echo json_encode($arr);
?>