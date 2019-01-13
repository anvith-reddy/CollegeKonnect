<?php
include("../../../includes/session.php");
include("../../../includes/functions.php");
include("../../../includes/config.php");
$user=$_SESSION['login_user'];
date_default_timezone_set('Asia/Kolkata');


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
	<style>
	@media print {
		a[href]:after {
		content: none !important;
		}
	}
	</style>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="../../../js/bootstrap.min.js"></script>
	<script>
	function newachievement()
	{
		$("#newfile").modal();
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
	
	
	<script type="text/javascript">//Function For Fetching All Events
        function displayRecords(numRecords, pageNum) 
		{
            $.ajax({
                type: "GET",
                url: "getfiles.php",
                data: "show=" + numRecords + "&pagenum=" + pageNum,
                cache: false,
                beforeSend: function() {
                    $('.loader').html('<img src="loader.gif" alt="" width="24" height="24" style="padding-left: 400px; margin-top:10px;" >');
                },
                success: function(html) {
                    $("div#files_data").html(html);
                    $('.loader').html('');
                }
            });
        }

        // used when user change row limit
        function changeDisplayRowCount(numRecords) {
            displayRecords(numRecords, 1);
        }
        $(document).ready(function() {
            displayRecords(10, 1);
        });				
    
		//Function for Fetching Users Events
        function displayRecord(numRecords, pageNum) 
		{
            $.ajax({
                type: "GET",
                url: "my_events.php",
                data: "show=" + numRecords + "&pagenum=" + pageNum,
                cache: false,
                beforeSend: function() {
                    $('.loader').html('<img src="loader.gif" alt="" width="24" height="24" style="padding-left: 400px; margin-top:10px;" >');
                },
                success: function(html) {
                    $("div#my_events_data").html(html);
                    $('.loader').html('');
                }
            });
        }
		
        // used when user change row limit
        function changeDisplayRowCount1(numRecords) 
		{
            displayRecord(numRecords, 1);
        }
        $(document).ready(function() 
		{
            displayRecord(10, 1);
        });
		
		$(document).ready(function (e) {
	$("#add_event").on('submit',(function(e) {
		e.preventDefault();
		$.ajax({
        	url: "add_event.php",
			type: "POST",
			data:  new FormData(this),
			beforeSend: function(){$("#body-overlay").show();},
			contentType: false,
    	    processData:false,
			success: function(data)
		    {
			$("#add_event_response").html(data);
			},
		  	error: function() 
	    	{
	    	} 	        
	   });
	}));
});
    </script>
</head>
<body class="hold-transition skin-blue sidebar-mini">
	<div class="wrapper">
		<?php include("../../../includes/header.php"); ?><!-- Header File -->
	
		<aside class="main-sidebar">
			<section class="sidebar">      
				<?php include("../../../includes/amenu.html"); ?><!-- Side Menu -->
			</section>
		</aside>

		<div class="content-wrapper">
			<section class="content-header">
				<h1>EVENTS</h1>
			</section>
			<div id="response"></div>

			<section class="content">
				<div class="modal fade" id="newfile" role="dialog">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header" style="padding:35px 50px;">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4><span class=""></span>Add New Event.</h4>
							</div>
							<div id="add_event_response"></div>
							<div class="modal-body" style="padding:40px 50px;">
								<form class="form-horizontal" role="form" name="add_event" id="add_event" enctype="multipart/form-data" method="post">
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
											<center> <input name="userfile[]" multiple align="center" type="file" /> </center>											
										</div>
									</div>
                                    <div class="form-group m-b-0">
                                        <div class="col-sm-offset-3 col-sm-8 pull-right">
                                            <button type="submit" name="Add Event" onclick="add_event()" class="btn btn-info waves-effect waves-light">Submit</button>
                                        </div>
                                    </div>
                                </form>
							</div>
						</div>
					</div>
				</div> 
				
				<div class="box">
					<div class="box-header with-border">
						<h3 class="box-title">Events Gallery</h3>
						<div class="box-tools pull-right">
							<button type="button" class="btn btn-info" onclick="newachievement()"><i class="fa fa-pencil-square-o"></i></button>
							<button type="button" class="btn btn-info" onclick="printDiv('files_data')"><i class="fa fa-print"></i></button>
							<button type="button" class="btn btn-info" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
						</div>
					</div>
					<div class="box-body" >
						<div class="row" >
							<div class="col-xs-12">
								<div class="box" id="events1">
									<div class="box-body table-responsive no-padding" id="files_data">
									<!-- Here the Main Content of events is displayed-->
									</div>
								</div>
							</div>
						</div>
                    </div>
                </div>
				
				<div class="box" id="events3">
					<div class="box-header with-border" id="events4">
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
<!-- AdminLTE App -->
<script src="../../../dist/js/app.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="../../../dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../../dist/js/demo.js"></script>
</body>
</html>
