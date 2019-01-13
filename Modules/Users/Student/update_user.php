<?php
include("../../../includes/session.php");
include("../../../includes/functions.php");
include("../../../includes/config.php");
$id = $_GET["id"];
$uid = $_GET["uid"];
$batch = $_GET["batch"];
$dept = $_GET["dept"];
$dob = $_GET["dob"];
$fname = $_GET["fname"];
$lname = $_GET["lname"];
$mname = $_GET["mname"];
$father = $_GET["father"];
$mother = $_GET["mother"];
$smobile = $_GET["smobile"];
$pmobile = $_GET["pmobile"];
$semail = $_GET["semail"];
$pemail = $_GET["pemail"];
$hno = $_GET["hno"];
$address1 = $_GET["address1"];
$address2 = $_GET["address2"];
$pincode = $_GET["pincode"];
$street = $_GET["street"];
$query = "select * from users where uid='$id'";
$result = mysqli_fetch_array(mysqli_query($db,$query));
if ($uid == "")
{
	$uid = $result["uid"];
}
if ($batch == "")
{
	
	$batch = $result["batch"];
}
if ($dept == "")
{
	$dept = $result["dept"];
}
if ($fname == "")
{
	$fname = $result["fname"];
}
if ($mname == "")
{
	$mname = $result["mname"];
}
if ($lname == "")
{
	$lname = $result["lname"];
}
if ($father == "")
{
	$father = $result["father"];
}
if ($mother == "")
{
	$mother = $result["mother"];
}
if ($semail == "")
{
	$semail = $result["semail"];
}
if ($pemail == "")
{
	$pemail = $result["pemail"];
}
if ($hno == "")
{
	$hno = $result["hno"];
}
if ($street == "")
{
	$street = $result["street"];
}
if ($address1 == "")
{
	$address1 = $result["address1"];
}
if ($address2 == "")
{
	$address2 = $result["address2"];
}
if ($pincode == "")
{
	$pincode = $result["pincode"];
}

	
	$sql = "UPDATE `users` SET `uid`='$uid',`batch`='$batch',`fname`='$fname',`mname`='$mname',`lname`='$lname',`dob`='$dob',`father`='$father',`mother`='$mother',`smobile`='$smobile',
	`pmobile`='$pmobile',`semail`='$semail',`pemail`='$pemail',`dept`='$dept',`hno`='$hno',`street`='$street',`address1`='$address1',`address2`='$address2',`pincode`='$pincode' WHERE uid='$id'";
if (mysqli_query($db,$sql))
{
echo "profile updated Successfully";
}	
?>