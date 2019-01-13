<?php
include("../../../includes/config.php");
$aid = $_GET['achievement'];
$records = "select * from achievements`where id = '$aid'";
$object = mysqli_query($db,$records);
$adetails=mysqli_fetch_array($object);

    if(isset($_GET['id'])) {
        $sql = "SELECT type,data FROM files WHERE id=" . $_GET['id'];
		$result = mysqli_query($db,$sql) or die("<b>Error:</b> Problem on Retrieving Image BLOB<br/>" . mysql_error());
		$row = mysqli_fetch_array($result);
		header("Content-type: " . $row["type"]);
		
        echo $row["data"];
		echo '<img src="data:image/jpeg;base64,'.base64_encode( $row['data'] ).'">';
	}
	mysqli_close($db);
?>