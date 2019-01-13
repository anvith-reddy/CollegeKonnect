<?php
include("../../../includes/session.php");
include("../../../includes/functions.php");
include("../../../includes/config.php");
$user=$_SESSION['login_user'];
date_default_timezone_set('Asia/Kolkata');
if (isset($_POST["submit"])) 
{
	$posted_on = date("Y-m-d H:i:s");
	$event_name=$_POST['event'];
	$certificate_type=$_POST['type'];
	$notes=$_POST['notes'];
	$held_at=$_POST['place'];
	$edate=$_POST['date'];
	$sem = $_POST['semester'];
	
	if (empty($_FILES['userfile']['name'])) $attachment = "0";
	else $attachment = "1";
	
	if($edate > $posted_on)
	{		echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Invalid Event Date')
    window.location.href='index.php';
    </SCRIPT>");
	}
	if($event_name == "")
	{
		echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Enter Event Name')
    window.location.href='index.php';
    </SCRIPT>");	
	}
	else if($held_at=="")
	{
		echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Please Enter Location')
    window.location.href='index.php';
    </SCRIPT>");
	}
	else if($edate=="")
	{
		echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Please select event date')
    window.location.href='index.php';
    </SCRIPT>");
	}
	else if($edate > $posted_on)
	{
		echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Event date isn't valid')
    window.location.href='index.php';
    </SCRIPT>");
	}
	else if($sem=="")
	{
		echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Select Semester')
    window.location.href='index.php';
    </SCRIPT>");
		
	}
	else if($certificate_type=="")
	{
		echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Select Certificate Type')
    window.location.href='index.php';
    </SCRIPT>");
	}
	else
	{	
		$contents = "INSERT INTO `achievements`(`by_user`, `posted_on`, `edate`, `event_name`, `held_at`, `semester`, `certificate_type`, `notes`, `attachment`) 
		VALUES ('$user','$posted_on','$edate','$event_name','$held_at','$sem','$certificate_type','$notes','$attachment')";
		if ($db->query($contents) === TRUE)
		{
			$inserted = $db->insert_id;
			if ($attachment == 1)
			{
				$filename = $_FILES['userfile']['name'];
				$tmpname = $_FILES['userfile']['tmp_name'];
				$file_size = $_FILES['userfile']['size'];
				$file_type = $_FILES['userfile']['type'];
				$ext = pathinfo($filename, PATHINFO_EXTENSION);
			
				$fp      = fopen($tmpname, 'r');
				$content = fread($fp, filesize($tmpname));
				$content = addslashes($content);
				fclose($fp);
				
				$final = "INSERT INTO `files`(`by_user`, `name`, `type`, `size`, `data`, `category`, `categoryid`) 
				VALUES('$user', '$filename','$file_type','$file_size','$content','achievement','$inserted')";
				if(mysqli_query($db,$final))
				{
					header("location: index.php?message=success");
				}
			}
			header("location: index.php?message=success");
		}
		else
		{
			echo ("<SCRIPT LANGUAGE='JavaScript'>
			window.alert('Unable to Send Temporarily. Please check your Inputs...')
			window.location.href='index.php';
			</SCRIPT>");
		}
	}
}
function trash($id)
{
	$sql="delete from achievements` where id='$id'";
	$sql2="delete from files where categoryid='$id' AND category='achievement'";
	if((mysqli_query($db,$sql)) && (mysqli_query($db,$sql2)))
	{
		header("location: index.php?message=deleted");
	}
}
?><!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>KITSW zone | Student</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="../../../bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../../dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="../../../dist/css/skins/_all-skins.min.css">
  
  
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="../../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
	

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script>
function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}
</script>

<!-- START@ Function for Invoking Modal to display success messages for User -->
<?php
	if (isset($_GET['message']))
	{
?>
		<script>
			$(document).ready(function(){
			$("#myModal").modal('show');
			});
		</script>
<?php	
}
?>
<!-- END@ Function for Invoking Modal to display success messages for User -->
</head>
<body class="hold-transition skin-blue sidebar-mini">
	<div class="wrapper">
		<?php include("../../../includes/header.php"); ?> <!-- Header File -->
	
		<aside class="main-sidebar">
			<section class="sidebar">
				<?php include("../../../includes/smenu.html"); ?> <!-- sidebar menu -->
			</section>
		</aside>
		
		<div class="content-wrapper"> <!-- START@ Content Wrapper. Contains page content -->
		
			<section class="content-header">
				<h1>ACHIEVEMENTS</h1>
			</section>

			<section class="content"> <!-- Main content -->
				<div id="printdata" style="display: none;"><!-- START@ Printing Content -->
					<div class="row">
						<div class="col-xs-12">
							<div class="box">
								<div class="box-header">
									<h4><b style="text-transform:uppercase"><?php echo $user; ?></b>'s Achievements</h4>
								</div>
								<div class="box-body table-responsive no-padding">
									<table class="table table-hover" border="1px">
										<tr>
											<th>Event Name</th>
											<th>Held at</th>
											<th>Event Date</th>
											<th>Semester</th>
											<th>Certification Type</th>
										</tr>
										<?php 
											$records = "select * from achievements`where user = '$user'";
											$object = mysqli_query($db,$records);
											$reccount = mysqli_num_rows($object);
											foreach ($object as $row) 
											{
										?>
										<tr>
											<td><?php echo $row['event_name']; ?></td>
											<td><?php echo $row['held_at']; ?></td>
											<td><?php echo $row['edate']; ?></td>
											<td><?php echo $row['semester']; ?></td>
											<td><?php echo $row['certificate_type']; ?></td>
										</tr>
										<?php
											} 
										?>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div><!-- END@ Printing Content -->
			
				<div class="container"> <!-- START@ Modal for giving messages to User-->
					<div id="myModal" class="modal fade" role="dialog">
						<div class="modal-dialog modal-sm">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal">&times;</button>
									<?php 
										if (($_GET['message'])=='success')
										{ 
									?>
									<center><i class="fa fa-check-circle-o" style="font-size:100px;color:green;"></i></center>
									<center><h4>Achievement Successfully Added</h4></center>
									<?php 
										}
										else if (($_GET['message'])=='deleted') 
										{
									?>
									<center><i class="fa fa-trash" style="font-size:100px;color:red;"></i></center>
									<center><h4>Achievement Successfully Deleted</h4></center>
									<?php 
										} 
									?>
								</div>
							</div>
						</div>
					</div>
				</div><!-- END@ Modal for giving messages to User-->
				
				<div class="modal fade" id="newachievement" role="dialog"><!-- START@ Form for New Achievement -->
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header" style="padding:35px 50px;">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4><span class=""></span>Add New Achievement.</h4>
							</div>
							<div class="modal-body" style="padding:40px 50px;">
								<form class="form-horizontal" role="form" enctype="multipart/form-data" method="post">
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-3 control-label">Event Name</label>
                                        <div class="col-sm-8">
											<input type="text" name="event" class="form-control" value="<?php echo isset($_POST["event"]) ? $_POST["event"] :'';?>" placeholder="Enter Event Name of your Certificate">
                                        </div>
                                    </div>
									<div class="form-group">
                                        <label for="inputEmail3" class="col-sm-3 control-label">Held at</label>
                                        <div class="col-sm-8">
											<input type="text" name="place" class="form-control"  value="<?php echo isset($_POST["place"]) ? $_POST["place"] :'';?>"placeholder="Event Held at">
                                        </div>
                                    </div>
									<div class="form-group">
                                        <label for="inputEmail3" class="col-sm-3 control-label">Held on</label>
                                        <div class="col-sm-8">		
											<input type="date" name="date" value="<?php echo isset($_POST["date"]) ? $_POST["date"] :'';?>"class="form-control">
										</div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Semester</label>
                                        <div class="col-sm-8">
											<select name="semester" class="form-control">
												<option value=""> Semester </option>
												<option value="1">1</option>
												<option value="2">2</option>
												<option value="3">3</option>
												<option value="4">4</option>
												<option value="5">5</option>
												<option value="6">6</option>
												<option value="7">7</option>
												<option value="8">8</option>
											</select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Certificate Type :</label>
                                        <div class="col-sm-8">
                                            <select name="type" class="form-control">
												<option value=""> Type </option>
												<option value="merit-1"> Merit-I</option>
												<option value="merit-2"> Merit-II</option>
												<option value="merit-3"> Merit-III</option>
												<option value="winner"> Winner</option>
												<option value="runner"> Runner</option>
												<option value="appreciation"> Appreciation </option>
												<option value="participation"> Participation </option>
												<option value="organisation"> Event Organiser </option>
											</select>
                                        </div>
                                    </div>
									<div class="form-group">
                                        <label for="inputPassword4" class="col-sm-3 control-label">Notes :</label>
                                        <div class="col-sm-8">
											<textarea name="notes" class="form-control"  value="<?php echo isset($_POST["notes"]) ? $_POST["notes"] :'';?>"placeholder="Additional Notes"> </textarea>
                                        </div>
                                    </div>
									<div class="form-group" class="col-sm-6">
										<div class="col-sm-8">
											<center> <input name="userfile" align="center" type="file"/> </center>
										</div>
									</div>
                                    <div class="form-group m-b-0">
                                        <div class="col-sm-offset-3 col-sm-8">
											<button type="submit" name="submit" class="btn btn-info pull-right">Submit</button>
                                        </div>
                                    </div>
                                </form>
							</div>
						</div>
					</div>
				</div><!-- END@ Form for New Achievement --> 
			
				<div class="box"> <!-- Main Content -->
					<div class="box-header with-border">
						<h3 class="box-title">Achievements Gallery</h3>
						<div class="box-tools pull-right">
							<button type="button" class="btn btn-info" data-toggle="modal" data-target="#newachievement"><i class="fa fa-file-o"></i></button>
							<button type="button" class="btn btn-info" onclick="printDiv('printdata')"><i class="fa fa-print"></i></button>
							<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
						</div>
					</div>
					<div class="box-body">
						<div class="container">
							<div class="row port">
								<div class="portfolioContainer">
								<?php
									$records = "SELECT * FROM `achievements` WHERE by_user='$user'";
									$object = mysqli_query($db,$records);
									$reccount = mysqli_num_rows($object);

									if ($reccount > 0) 
									{
										while($row1 = $object->fetch_assoc()) 
										{
											$iid = $row1["id"];
											$image = "SELECT * FROM files WHERE categoryid = '$iid'";
											$sth = $db->query($image);
											$result=mysqli_fetch_array($sth);
								?>
									<div class="col-sm-6 col-lg-3 col-md-4 graphicdesign illustrator photography">
										<div class="gal-detail thumb">
											<figure>
												<a href="image.php?id=<?php echo $result['id']; ?>&achievement=<?php echo $row1['id']; ?>" class="image-popup">
													<?php echo '<img src="data:image/jpeg;base64,'.base64_encode( $result['data'] ).'" width="150" height="100" class="thumb-img"/>';?>
												</a>
												<figcaption>
													<b><a href="edit.php?fid=<?php echo $result['id']; ?>&achievement=<?php echo $row1['id']; ?>"><?php echo strtoupper($row1["event_name"]); ?></a></b>
													<div class="box-tools pull-left">
														<a href="edit.php?fid=<?php echo $result['id']; ?>&achievement=<?php echo $row1['id']; ?>"><button type="button" class="btn btn-xs btn-info"><i class="fa fa-pencil-square-o" style="font-size:10px;"></i></button></a>
														<a href="delete.php?fid=<?php echo $result['id']; ?>&achievement=<?php echo $row1['id']; ?>"><button type="button" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button></a>
													</div>
												</figcaption>
											</figure>
										</div>
										<hr>
									</div>
								<?php
										}
									}
									else 
									{
										echo '<div class="alert alert-danger">
											<strong>Danger!</strong> This alert box could indicate a dangerous or potentially negative action.
											</div>';										
									} 
								?>
								</div>
							</div>
						</div>
                    </div>
				</div>
			</section>
		</div>
  <!-- END@ content-wrapper -->
  
  <?php include("../../../includes/footer.html"); ?> <!-- footer -->

</div>

<!-- jQuery 2.2.3 -->
<script src="../../../plugins/jQuery/jquery-2.2.3.min.js"></script>
<script src="../../../bootstrap/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="../../../dist/js/app.min.js"></script> 	
</body>
</html>
