<?php
include("../../../includes/session.php");
include("../../../includes/config.php");
include("../../../includes/functions.php");
$date = gmDate("Y-m-d");
$user = $_SESSION['login_user'];

$forum = "select * from forum_q order by ID DESC limit 5";
$forres = mysqli_query($db,$forum);	

$notifi = "select * from features where type='notification' order by id desc";
$nnotres = mysqli_query($db,$notifi);

$evnt = "select * from events where scope='student' OR scope='local' OR scope='global' order by id desc";
$even = mysqli_query($db,$evnt);

$achievementscount = "select count(*) from achievements where by_user='$user'";
$achievementscount = mysqli_fetch_array(mysqli_query($db,$achievementscount));

$eventscount = "select count(*) from events where start_date >= '$date'";
$eventscount = mysqli_fetch_array(mysqli_query($db,$eventscount));

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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition skin-blue sidebar-mini">
	<div class="wrapper">
		<?php include("../../../includes/header.php"); ?> <!-- Header File -->
  
		<aside class="main-sidebar">
			<section class="sidebar">
				<?php include("../../../includes/smenu.html"); ?>
			</section>
		</aside>

		<div class="content-wrapper">
			<section class="content-header">
      <h1>
        Dashboard
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
	
	
	
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h4><b><?php echo live_session($user); ?></b></h4>

              
            </div>
            
            <a class="small-box-footer"><i class="fa"><b>Live Session</b></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h4><b><?php echo next_session($user); ?></b></h4>

              
            </div>
           
            <a class="small-box-footer"><i class="fa"><b>Next Session</b></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?php echo $achievementscount[0]; ?></h3>

              
            </div>
            <div class="icon">
              <i class="ion ion-archive"></i>
            </div>
            <a class="small-box-footer"><i class="fa"><b>My Achievements</b></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3><?php echo $eventscount[0]; ?></h3>

              
            </div>
            <div class="icon">
              <i class="ion ion-calendar"></i>
            </div>
            <a class="small-box-footer"><i class="fa"><b>Upcoming Events</b></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->
      <!-- Main row -->
	  
	  
	  <div class="row">
        <div class="col-md-6">
          <!-- Custom Tabs -->
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs pull-right">
              <li class="active"><a href="#notifications" data-toggle="tab">Notifications</a></li>
              <li><a href="#events" data-toggle="tab">Events</a></li>
              
              
              <li class="pull-left header"><i class="fa fa-th"></i> Alerts</li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="notifications">
			  <ul>
                <?php foreach($nnotres as $resnot)
				{
					echo '<li>';
					echo $resnot["title"];
					echo '</li>';
				}
				?>
				</ul>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="events">
                <ul>
				<?php foreach($even as $eveve)
				{
					echo '<li>';
					echo $eveve["title"];
					echo '</li>';
					
				}
				?>
				</ul>
              </div>
              
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- nav-tabs-custom -->
        </div>
        <!-- /.col -->

        <div class="col-md-6">
          <!-- Custom Tabs (Pulled to the right) -->
		  <div class="box box-primary">
          <div class="box-header">
              <i class="ion ion-clipboard"></i>

              <h3 class="box-title">Forum Threads</h3>

              
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <ul class="todo-list">
					
                  <!-- drag handle -->
                      
                  <!-- checkbox -->
                  <?php foreach($forres as $resf)
				  {
					  
				  ?>
				  <li>
                  <!-- todo text -->
                  <a href="../../Forum/Student/view.php?thread=<?php echo $resf["id"]; ?>"><span class="text"><?php echo $resf["question"]; ?></span></a>
                  <!-- Emphasis label -->
                  <small class="label label-info"><i class="fa fa-clock-o"></i> <?php echo $resf["posted_on"]; ?></small>
                  <!-- General tools such as edit or delete-->
				  </li>
                  <?php } ?>
                
                
              </ul>
            </div>
			
          </div>
            <!-- nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      
	  
	  
          

        </section>
        <!-- right col -->
      </div>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php include("../../../includes/footer.html"); ?>

  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  
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
