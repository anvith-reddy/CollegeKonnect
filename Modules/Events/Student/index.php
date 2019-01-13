<?php
include("../../../includes/session.php");
include("../../../includes/functions.php");
include("../../../includes/config.php");
$user=$_SESSION['login_user'];
date_default_timezone_set('Asia/Kolkata');
if (isset($_POST["submit"])) 
{
	$posted_on = date("Y-m-d H:i:s");
	$title=$_POST['title'];
	$start=$_POST['start'];
	$end=$_POST['end'];
	$contact1=$_POST['contact1'];
	$contact2=$_POST['contact2'];
	$email=$_POST['email'];
	$notes=$_POST['notes'];
	$scope = $_POST['scope'];
	
	if (empty($_FILES['userfile']['name'])) $attachment = "0";
	else $attachment = "1";
	
	if ($title == "")
	{
		echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Enter Event Title')
    window.location.href='index.php';
    </SCRIPT>");
	}
	else if($start == "" || $end == "")
	{
		echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Select start & end Dates')
    window.location.href='index.php';
    </SCRIPT>");
	}
	else if($start > $end || $start < $posted_on || $end < $posted_on)
	{
		echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Invalid start or end Dates')
    window.location.href='index.php';
    </SCRIPT>");
	}
	else if($contact1=="")
	{
		echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Enter Primary Contact No')
    window.location.href='index.php';
    </SCRIPT>");
	}
	else if($email=="")
	{
		echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Enter email')
    window.location.href='index.php';
    </SCRIPT>");
	}
	else if($email=="")
	{
		echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Select Scope of event')
    window.location.href='index.php';
    </SCRIPT>");
	}
	else 
	{	
		$contents = "INSERT INTO `events`(`by_user`,`posted_on`, `title`, `start_date`, `end_date`, `contact1`, `contact2`, `email`, `scope`, `notes`, `attachment`)
		VALUES ('$user','$posted_on','$title','$start','$end','$contact1','$contact2','$email','$scope','$notes','$attachment')";
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
				
				$final = "INSERT INTO `files` (`by_user`, `name`, `type`, `size`, `data`, `category`, `categoryid`) 
				VALUES ('$user','$filename','$file_type','$file_size','$content','event','$inserted')";
				if(mysqli_query($db,$final))
				{
					header("location: index.php?message=success");
				}
			
			}
			header("location: index.php?message=success");
		}
		else
		{
			echo '<script type="javascript">';
			echo 'alert("Unable to send Temporarily ")';
			echo '</script>';
		}
	}
}

?><!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>KITSW Konnect | Student</title>
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
	<style>
	@media print {
		a[href]:after {
		content: none !important;
		}
	}
	</style>
	
	<script>
	function newevent()
	{
		window.alert("sfk");
	}
	function printDiv(divName) 
	{
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
			$("#AlertMessages").modal('show');
			});
		</script>
	<?php	
	}
	?>
	<!-- END@ Function for Invoking Modal to display success messages for User -->

	<script type="text/javascript">//Function For Fetching All Events
        function displayRecords(e,t){$.ajax({type:"GET",url:"getfiles.php",data:"show="+e+"&pagenum="+t,cache:!1,beforeSend:function(){$(".loader").html('<img src="loader.gif" alt="" width="24" height="24" style="padding-left: 400px; margin-top:10px;" >')},success:function(e){$("div#files_data").html(e),$(".loader").html("")}})}function changeDisplayRowCount(e){displayRecords(e,1)}function displayRecord(e,t){$.ajax({type:"GET",url:"my_events.php",data:"show="+e+"&pagenum="+t,cache:!1,beforeSend:function(){$(".loader").html('<img src="loader.gif" alt="" width="24" height="24" style="padding-left: 400px; margin-top:10px;" >')},success:function(e){$("div#my_events_data").html(e),$(".loader").html("")}})}function changeDisplayRowCount(e){displayRecord(e,1)}$(document).ready(function(){displayRecords(10,1)}),$(document).ready(function(){displayRecord(10,1)});
    </script>
</head>
<body class="hold-transition skin-blue sidebar-mini">
	<div class="wrapper">
		<?php include("../../../includes/header.php"); ?><!-- Header File -->
	
		<aside class="main-sidebar">
			<section class="sidebar">      
				<?php include("../../../includes/smenu.html"); ?><!-- Side Menu -->
			</section>
		</aside>

		<div class="content-wrapper">
			<section class="content-header">
				<h1>EVENTS</h1>
			</section>

			<section class="content">
				<div class="modal fade" id="new_event" role="dialog">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header" style="padding:35px 50px;">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4><span class=""></span>Add New Event.</h4>
							</div>
							<div class="modal-body" style="padding:40px 50px;">
								<form class="form-horizontal" role="form" enctype="multipart/form-data" method="post">
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-3 control-label">Event Title :</label>
                                        <div class="col-xs-8">
                                            <input type="text" name="title" class="form-control"  placeholder="Title of Event">
                                        </div>
                                    </div>
									<div class="form-group">
                                        <label for="inputEmail3" class="col-sm-3 control-label">Email :</label>
                                        <div class="col-xs-8">
                                            <input type="text" name="email" class="form-control"  placeholder="Email for Contact...">
                                        </div>
                                    </div>
									<div class="form-group">
										<label for="inputPassword4" class="col-sm-3 control-label">Scope :</label>
										<div class="col-xs-8">                        
											<input type="radio" name="scope" value="student">Student ( KITSW )&nbsp;&nbsp;&nbsp;
											<input type="radio" name="scope" value="faculty">Faculty ( KITSW )&nbsp;<br>
											<input type="radio" name="scope" value="local">KITSW ( Student & Faculty )&nbsp;
											<input type="radio" name="scope" value="global">Open for All &nbsp;
										</div>
									</div>
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-3 control-label">Start & End Dates :</label>
                                        <div class="form-inline">
                                            <input type="date" name="start" class="form-control"  placeholder="Book's Edition...">
											<input type="date" name="end" class="form-control"  placeholder="Book's Edition...">
                                        </div>
                                    </div>
									<div class="form-group">
                                        <label for="inputEmail3" class="col-sm-3 control-label">Contact :</label>
                                        <div class="form-inline">
                                            <input type="text" name="contact1" class="form-control"  placeholder="Contact Number1...">
											<input type="text" name="contact2" class="form-control"  placeholder="Contact Number2...">
                                        </div>
                                    </div>		
									<div class="form-group">
                                        <label for="inputPassword4" class="col-sm-3 control-label">Short Notes :</label>
                                        <div class="col-sm-8">
                                            <textarea name="notes" class="form-control"  placeholder="Additional notes and external links"> </textarea>
                                        </div>
                                    </div>
									<div class="form-group" class="col-sm-6">
										<div class="col-sm-6">
											<center> <input name="userfile" align="center" type="file"/> </center>											
										</div>
									</div>
                                    <div class="form-group m-b-0">
                                        <div class="col-sm-offset-3 col-sm-8 pull-right">
                                            <button type="submit" name="submit" class="btn btn-info waves-effect waves-light">Submit</button>
                                        </div>
                                    </div>
                                </form>
							</div>
						</div>
					</div>
				</div> 
				
				<div class="container"> <!-- START@ Modal for giving messages to User-->
					<div id="AlertMessages" class="modal fade" role="dialog">
						<div class="modal-dialog modal-sm">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal">&times;</button>
									<?php 
										if (($_GET['message'])=='success')
										{ 
									?>
									<center><i class="fa fa-check-circle-o" style="font-size:100px;color:green;"></i></center>
									<center><h4>Event Successfully Added</h4></center>
									<?php 
										}
										else if (($_GET['message'])=='deleted') 
										{
									?>
									<center><i class="fa fa-trash" style="font-size:100px;color:red;"></i></center>
									<center><h4>Event Successfully Deleted</h4></center>
									<?php 
										} 
									?>
								</div>
							</div>
						</div>
					</div>
				</div><!-- END@ Modal for giving messages to User-->

				<div class="box">
					<div class="box-header with-border">
						<h3 class="box-title">Events Gallery</h3>
						<div class="box-tools pull-right">
							<button type="button" class="btn btn-info" data-toggle="modal" data-target="#new_event"><i class="fa fa-pencil-square-o"></i></button>
							<button type="button" class="btn btn-info" onclick="printDiv('files_data')"><i class="fa fa-print"></i></button>
							<button type="button" class="btn btn-info" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
						</div>
					</div>
					<div class="box-body">
						<div class="row">
							<div class="col-xs-12">
								<div class="box">
									<div class="box-body table-responsive no-padding" id="files_data">
									<!-- Here the Main Content of events is displayed-->
									</div>
								</div>
							</div>
						</div>
                    </div>
                </div>
				
				<div class="box">
					<div class="box-header with-border">
						<h3 class="box-title">My Events</h3>
						<div class="box-tools pull-right">
							<button type="button" class="btn btn-info" onclick="printDiv('my_events_data')"><i class="fa fa-print"></i></button>
							<button type="button" class="btn btn-info" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
						</div>
					</div>
					<div class="box-body">
						<div class="row">
							<div class="col-xs-12">
								<div class="box">
									<div class="box-body table-responsive no-padding" id="my_events_data">
									<!-- Here the Main Content of events is displayed-->
									</div>
								</div>
							</div>
						</div>
                    </div>
                </div>
			</section>
		</div>
		
		<?php include("../../../includes/footer.html"); ?><!-- Footer -->

	</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="../../../js/bootstrap.min.js"></script>
<!-- jQuery 2.2.3 -->
<script src="../../../plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>

<!-- AdminLTE App -->
<script src="../../../dist/js/app.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="../../../dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../../dist/js/demo.js"></script>
</body>
</html>
