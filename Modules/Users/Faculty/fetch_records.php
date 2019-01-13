<?php
//Include database connection
include("../../../includes/session.php");
include("../../../includes/functions.php");
include("../../../includes/config.php");
$user=$_SESSION['login_user'];
$batch = $_GET['batch'];
$dept = $_GET['dept'];

$batch_query = "select `".$batch."` from options where option='batch'";
$result = mysqli_fetch_array(mysqli_query($db,$batch_query));

$string = $result[0] . $dept;

$record = "select * from achievements where by_user LIKE '%".$string."%'";
$record_result = mysqli_query($db,$record);

?>
<div class="box-header with-border">
						<h3 class="box-title"><?php echo $dept; ?>`<?php echo $result[0]; ?> Batch</h3>
						
					</div>
					<div class="box-body">
						<div class="row">
							<div class="col-xs-12">
								<div class="box">
									<div class="box-body table-responsive no-padding" id="files_data">
									<div class="box-body table-responsive no-padding" id="forum_data">
              <table class="table table-hover" id="search">
			  <tr>
					<th>Roll No</th>
					<th>Event Name</th>
					<th>Venue</th>
					<th>Date</th>
					<th>Semester</th>
					<th>Certificate Type</th>
				</tr>
    <?php 
					if ($record_result->num_rows > 0) 
					{
						foreach($record_result as $row)
						{
				?>
							<tr onclick="document.location = 'edit.php?id=<?php echo $row["id"]; ?>';">
							<td> <?php echo $row["by_user"]; ?> </td>
							<td> <?php echo $row["event_name"]; ?></td>
							<td> <?php echo $row["held_at"]; ?> </td>
							<td> <?php echo $row["posted_on"]; ?> </td>
							<td> <?php echo $row["semester"]; ?> </td>
							<td> <?php echo $row["certificate_type"]; ?> </td>
						
							</tr>
				<?php
						}						
					}
				?>

</table>
									</div>	
								</div>
							</div>
						</div>
                    </div>