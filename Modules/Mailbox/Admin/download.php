<?php
	include("../../../includes/session.php");
	include("../../../includes/functions.php");
	include("../../../includes/config.php");

	if (isset($_GET['id'])) 
	{
		$id = $_GET['id'];
		$query = "SELECT * " ."FROM files WHERE id = '$id'";
		$result = mysqli_query($db,$query) or die('Error, query failed');
		list($id, $posted_by, $file, $type, $size,$content) = mysqli_fetch_array($result);
		header("Content-length: $size");
		header("Content-type: $type");
		header("Content-Disposition: attachment; filename=$file");
		ob_clean();
		flush();
		echo $content;
		mysqli_close($db);
		exit;
	}
?>