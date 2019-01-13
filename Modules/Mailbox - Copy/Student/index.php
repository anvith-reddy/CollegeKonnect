<?php
include("../../../includes/session.php");
include("../../../includes/functions.php");
include("../../../includes/config.php");
$user=$_SESSION['login_user'];
date_default_timezone_set('Asia/Kolkata');
if(isset($_POST['sendmail'])) 
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
		VALUES ('$from','$to','$mdate','$subject','$message','1','1','0','0','0','0')";
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
if(isset($_POST['delete'])) 
{
	$id = $_POST['value'];
	$mailer = mailer($id);
	if ($mailer=="sender")
	{
		$query="select strash from mail where id = '$id'";
		$result = mysqli_fetch_row(mysqli_query($db,$query));
		if ($result[0]=='0')
		{
			$query="update mail set sent='0', sarchived='0', strash='1' where id='$id'";
			if (mysqli_query($db,$query)) { header("location: index.php?message=trashed"); }
		}
		else if ($result[0]=="1")
		{
			$query="update mail set sent='0', strash='2',sarchived='0'  where id='$id'";
			if (mysqli_query($db,$query)) { header("location: index.php?message=deleted"); }
		}
	}
	else if ($mailer=='receiver')
	{
		$query="select rtrash from mail where id = '$id'";
		$result = mysqli_fetch_row(mysqli_query($db,$query));
		if ($result[0]=='0')
		{
			$query="update mail set received='0', rarchived='0', rtrash='1' where id='$id'";
			if (mysqli_query($db,$query)) { header("location: index.php?message=trashed"); }
		}
		else if ($result[0]=='1')
		{
			$query="update mail set received='0', rarchived='0', rtrash='2' where id='$id'";
			if (mysqli_query($db,$query)) { header("location: index.php?message=deleted"); }
		}
	}
}
if(isset($_POST['archive'])) 
{
	$id = $_POST['value'];
	$mailer = mailer($id);
	if ($mailer=='sender')
	{
			$query="update mail set sent='0', sarchived='1' where id='$id'";
			if (mysqli_query($db,$query)) { header("location: index.php?message=archived"); }
		
	}
	if ($mailer=='receiver')
	{
			$query="update mail set received='0', rarchived='1' where id='$id'";
			if (mysqli_query($db,$query)) { header("location: index.php?message=archived"); }
	}
}
?>
<!DOCTYPE html>
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
  <link rel="stylesheet" href="../../../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  
  <script>
function showUser(str) {
    if (str == "") {
        document.getElementById("mail-data").innerHTML = "";
        return;
    } else { 
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("forum_data").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","getdata.php?q="+str,true);
        xmlhttp.send();
    }
}
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script type="text/javascript">
	$(document).ready(function() {
		$('#keyword').on('input', function() {
			var searchKeyword = $(this).val();
			if (searchKeyword.length >= 3) {
				$.post('livesearch.php', { keywords: searchKeyword }, function(data) {
					$('table#search').empty()
					$.each(data, function() {
						$('table#search').append('<tr><td><a href="view.php?thread=' + this.id + '">' +  this.message + '</a></td></tr>');
					});
				}, "json");
			}
		});
	});
	</script>
	<script src="jquery-1.9.0.min.js"></script>
        
		<style>a:link {color: #000000}</style>
		<style>
  @media print {
  a[href]:after {
    content: none !important;
  }
}
</style>
		<script type="text/javascript">
        // fetching records
                            function sentmail(numRecords, pageNum) {
                                $.ajax({
                                    type: "GET",
                                    url: "sentmail.php",
                                    data: "show=" + numRecords + "&pagenum=" + pageNum,
                                    cache: false,
                                    beforeSend: function() {
                                        $('.loader').html('<img src="loader.gif" alt="" width="24" height="24" style="padding-left: 400px; margin-top:10px;" >');
                                    },
                                    success: function(html) {
										
                                        $("div#sentmail").html(html);
                                        $('.loader').html('');
                                    }
                                });
                            }

        // used when user change row limit
                            function changeDisplayRowCount(numRecords) {
                                sentmail(numRecords, 1);
                            }

                            $(document).ready(function() {
                                sentmail(10, 1);
                            });
							
							
        </script>
		<script type="text/javascript">
        // fetching records
                            function trash(numRecords, pageNum) {
                                $.ajax({
                                    type: "GET",
                                    url: "trash.php",
                                    data: "show=" + numRecords + "&pagenum=" + pageNum,
                                    cache: false,
                                    beforeSend: function() {
                                        $('.loader').html('<img src="loader.gif" alt="" width="24" height="24" style="padding-left: 400px; margin-top:10px;" >');
                                    },
                                    success: function(html) {
										
                                        $("div#trash").html(html);
                                        $('.loader').html('');
                                    }
                                });
                            }

        // used when user change row limit
                            function changeDisplayRowCount(numRecords) {
                                trash(numRecords, 1);
                            }

                            $(document).ready(function() {
                                trash(10, 1);
                            });
							
							
        </script>
		<script type="text/javascript">
        // fetching records
                            function archived(numRecords, pageNum) {
                                $.ajax({
                                    type: "GET",
                                    url: "archived.php",
                                    data: "show=" + numRecords + "&pagenum=" + pageNum,
                                    cache: false,
                                    beforeSend: function() {
                                        $('.loader').html('<img src="loader.gif" alt="" width="24" height="24" style="padding-left: 400px; margin-top:10px;" >');
                                    },
                                    success: function(html) {
										
                                        $("div#archived").html(html);
                                        $('.loader').html('');
                                    }
                                });
                            }

        // used when user change row limit
                            function changeDisplayRowCount(numRecords) {
                                archived(numRecords, 1);
                            }

                            $(document).ready(function() {
                                archived(10, 1);
                            });
							
							
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


<script type="text/javascript">
        // fetching records
                            function inbox(numRecords, pageNum) {
                                $.ajax({
                                    type: "GET",
                                    url: "inbox.php",
                                    data: "show=" + numRecords + "&pagenum=" + pageNum,
                                    cache: false,
                                    beforeSend: function() {
                                        $('.loader').html('<img src="loader.gif" alt="" width="24" height="24" style="padding-left: 400px; margin-top:10px;" >');
                                    },
                                    success: function(html) {
                                        $("div#inbox").html(html);
                                        $('.loader').html('');
                                    }
                                });
                            }

        // used when user change row limit
                            function changeDisplayRowCount(numRecords) {
                                inbox(numRecords, 1);
                            }

                            $(document).ready(function() {
                                inbox(10, 1);
                            });
							
							
        </script>
<script type="text/javascript">
        // fetching records
                           
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
	
<div class="container">
  

  <!-- Modal -->
  <div class="modal fade" id="send_mail" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" style="padding:35px 50px;">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4><span class="glyphicon glyphicon-envelope"></span> Compose New Message.</h4>
        </div>
        <div class="modal-body" style="padding:40px 50px;">
          <form role="form" enctype="multipart/form-data" id="compose-mail" action="" method="post">
		  
            <div class="form-group">
              <input type="text" class="form-control" name="to" placeholder="TO :">
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
              <input type="submit" class="btn btn-success btn-block" name="sendmail"><span class="glyphicon glyphicon-share"></span> Send</button>
          </form>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-basic btn-default pull-left" data-dismiss="modal"><span class="glyphicon glyphicon-draft"></span> Draft</button>
        </div>
      </div>
      
    </div>
  </div> 
</div>
				<div class="container"> <!-- START@ Modal for giving messages to User-->
					<div id="myModal" class="modal fade" role="dialog">
						<div class="modal-dialog modal-sm">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal">&times;</button>
									<?php 
										if (($_GET['message'])=='trashed')
										{ 
									?>
									<center><i class="fa fa-check-circle-o" style="font-size:100px;color:green;"></i></center>
									<center><h4>Mail Successfully sent to Trash</h4></center>
									<?php 
										}
										else if (($_GET['message'])=='deleted') 
										{
									?>
									<center><i class="fa fa-trash" style="font-size:100px;color:red;"></i></center>
									<center><h4>Mail Successfully Deleted</h4></center>
									<?php 
										}else if (($_GET['message'])=='success') 
										{
									?>
									<center><i class="fa fa-trash" style="font-size:100px;color:red;"></i></center>
									<center><h4>Mail Successfully Sent</h4></center>
									<?php 
										}
										else if (($_GET['message'])=='archived') 
										{
									?>
									<center><i class="fa fa-trash" style="font-size:100px;color:red;"></i></center>
									<center><h4>Mail Successfully sent to Archives</h4></center>
									<?php 
										}
									?>
								</div>
							</div>
						</div>
					</div>
				</div><!-- END@ Modal for giving messages to User-->


	
        <!-- /.col -->
        <div class="col-md-12" id="print">
          <div class="box">
            
            <div class="box-body">
             
			
        
        
          <!-- Custom Tabs (Pulled to the right) -->
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs pull-right">
			<li><button type="button" class="btn btn-info btn-sm" onclick="printDiv('print')"><i class="fa fa-print"></i></button></li>
			<li><button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#send_mail"><i class="fa fa-pencil"> </i></button></li>
              <li><a href="#trash" data-toggle="tab"><u>Trash</u></a></li>
              <li><a href="#archived" data-toggle="tab"><u>Archived</u></a></li>
              <li><a href="#sentmail" data-toggle="tab"><u>Sent</u></a></li>
			  <li class="active"><a href="#inbox" data-toggle="tab">Inbox</a></li>
              <li class="pull-left header"><i class="fa fa-envelope"></i> <b>MAILBOX</b></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="inbox">
                
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="sentmail">
                
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="archived">
                
              </div>
			  <div class="tab-pane" id="trash">
                
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          <!-- nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      
          </div>
          <!-- /. box -->
		  
        
        <!-- /.col -->
      
      <!-- /.row -->
    </section>
    
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php include("../../../includes/footer.html"); ?>
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
