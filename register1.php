<?php
include("includes/config.php");
echo "readche";
$uid = $_GET["uid"];
echo $uid;
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

echo $dob;
echo $fname;
if ($uid == "0")
{
	echo "Please select Roll No";
}
if ($fname == "")
{
	echo "please Enter First Name";
}
if ($lname == "")
{
	echo "please enter Last Name";
}
if ($father == "")
{
	echo "Please enter Father Name";
}
if ($mother == "")
{
	echo "Please Enter Mother Name";
}
if ($semail == "")
{
	echo "Please Enter Your Email ID";
}
if ($pemail == "")
{
	echo "Please Enter Your Parents Email Id";
}
if ($hno == "")
{
	echo "Please enter house Num";
}
if ($street == "")
{
	echo "Please enter street";
}
if ($address1 == "")
{
	echo "Please enter address";
}
if ($pincode == "")
{
	echo "Please enter pincode";
}
$sql1 = "INSERT INTO `users`(`uid`, `batch`, `fname`, `mname`, `lname`, `dob`, `father`, `mother`, `smobile`, `pmobile`, `semail`, `pemail`, `dept`, `hno`, `street`, `address1`, `address2`, `pincode`, `role`, `privacy`) 
	VALUES ('$uid','14','$fname','$mname','$lname','$dob','$father','$mother','$smobile','$pmobile','$semail','$pemail','it','$hno','$street','$address1','$address2','$pincode','1','0')";
	
$sql2 = "INSERT INTO `login`(`username`) VALUES ('$uid')";
if (mysqli_query($db,$sql1) && mysqli_query($db,$sql2))
{
echo '<script type="javascript">';
echo 'alert("registerfkk")';
echo '</script>';
}	
?>