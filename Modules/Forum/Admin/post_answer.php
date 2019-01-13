<?php
include("../../../includes/config.php");
include("../../../includes/session.php");
include("../../../includes/functions.php");
date_default_timezone_set('Asia/Kolkata');

$user = $_SESSION['login_user'];
$posted_on = date("Y-m-d H:i:s");
$answer = $_GET['answer'];
$qid = $_GET["qid"];
$by_user = $_GET["by_user"];
$query = "INSERT INTO `forum_a`(`qid`, `by_user`, `posted_on`, `display_name`, `answer`) 
VALUES ('$qid','$user','$posted_on','$by_user','$answer')";
mysqli_query($db,$query);
?>
