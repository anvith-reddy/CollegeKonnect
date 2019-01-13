<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<?php
	include("../../../includes/config.php");
	$event_id = $_GET['id'];
	$fetch_details = "select * from events where id='$event_id'";
	$event_data = mysqli_fetch_array(mysqli_query($db,$fetch_details));
	$delete_count=0;
	$query1="DELETE FROM `events` WHERE id='$event_id'";
	for($i=0;$i<$event_data["attachment"];$i++)
	{
		$query2="DELETE FROM `files` WHERE categoryid='$event_id' and category='event'";
		if (mysqli_query($db,$query2)) {
		$delete_count = $delete_count + 1; }
	}
	if((mysqli_query($db,$query1)) && ($event_data["attachment"]==$delete_count))
	{
		header("location: index.php");
	}
	else
	{
		echo "Unable to delete Event.";
	}
?>
