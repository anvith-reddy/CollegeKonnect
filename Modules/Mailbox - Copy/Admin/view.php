<?php
include("../../../includes/session.php");
include("../../../includes/functions.php");
include("../../../includes/config.php");
$mail = $_GET['mail'];
$user = $_SESSION['login_user'];
$sql="select * from mail where id='$mail'";
$row=mysqli_fetch_array(mysqli_query($db,$sql));
if(isset($_POST['reply'])) 
{
	$to = $_POST['to'];
	$from = $_SESSION['login_user'];
	$subject = $_POST['subject'];
	$message = $_POST['message'];
	$mdate = date("Y-m-d H:i:s");
	if (empty($_FILES['userfile']['name'])) $attachment = "0";
	else $attachment = "1";
	
	if ($to == "")
	{
		echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Enter receiver id')
    window.location.href='index.php';
    </SCRIPT>");
	}
	else if($subject == "" && $message == "" && $attachment == "0")
	{
		echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Invalid or Empty Mail')
    window.location.href='index.php';
    </SCRIPT>");
	}
	else
	{
		$contents = "INSERT INTO `mail`(`sender`, `receiver`, `mdate`, `subject`, `message`, `sent`, `received`,`strash`,`sarchived`,`rtrash`,`rarchived`) 
		VALUES ('$from','$to','$date','$subject','$message','1','1','0','0','0','0')";
		if ($db->query($contents) === TRUE)
		{
			$inserted = $db->insert_id;
			if ($attachment == "1")
			{
				for($i=0;$i<$count;$i++)
			{
				$filename = $_FILES['userfile']['name'][$i];
				$tmpname = $_FILES['userfile']['tmp_name'][$i];
				$file_size = $_FILES['userfile']['size'][$i];
				$file_type = $_FILES['userfile']['type'][$i];
				$ext = pathinfo($filename, PATHINFO_EXTENSION);
			
				$fp      = fopen($tmpname, 'r');
				$content = fread($fp, filesize($tmpname));
				$content = addslashes($content);
				fclose($fp);
				
				$final = "INSERT INTO `files`(`by_user`,`name`, `type`, `size`, `data`, `category`, `categoryid`) 
				VALUES('$user','$filename','$file_type','$file_size','$content','mail','$inserted')";
				if(mysqli_query($db,$final)) { header("location: index.php?message=success"); }
			}
			}
			else header("location: index.php?message=success"); 
		}
		else
		{
			echo '<script type="javascript">';
			echo 'alert("Unable to send Temporarily ")';
			echo '</script>';
		}
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

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <script>
$(document).ready(function(){
    $("#compose").click(function(){
        $("#send_mail").modal();
    });
});
</script>
<script>
function reply()
{
	$("#send_mail").modal();
}
function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
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
        MAILBOX
      </h1>
      
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box" id="print">
        <div class="box-header with-border">
          <h3 class="box-title">View Mail</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-primary " onclick="reply()" id="compose"><i class="fa fa-mail-reply"></i></button>
			<button type="button" class="btn btn-primary " onclick="printDiv('print')" id="compose"><i class="fa fa-print"></i></button>
			<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
          </div>
        </div>
		<div class="container">
  

  <!-- Modal -->
  <div class="modal fade" id="send_mail" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" style="padding:35px 50px;">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4><span class="glyphicon glyphicon-envelope"></span> Reply to <?php echo strtoupper($row[3]);?>.</h4>
        </div>
        <div class="modal-body" style="padding:40px 50px;">
          <form role="form" enctype="multipart/form-data" id="compose-mail" action="" method="post">
		  
            <div class="form-group">
              <input type="text" class="form-control" name="to" value="<?php echo $row[3]; ?>"placeholder="TO :">
            </div>
            <div class="form-group">
              <input type="text" class="form-control" name="subject" placeholder="Subject :">
            </div>
			<div class="box-body pad">
			<textarea class="textarea form-control" name="message"></textarea>
			</div>
			<div class="form-group">
                
                  <input type="file" name="userfile[]" multiple >
                
                <p class="help-block">Max. 32MB</p>
              </div>
              <input type="submit" class="btn btn-success btn-block" name="reply" value="Reply">
          </form>
        </div>
        
      </div>
      
    </div>
  </div> 
</div>

        <div class="box-body">
          <div class="container">
				<h3><?php echo $row["subject"]; ?></h3>
				<h5><i class="fa fa-user">&nbsp;</i><b><?php echo strtoupper($row["sender"]);?></b>&nbsp;&nbsp;on&nbsp;&nbsp;	<small> <?php echo $row["mdate"]; ?></small></h5>
				</div>
				<div class="well well-sm"><?php echo $row["message"]; ?></div>
				</div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
		<?php
			$fetchfilecount = "select count(*) from files where category='mail' AND categoryid = '$mail'";
			$filecount = mysqli_fetch_row(mysqli_query($db,$fetchfilecount));
			$count1 = $filecount[0];
			if ($count1 > 0)
			{
				$sql="SELECT * FROM files where categoryid='$mail' AND category='mail'";
				$result_set=mysqli_query($db,$sql);
				if (mysqli_num_rows($result_set) == 0) 
				{
					echo "No Attachments";
				} 
				else 
				{
					while (list($id, $by_user, $name,$type,$size,$data) = mysqli_fetch_array($result_set)) 
					{
						$ext = pathinfo($name, PATHINFO_EXTENSION);
						if($ext=="doc"||$ext=="docx")
						{
				?>			<a href="download.php?id=<?php echo $id; ?>"><figure><i class="fa fa-file-word-o" style="font-size:40px;" ></i><figcaption><?php echo $name; ?></figcaption></figure></a>
				<?php
						}
						else if($ext=="pdf"||$ext=="PDF")
						{
				?>			<a href="download.php?id=<?php echo $id; ?>"><figure><i class="fa fa-file-pdf-o" style="font-size:40px;" ></i><figcaption><?php echo $name; ?></figcaption></figure></a>
				<?php
						}
						else if($ext=="xls"||$ext=="xlsx"||$ext=="XLSX"||$ext=="XLS")
						{
				?>
							<a href="download.php?id=<?php echo $id; ?>"><figure><i class="fa fa-file-excel-o" style="font-size:40px;" ></i><figcaption><?php echo $name; ?></figcaption></figure></a>
				<?php
						}
						else if($ext=="jpeg"||$ext=="jpg"||$ext=="png"||$ext=="JPEG"||$ext=="JPG"||$ext=="PNG"||$ext=='gif'||$ext=='GIF')
						{
				?>
							<a href="download.php?id=<?php echo $id; ?>"><figure><i class="fa fa-file-image-o" style="font-size:40px;" ></i><figcaption><?php echo $name; ?></figcaption></figure></a>
				<?php
						}
						else
						{
				?>			<a href="download.php?id=<?php echo $id; ?>"><figure><i class="fa fa-file" style="font-size:40px;" ></i><figcaption><?php echo $name; ?></figcaption></figure></a>
				<?php
						}    
					}
				}
			}
			else
			{
				echo "No Attachments";
			}
		?>
        </div>
        <!-- /.box-footer-->
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
