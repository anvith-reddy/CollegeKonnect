<?php
include("../../../includes/session.php");
include("../../../includes/functions.php");
include("../../../includes/config.php");
$user=$_SESSION['login_user'];
$aid=$_GET['achievement'];
$fid=$_GET['fid'];
$query="select * from achievements where id='$aid'";
$result = mysqli_query($db,$query);
$resul = mysqli_fetch_array($result);
if (isset($_POST["update"])) 
{
	$event_name=$_POST['event'];
	$certificate_type=$_POST['certificate_type'];
	$notes=$_POST['notes'];
	$held_at=$_POST['place'];
	$edate=$_POST['date'];
	$semester=$_POST['semester'];
	
	if($event_name == ""){ $event_name = $resul['event_name']; }
	if($semester=="") { $semester = $resul['semester']; }
	if($certificate_type=="") { $certificate_type = $resul['certificate_type']; }
	if($edate=="") { $edate = $resul['edate']; }
	if($held_at=="") { $held_at = $resul['held_at']; }
	if($notes=="") { $notes = $resul['notes']; }
	
	$contents = "UPDATE `achievements` SET `edate`='$edate',`event_name`='$event_name',`held_at`='$held_at',`semester`='$semester',`certificate_type`='$certificate_type',`notes`='$notes' WHERE id='$aid'";
	if (mysqli_query($db,$contents)) { header("Refresh:0"); }
	else
	{
		echo '<script type="javascript">';
		echo 'alert("Unable to send Temporarily ")';
		echo '</script>';
	}
}
if (isset($_POST["delete"])) 
{
	$query1="DELETE FROM `achievements` WHERE id='$aid'";
	$query2="DELETE FROM `files` WHERE id='$fid'";
	if((mysqli_query($db,$query1)) && (mysqli_query($db,$query2)))
	{
		header("location: index.php?message=deleted");
	}
}
?><!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | Dashboard</title>
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
  <!-- iCheck -->
  <link rel="stylesheet" href="../../../plugins/iCheck/flat/blue.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="../../../plugins/morris/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="../../../plugins/jvectormap/jquery-jvectormap-1.2.2.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="../../../plugins/datepicker/datepicker3.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="../../../plugins/daterangepicker/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="../../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <style>
  input[type="date"]:before {
    content: attr(placeholder) !important;
    color: #aaa;
    margin-right: 0.5em;
  }
  input[type="date"]:focus:before,
  input[type="date"]:valid:before {
    content: "";
  }
  </style>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
	<!-- header file start -->
	<?php include("../../../includes/header.php"); ?>
	<!-- header file end -->
	
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="../../../dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $_SESSION['login_user']; ?></p>
        </div>
      </div>
      
      <!-- sidebar menu start -->
      <?php include("../../../includes/smenu.html"); ?>
	  <!-- sidebar menu end -->
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        EDIT ACHIEVEMENT
        
      </h1>
      
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">Update Achievement Data :</h3>

          <div class="box-tools pull-right">
		  <form method="post">
		  
		  <button type="submit" name="delete" class="btn btn-box btn-danger btn-sm"><i class="fa fa-trash"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
			</form>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col-md-6">
			
              <form class="form-horizontal" role="form" enctype="multipart/form-data" method="post">
			  <?php $query="select * from achievements where id='$aid'";
$result = mysqli_query($db,$query);
 ?>
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-3 control-label">Event Name</label>
                                            <div class="col-sm-8">
												<input type="text" name="event" class="form-control"  placeholder="<?php echo $resul[4]; ?>">
                                            </div>
                                        </div>
										<div class="form-group">
                                            <label for="inputEmail3" class="col-sm-3 control-label">Held at</label>
                                            <div class="col-sm-8">
												<input type="text" name="place" class="form-control"  placeholder="<?php echo $resul[5]; ?>">
                                            </div>
                                        </div>
										<div class="form-group">
                                            <label for="inputEmail3" class="col-sm-3 control-label">Held on</label>
                                            <div class="col-sm-8">		
												<input type="date" name="date" class="form-control" placeholder="<?php echo $resul[3]; ?>">
											</div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Semester</label>
                                            <div class="col-sm-8">
												<select name="semester" class="form-control">
													<option value=""><?php echo $resul[6]; ?></option>
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
                                                <select name="certificate_type" class="form-control">
													<option value=""> <?php echo $resul[7]; ?> </option>
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
                    <label for="inputExperience" class="col-sm-3 control-label">Notes</label>

                    <div class="col-sm-8">
                      <textarea class="form-control" name="notes"  placeholder="<?php echo $resul[8]; ?>"></textarea>
                    </div>
                  </div>
										
										
                                        <div class="form-group m-b-0">
                                            <div class="col-sm-offset-3 col-sm-8">
												
												<button type="submit" name="update" class="btn btn-info waves-effect waves-light pull-right">Update</button>
                                            </div>
											
                                        </div>
                                    </form><!-- /.form-group -->
            </div>
            <!-- /.col -->
			
			


            <div class="col-md-6">
          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Your Uploads :</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <?php
			  $images = "select * from files where categoryid = '$aid' and category='achievement'";
  $result2 = mysqli_fetch_array(mysqli_query($db,$images));
			  ?>
			  <img class="img-responsive" src="data:image/jpeg;base64,<?php echo base64_encode($result2['data']); ?>"/>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php include("../../../includes/footer.html"); ?>

</div>
<!-- ./wrapper -->

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
<!-- Morris.js charts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="../../../plugins/morris/morris.min.js"></script>
<!-- Sparkline -->
<script src="../../../plugins/sparkline/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="../../../plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="../../../plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="../../../plugins/knob/jquery.knob.js"></script>
<!-- daterangepicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="../../../plugins/daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="../../../plugins/datepicker/bootstrap-datepicker.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="../../../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="../../../plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="../../../plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../../../dist/js/app.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="../../../dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../../dist/js/demo.js"></script>
</body>
</html>
