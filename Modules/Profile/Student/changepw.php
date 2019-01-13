<?php
include("../../../includes/session.php");
include("../../../includes/functions.php");
include("../../../includes/config.php");
$user = $_SESSION['login_user'];

$old = $_GET['oldpw'];
$new = $_GET['newpw'];
$confirm = password_hash($_GET['confirm'], PASSWORD_DEFAULT);
;

$query = "select password from login where username = '$user'";
$result = mysqli_fetch_array(mysqli_query($db,$query));

$change = "UPDATE `login` SET `password`='$confirm' WHERE username = '$user'";

if (password_verify($old, $result[0]))
{
 if (mysqli_query($db,$change))
	{
		echo "Password Changed Successfully";
	}
	else
	{
	echo "Please Contact Administrator";
	}
}
else
{
echo "wrong password entered";
}
?>