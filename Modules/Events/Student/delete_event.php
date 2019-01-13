<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<?php
include("../../../includes/config.php");
$id = $_GET['id'];
$query="delete from events where id='$id'";
if(mysqli_query($db,$query))
{
	?><script type="text/javascript">
    edit_event();
</script> <?php
}
else
{
	echo "some problem existing";
}
?>