<?php
include("../../../includes/session.php");
include("../../../includes/functions.php");
include("../../../includes/config.php");
$id = $_GET['id'];
$sql = "select type,data from files where categoryid = '$id' AND category = 'achievement'";

		$result = mysqli_query($db,$sql) or die("<b>Error:</b> Problem on Retrieving Image BLOB<br/>" . mysql_error());
		$row = mysqli_fetch_array($result);
		header("Content-type: " . $row["type"]);
		
		?>
		<div class="box box-widget widget-user">
		<?php
		echo '<img src="data:image/jpeg;base64,'.base64_encode( $row['data'] ).'">';
?>
            
			</div>';

