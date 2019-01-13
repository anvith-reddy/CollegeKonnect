<?php
include("../../../includes/session.php");
include("../../../includes/functions.php");
include("../../../includes/config.php");
$user=$_SESSION['login_user'];
if (isset($_POST["submit"])) 
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
				
				$final = "update `users` set profile='$content' where uid='$user'";
				mysqli_query($db,$final);
				

}
$achievements = "select count(*) from achievements where by_user='$user'";
$achievements_count = mysqli_fetch_row(mysqli_query($db,$achievements));

$events = "select count(*) from events where by_user='$user'";
$events_count = mysqli_fetch_row(mysqli_query($db,$events));

$questions = "select count(*) from forum_q where by_user='$user'";
$questions_count = mysqli_fetch_row(mysqli_query($db,$questions));

$answers = "select count(*) from forum_a where by_user='$user'";
$answers_count = mysqli_fetch_row(mysqli_query($db,$answers));

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
  
  
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="../../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <script>
  function changepw(){
	var ajaxRequest;  // The variable that makes Ajax possible!
   try{
   
      // Opera 8.0+, Firefox, Safari
      ajaxRequest = new XMLHttpRequest();
   }catch (e){
      
      // Internet Explorer Browsers
      try{
         ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
      }catch (e) {
         
         try{
            ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
         }catch (e){
         
            // Something went wrong
            alert("Your browser broke!");
            return false;
         }
      }
   }
   
   // Create a function that will receive data
   // sent from the server and will update
   // div section in the same page.
   ajaxRequest.onreadystatechange = function(){
   
      if(ajaxRequest.readyState == 4){
         var ajaxDisplay = document.getElementById('response');
         ajaxDisplay.innerHTML = ajaxRequest.responseText;
      }
   }
   var oldpw = document.getElementById('oldpassword').value;
   var newpw = document.getElementById('newpassword').value;
   var confirmpw = document.getElementById('newpassword_confirm').value;
   if ( newpw != confirmpw)
   {
	   window.alert("Passwords donot match");
   }
   var queryString = "?oldpw=" + oldpw +"&newpw="+newpw +"&confirm="+confirmpw;
   ajaxRequest.open("GET", "changepw.php"+queryString, true);
   ajaxRequest.send(null); 
}
function toggle_status(){
	var ajaxRequest;  // The variable that makes Ajax possible!
   try{
   
      // Opera 8.0+, Firefox, Safari
      ajaxRequest = new XMLHttpRequest();
   }catch (e){
      
      // Internet Explorer Browsers
      try{
         ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
      }catch (e) {
         
         try{
            ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
         }catch (e){
         
            // Something went wrong
            alert("Your browser broke!");
            return false;
         }
      }
   }
   
   // Create a function that will receive data
   // sent from the server and will update
   // div section in the same page.
   ajaxRequest.onreadystatechange = function(){
   
      if(ajaxRequest.readyState == 4){
        $('#privacy_status').load(document.URL +  ' #privacy_status');
      }
   }
   
   ajaxRequest.open("GET", "toggle_privacy.php", true);
   ajaxRequest.send(null); 
}
</script>
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
				
				
				<!-- sidebar menu start -->
				<?php include("../../../includes/smenu.html"); ?>
				<!-- sidebar menu end -->
			</section>
		<!-- /.sidebar -->
		</aside>
<?php $query="select * from users where uid='$user'";
					$result = mysqli_fetch_assoc(mysqli_query($db,$query));?>
		<div class="container">
				<!-- Modal -->
					<div class="modal fade" id="uploadprofile" role="dialog">
						<div class="modal-dialog modal-sm">
							<!-- Modal content-->
							<div class="modal-content">
								
								<div class="modal-body" style="padding:10px 10px 0px 10px;">
									<div class="row">
									<div class="col-md-12">
          <!-- Widget: user widget style 1 -->
          <div class="box box-widget widget-user">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            
            <div class="box-footer">
              <div class="row">
                <form method="post" enctype="multipart/form-data">
				<div class="form-group" class="col-sm-6">
											<div class="col-sm-6">
												<center> <input name="userfile" class="form-group" align="center" type="file" /> </center>
											</div>
										</div>
										
                                        <div class="form-group m-b-0">
                                            <div class="col-sm-offset-3 col-sm-9">
												<input type="submit" name="submit" value="Upload" class="btn btn-info waves-effect waves-light">
                                            </div>
                                        </div>
										</form>
              </div>
              <!-- /.row -->
            </div>
          </div>
          <!-- /.widget-user -->
        </div>
		</div>
								</div>
							</div>
						</div>
					</div> 
				</div>
				

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i><?php echo strtoupper($result['uid']); ?></i>'s Profile
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-md-3">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
			
              <a href="javascript:void(0);" data-toggle="modal" data-target="#uploadprofile""><?php echo '<img class="profile-user-img img-responsive img-circle" src="data:image/jpeg;base64,'.base64_encode( $result['profile'] ).'" />'?></a>

              <h3 class="profile-username text-center"><?php echo ucwords($result['fname']." ".$result['mname']." ".$result['lname']); ?></h3>

              <p class="text-muted text-center">Dept of <?php echo strtoupper($result['dept']); ?></p>

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>Achievements</b> <a class="pull-right"><span class="badge bg-red"><?php echo $achievements_count[0]; ?></span></a>
                </li>
                <li class="list-group-item">
                  <b>Events</b> <a class="pull-right"><span class="badge bg-red"><?php echo $events_count[0]; ?></span></a>
                </li>
                <li class="list-group-item">
                  <b>Questions</b> <a class="pull-right"><span class="badge bg-red"><?php echo $questions_count[0]; ?></span></a>
                </li>
				<li class="list-group-item">
                  <b>Answers</b> <a class="pull-right"><span class="badge bg-red"><?php echo $answers_count[0]; ?></span></a>
                </li>
              </ul>

              
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#activity" data-toggle="tab">Profile</a></li>
              <li><a href="#settings" data-toggle="tab">Settings</a></li>
            </ul>
            <div class="tab-content">
              <div class="active tab-pane" id="activity">
                <!-- Post
                <div class="post">
                  <img class="img-responsive" src="data:image/jpeg;base64,<?php echo base64_encode( $result['profile'] ); ?>"/>
                </div>
                <!-- /.post -->

                <!-- Post -->
                <div class="box box-widget widget-user">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            
            <div class="box-footer">
              <div class="row">
                <div class="col-sm-4 border-right">
                  <div class="description-block">
                    <h5 class="description-header"><i class="fa fa-home"></i></h5>
                    <span class="badge"><?php echo $result["hno"]; echo '<br>'; echo $result["street"]."<br>".$result["address1"]."<br>".$result["address2"]; echo '<br>';echo $result['pincode']; ?></span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-4 border-right">
                  <div class="description-block">
                    <h5 class="description-header"><i class="fa fa-envelope-o"></i></h5>
                    <span class="badge"><i class="fa fa-user">    <b><?php echo $result["semail"]; ?></b></i></span><br>
					<span class="badge"><i class="fa fa-group">    <b><?php echo $result["pemail"]; ?></b></i></span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-4">
                  <div class="description-block">
                    <h5 class="description-header"><i class="fa fa-phone"></i></h5>
                    <span class="badge"><i class="fa fa-user">       <b><?php echo $result["smobile"]; ?></b></i></span><br>
					<span class="badge"><i class="fa fa-group">    <b><?php echo $result["pmobile"]; ?></b></i></span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
			<div class="box-footer no-padding">
              <ul class="nav nav-stacked">
                <li><a><b>Date of Birth </b><span class="pull-right badge bg-green"><?php echo $result["dob"]; ?></span></a></li>
                <li><a href="#"><b>Father's Name </b><span class="pull-right badge bg-aqua"><b><?php echo ucwords($result["father"]); ?></b></span></a></li>
                <li><a href="#"><b>Mother's Name </b><span class="pull-right badge bg-aqua"><b><?php echo ucwords($result["mother"]); ?></b></span></a></li>
              </ul>
            </div>
          </div>


             </div>

              <div class="tab-pane" id="settings">
			  <div class="row">
			  <div class="col-md-6">
			  <div class="box box-primary">
            <div class="box-header">
			Change Password
			</div>
			<div class="box-body">
			<div id="response"></div>
			<form class="form-horizontal">
                  <div class="form-group">

                    <div class="col-sm-12">
                      <input type="password" class="form-control" id="oldpassword" placeholder="Old Password...">
                    </div>
                  </div>
                  <div class="form-group">

                    <div class="col-sm-12">
                      <input type="password" class="form-control" id="newpassword" placeholder="New Password...">
                    </div>
                  </div>
				  <div class="form-group">

                    <div class="col-sm-12">
                      <input type="text" class="form-control" id="newpassword_confirm" placeholder="Confirm New Password...">
                    </div>
                  </div>
				  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="button" onclick="changepw()" class="btn btn-danger pull-right">Change Password</button>
                    </div>
                  </div>
                </form></div>
			</div>
			  </div>
			  <div class="col-md-6" id="privacy_status">
			  <div class="box box-primary">
            <div class="box-body box-profile">
			<?php $status_query = "select privacy from users where uid = '$user'";
			$privacy = mysqli_fetch_row(mysqli_query($db,$status_query));
			?>
			<b>Privacy :</b>
			<?php if ($privacy[0] == 1 )
					{
			?> 			
						<a onclick="toggle_status()" class="btn pull-right"><i style="color:green;font-size:25px;" class="fa fa-toggle-on"></i></a>
			<?php 	} 
					else if ($privacy[0] == 0 ) 
					{
			?> 			
						<a onclick="toggle_status()" class="pull-right"><i style="color:red;font-size:25px;" class="fa fa-toggle-off"></i></a>
			<?php 	} 
			?>
			</div>
			</div>
			  </div>
			  </div>
               
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.3.12
    </div>
    <strong>Copyright &copy; 2014-2016 <a href="http://almsaeedstudio.com">Almsaeed Studio</a>.</strong> All rights
    reserved.
  </footer>

  
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->
<script>

//-->
function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     new originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}
</script>
<script src="../../../plugins/jQuery/jquery-2.2.3.min.js"></script>
<script src="../../../bootstrap/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="../../../dist/js/app.min.js"></script> 	
</body>
</html>