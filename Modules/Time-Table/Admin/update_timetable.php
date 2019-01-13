<?php
include("../../../includes/config.php");
include("../../../includes/functions.php");
include("../../../includes/session.php");

$key = $_GET['id'];
$dept_slot = $_GET['dept_slot'];
$faculty1 = $_GET['faculty1'];
$faculty2 = $_GET['faculty2'];
$faculty3 = $_GET['faculty3'];
$subject = $_GET['subject'];
$comma = ",";
$faculty = $faculty1 . $comma . $faculty2 . $comma . $faculty3;


$sql_student = 'UPDATE time_table SET `' . mysqli_real_escape_string($db, $key).'`= "' . mysqli_real_escape_string($db, $subject) . '" WHERE dept_slots = "' . mysqli_real_escape_string($db, $dept_slot) . '"';
$sql_faculty = 'update faculty_time_table set `' . mysqli_real_escape_string($db, $key).'`= "' . mysqli_real_escape_string($db, $faculty) . '" WHERE dept_slots = "' . mysqli_real_escape_string($db, $dept_slot) . '"';
if ((mysqli_query($db,$sql_student)) && (mysqli_query($db,$sql_faculty)))
{
	echo '<b style="color:green;"><i class="fa fa-tick">&nbsp; Updated Successfully</i></b>';
}
else
{
	echo '<b style="color:red;"><i class="fa fa-tick">&nbsp; ERROR!!! Try Again</i></b>';
}

?>