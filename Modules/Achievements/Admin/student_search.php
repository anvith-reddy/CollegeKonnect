<?php
//get the q parameter from URL
include("../../../includes/config.php");
include("../../../includes/functions.php");
$arr = array();

if (!empty($_POST['keywords'])) {
	$keywords = $db->real_escape_string($_POST['keywords']);
	$sql = "SELECT * FROM achievements WHERE by_user LIKE '%".$keywords."%'";
	$result = $db->query($sql) or die($mysqli->error);
	if ($result->num_rows > 0) {
		while ($obj = $result->fetch_object()) {
			$arr[] = array('id' => $obj->id, 'by_user' => $obj->by_user, 'event_name' => $obj->event_name,'held_at' => $obj->held_at,'semester' => $obj->semester, 'edate' => $obj->edate,'certificate_type' => $obj->certificate_type);
		}
	}
}

echo json_encode($arr);
?>