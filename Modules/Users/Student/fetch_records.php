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

$record = "select * from users WHERE dept='$dept' AND batch='$result[0]'";
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
					<th>Name</th>
					<th>Mobile</th>
					<th>P-Mobile</th>
					<th>Email</th>
					<th>Operations</th>
				</tr>
    <?php 
					if ($record_result->num_rows > 0) 
					{
						foreach($record_result as $row)
						{
				?>
							<tr>
							<td> <?php echo $row["uid"]; ?> </td>
							<td> <?php echo $row["fname"];echo '&nbsp;';echo $row["mname"];echo '&nbsp;';echo $row["lname"]; ?></td>
							<td> <?php echo $row["smobile"]; ?> </td>
							<td> <?php echo $row["pmobile"]; ?> </td>
							<td> <?php echo $row["semail"]; ?> </td>
							<td><button class="btn btn-info btn-xs" onclick="edit_user('<?php echo $row["uid"]; ?>')"><i class="fa fa-pencil"></i></button>
							<button class="btn btn-danger btn-xs" onclick="delete_user('<?php echo $row["uid"]; ?>')"><i class="fa fa-trash"></i></button></td>
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