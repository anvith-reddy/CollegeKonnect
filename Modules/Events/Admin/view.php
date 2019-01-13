<?php
include("../../../includes/session.php");
include("../../../includes/functions.php");
include("../../../includes/config.php");
$user = $_SESSION['login_user'];
$event_id = $_GET['id'];
$content = "select * from events where id = '$event_id'";
$result1 = mysqli_fetch_array(mysqli_query($db,$content));
if (isset($_POST["update_event"])) 
{
	$fetch_details = "select * from events where id='$event_id'";
	$event_data = mysqli_fetch_array(mysqli_query($db,$fetch_details));
	$title=$_POST['title'];
	$start=$_POST['start'];
	$end=$_POST['end'];
	$email=$_POST['email'];
	$contact1=$_POST['contact1'];
	$contact2=$_POST['contact2'];
	$notes=$_POST['notes'];
	$scope=$_POST['scope'];
	if($title =="")
	{
		$title=$event_data['title'];
	}
	if($start =="")
	{
		$start=$event_data['start_date'];
	}
	if ($end=="")
	{
		$end=$event_data['end_date'];
	}
	if ($email=="")
	{
		$email=$event_data['email'];
	}
	if ($contact1=="")
	{
		$contact1=$event_data['contact1'];
	}
	if ($contact2 =="")
	{
		$contact2=$event_data['contact2'];
	}
	if ($notes=="")
	{
		$notes=$event_data['notes'];
	}
	
		$queryyyy= "update events set title='$title', start_date='$start', end_date='$end', notes='$notes', contact1='$contact1', contact2='$contact2',scope='$scope', email='$email' where id='$event_id'";
		if(mysqli_query($db,$queryyyy))
		{
			header("location: view.php?id=$event_id");
		}
		else {
			echo '<script>alert("Update of Event Details Failed")</script>';
		}
	
}

?>
<!DOCTYPE html>
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

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
	<script>
		//Function For Print Button
		function printDiv(divName) 
		{
			var printContents = document.getElementById(divName).innerHTML;
			var originalContents = document.body.innerHTML;
			document.body.innerHTML = printContents;
			window.print();
			document.body.innerHTML = originalContents;
		}
		
		//Function to show Edit Event Modal
		function edit_event()
		{
			$("#edit_event").modal();
		}
		
		//Function for Deleting Event
		function delete_event() 
		{
			var ajaxRequest;
			try
			{ 
				ajaxRequest = new XMLHttpRequest();
			}
			catch (e)
			{ 
				try
				{ 
					ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP"); 
				}
				catch (e) 
				{
					try
					{ 
						ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP"); 
					}
					catch (e)
					{ 
						alert("Your browser broke!"); 
						return false; 
					}
				}
			}
			ajaxRequest.onreadystatechange = function()
			{
				if(ajaxRequest.readyState == 4)
				{
					window.location.href = "index.php";
				}
			}
			var question = <?php echo $event_id; ?>;
			ajaxRequest.open("GET", "delete_event.php?id="+question, true);
			ajaxRequest.send(null); 
		}
	</script>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
	<?php include("../../../includes/header.php"); ?> <!-- Header File -->
	
	<aside class="main-sidebar">
		<section class="sidebar">
			<?php include("../../../includes/amenu.html"); ?> <!-- Side Menu -->
		</section>
	</aside>

	<div class="content-wrapper">
		<section class="content">
			<div class="modal fade" id="edit_event" role="dialog">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header" style="padding:35px 50px;">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4><span class=""></span>Edit Event.</h4>
						</div>
						<div class="modal-body" style="padding:40px 50px;">
							<form class="form-horizontal" role="form" method="post">
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
										<select name="scope">
											<option value="0">Scope</option>
											<option value="student">student</option>
											<option value="faculty">faculty</option>
											<option value="local">local</option>
											<option value="global">global</option>
										</select>
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
                                        <input type="text" name="contact1" class="form-control"  placeholder="Primary Contact No">
										<input type="text" name="contact2" class="form-control"  placeholder="Alternative Contact No">
                                    </div>
                                </div>		
								<div class="form-group">
                                    <label for="inputPassword4" class="col-sm-3 control-label">Short Notes :</label>
                                    <div class="col-sm-8">
										<textarea name="notes" class="form-control"  placeholder="Additional notes and external links"> </textarea>
                                    </div>
                                </div>
                                <div class="form-group m-b-0">
                                    <div class="col-sm-offset-3 col-sm-8 pull-right">
                                        <button type="submit" name="update_event" class="btn btn-info waves-effect waves-light">Update Event</button>
                                    </div>
                                </div>
                            </form>
						</div>
					</div>
				</div>
			</div>
			
			<div id="response">
			</div>	
			<div class="box box-default" id="print">
				<div class="box-header with-border">
					<h3 class="box-title">Event Details</h3>
					<div class="box-tools pull-right">					
						<?php if ($result1['by_user']==$user)
						{
						?>
							<button type="submit" name="edit" onclick="edit_event()" class="btn btn-box btn-info btn-sm"><i class="fa fa-pencil-square-o"></i></button>
							<button type="button" name="delete" onclick="delete_event()" class="btn btn-box btn-danger btn-sm"><i class="fa fa-trash"></i></button>							<?php
						}
						?>	
							<button type="button" class="btn btn-info" onclick="printDiv('print')"><i class="fa fa-print"></i></button>
							<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
					</div>					</div>
				<div class="box-body">
					<div class="row">
						<div class="col-md-6">
							<div class="box box-solid">
								<div class="box-header with-border">
									<h3 class="box-title"><b><?php echo $result1["title"]; ?></b></h3>
								</div>
								<div class="box-body">
									<div class="form-group">
										<div class="form-inline">
											<span class="input-group">
												<i class="fa fa-user" style="font-size:20px;color:black;">&nbsp;</i><i style="font-size:17px;">by</i>
											</span>
											<b style="font-size:17px;"> <?php echo strtoupper($result1["by_user"]); ?></b>
										</div>										</div>
									<div class="form-group">
										<div class="input-group">
											<span class="input-group-addon">
												<i class="fa fa-envelope-o" style="font-size:20px;"></i>
											</span>
											<input type="text" class="form-control" value="<?php echo $result1["email"];?>" disabled>											</div>
										</div>
									<div class="row">
										<div class="col-lg-6">
											<div class="input-group">
												<span class="input-group-addon">
													<i class="fa fa-calendar-check-o" style="font-size:20px;color:green;"></i>
												</span>
												<input type="text" class="form-control" value="<?php echo $result1["start_date"];?>" disabled>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="input-group">
												<input type="text" class="form-control" value="<?php echo $result1["end_date"]; ?>" disabled>
												<span class="input-group-addon">
													<i class="fa fa-calendar-times-o" style="font-size:20px;color:red;"></i>
												</span>
											</div>
										</div>
									</div>
									<br>
									<div class="row">
										<div class="col-lg-6">
											<div class="input-group">
												<span class="input-group-addon">
													<i class="fa fa-phone" style="font-size:20px;color:black;"></i>
												</span>
												<input type="text" class="form-control" value="<?php echo $result1["contact1"];?>" disabled>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="input-group">
												<span class="input-group-addon">
													<i class="fa fa-phone" style="font-size:20px;color:black;"></i>
												</span>
												<input type="text" class="form-control" value="<?php echo $result1["contact2"]; ?>" disabled>
											</div>
										</div>
									</div>
									<br>
									<div class="form-group">
										<div class="input-group">
											<span class="input-group-addon">
												<i class="fa fa-edit" style="font-size:20px;"></i>
											</span>
											<textarea class="form-control" value="<?php echo $result1['notes'];?>"placeholder="<?php echo $result1['notes'];?>" disabled></textarea>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="box box-solid">
								<div class="box-header with-border">
									<h3 class="box-title">Carousel</h3>
								</div>
								<div class="box-body">
									<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
										<?php 
											$images = "select name,data from files where categoryid = '$event_id' and category='event'";
											$result2 = mysqli_query($db,$images);
											$imgcount = mysqli_num_rows($result2);
											if ($imgcount > 0)
											{
										?>
											<ol class="carousel-indicators">
										<?php
											for($i=0;$i<$imgcount+1;$i++)
											{
										?>
											<li data-target="#myCarousel" data-slide-to="<?php echo $i; ?>" class="active"></li>
										<?php 
											} 
										?>
											</ol>
										<div class="carousel-inner">
											<div class="item active">
												<img class="img-responsive" src="https://www.w3schools.com/css/trolltunga.jpg" alt="Chicago">
											</div>
											<?php
												foreach($result2 as $images) 
												{
											?>
												<div class="item">
													<img class="img-responsive" src="data:image/jpeg;base64,<?php echo base64_encode( $images['data'] ); ?>"/>
												</div>
											<?php 
												}
											}
											?>
										</div>
									</div>
								</div>
								<a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
									<span class="fa fa-angle-left"></span>
								</a>
								<a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
									<span class="fa fa-angle-right"></span>
								</a>
						</div>
					</div>
				</div>
			</div>
		</section>    
	</div>
	<?php include("../../../includes/footer.html"); ?> <!-- Footer File -->
</div>

<!-- jQuery 2.2.3 -->
<script src="../../../plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.6 -->
<script src="../../../bootstrap/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="../../../dist/js/app.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="../../../dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../../dist/js/demo.js"></script>
</body>
</html>
