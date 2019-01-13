<?php
include("../../../includes/config.php");
include("../../../includes/session.php");
include("../../../includes/functions.php");
$question = $_GET['question'];
$category = $_GET['category'];
$postedby = $_GET['postedby'];
$user = $_SESSION['login_user'];
$date = gmDate("Y-m-d");
if ($question == "")
{
	echo '<div class="alert alert-danger alert-dismissable">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
    <strong>Alert!</strong> Please enter a valid Question.
  </div>';
}
else if (strlen($question) > "512")
{
	echo '<div class="alert alert-danger alert-dismissable">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
    <strong>Sorry!</strong> Make sure your question length is not more than 512 chars.
  </div>';
}
else if ($category == "0")
{
	echo '<div class="alert alert-danger alert-dismissable">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
    <strong>Alert!</strong> Please select a category.
  </div>';
}
else if (strlen($category) > "64")
{
	echo '<div class="alert alert-danger alert-dismissable">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
    <strong>Sorry!</strong> Make sure your category length is not more than 64 chars.
  </div>';
}
else
{
	$query = "INSERT INTO `forum_q`(`by_user`, `display_name`, `posted_on`, `status`, `category`, `question`) VALUES ('$user','$postedby','$date','open','$category','$question')";
	if (mysqli_query($db,$query))
	{
		echo '<div class="alert alert-success alert-dismissable">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
    <strong>SUCCESS!</strong> Question Successfully Posted.Check Soon for Answers.
  </div>';
	}
}
?>