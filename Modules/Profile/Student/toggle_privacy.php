<?php
include("../../../includes/session.php");
include("../../../includes/functions.php");
include("../../../includes/config.php");
$user = $_SESSION['login_user'];
$query = "select privacy from users where uid = '$user'";
$result = mysqli_fetch_row(mysqli_query($db,$query));

if ($result[0] == 0 )
{
$privacy = "1";
}
else {
$privacy = "0";
}

$update = "update users set privacy = '$privacy' where uid ='$user'";
mysqli_query($db,$update);
?>