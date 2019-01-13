<?php
include("../../../includes/session.php");
include("../../../includes/functions.php");
include("../../../includes/config.php");
$user=$_SESSION['login_user'];
date_default_timezone_set('Asia/Kolkata');
?>
<!DOCTYPE html>
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
	<script>
	
	// Function for Calculating Attendance
	function calculate()
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
				var ajaxDisplay = document.getElementById('ac_response');
				ajaxDisplay.innerHTML = ajaxRequest.responseText;
			}
		}
		var percentage = document.getElementById('percentage').value;
		var total = document.getElementById('total').value;
		var present = document.getElementById('present').value;
		var queryString = "?percentage="+percentage+"&total="+total+"&present="+present;
		ajaxRequest.open("GET", "calculator.php"+queryString, true);
		ajaxRequest.send(null);
	}
	
	// Function For Searching Student
	$(document).ready(function() {
		$('#sp_keyword').on('input', function() {
			var searchKeyword = $(this).val();
			if (searchKeyword.length >= 3) {
				$.post('student_search.php', { keywords: searchKeyword }, function(data) {
					$('div#sp_response').empty()
					$.each(data, function() {
						$('div#sp_response').append('<li><a data-toggle="modal" data-id='+this.uid+' class="open-viewStudentDialog" href="#viewStudentDialog">' +  this.uid + " @ " + this.mname + " " + this.lname + " "+ this.fname + '</a></li>');
					});
				}, "json");
			}
		});
	});
	
	//Function For Searching Faculty
	$(document).ready(function() {
		$('#fp_keyword').on('input', function() {
			var searchKeyword = $(this).val();
			if (searchKeyword.length >= 3) {
				$.post('faculty_search.php', { keywords: searchKeyword }, function(data) {
					$('div#fp_response').empty()
					$.each(data, function() {
						$('div#fp_response').append('<li><a data-toggle="modal" data-id='+this.uid+' class="open-viewFacultyDialog" href="#viewFacultyDialog">' +  this.uid + " @ " + this.mname + " " + this.lname + " "+ this.fname + '</a></li>');
					});
				}, "json");
			}
		});
	});

	//Function For Viewing Faculty Profile after searching
	$(document).on("click", ".open-viewFacultyDialog", function () {
		var uid = $(this).data('id');
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
				var ajaxDisplay = document.getElementById('view_faculty');
				ajaxDisplay.innerHTML = ajaxRequest.responseText;
			}
		}
		var queryString = "?id="+uid;
		ajaxRequest.open("GET", "view_faculty.php"+queryString, true);
		ajaxRequest.send(null);
	});

	//Function For Viewing Student Profile after searching
	$(document).on("click", ".open-viewStudentDialog", function () {
		var uid = $(this).data('id');
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
				var ajaxDisplay = document.getElementById('view_student');
				ajaxDisplay.innerHTML = ajaxRequest.responseText;
			}
		}
		var queryString = "?id="+uid;
		ajaxRequest.open("GET", "view_student.php"+queryString, true);
		ajaxRequest.send(null);
	});
</script>
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
				<h1>WIDGETS</h1>
			</section>

			<section class="content"> <!-- Main content -->
				<div class="modal fade" role="dialog" id="viewFacultyDialog">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button class="close" data-dismiss="modal">×</button>
							</div>
							<div class="modal-body">
								<div id="view_faculty">
								</div>        
							</div>
						</div>
					</div>
				</div>

				<div class="modal fade" role="dialog" id="viewStudentDialog">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button class="close" data-dismiss="modal">×</button>
							</div>
							<div class="modal-body">
								<div id="view_student">
								</div>
							</div>
						</div>
					</div>
				</div>
				
				<div class="row">
					<div class="col-md-6">
						<div class="box box-solid">
							<div class="box-header with-border">
								<h3 class="box-title">Tools</h3>
							</div>
							<div class="box-body">
								<div class="box-group" id="accordion">
									<div class="panel box box-primary">
										<div class="box-header with-border">
											<h4 class="box-title">
												<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
													Attendance Calculator
												</a>
											</h4>
										</div>
										<div id="collapseOne" class="panel-collapse collapse in">
											<div class="box-body">
												<div class="col-xs-12">
													<input type="text" class="form-control" id="percentage" placeholder="Percentage Needed">
												</div>
												<hr>
												<div class="col-xs-4">
													<input type="text" class="form-control" id="total" placeholder="Total Classes">
												</div>
												<div class="col-xs-4">
													<input type="text" class="form-control" id="present" placeholder="Classes Present">
												</div>
												<div class="col-xs-4">
													<center><button type="button" class="btn btn-info" onclick="calculate()" >Calculate</button></center>
												</div>
												<div id="ac_response">
												</div>
											</div>
										</div>
									</div>
									<div class="panel box box-danger">
										<div class="box-header with-border">
											<h4 class="box-title">
												<a data-toggle="collapse" data-parent="#accordion" href="#student_profile">
													Student Profile Search
												</a>
											</h4>
										</div>
										<div id="student_profile" class="panel-collapse collapse">
											<div class="box-body">
												<input type="text" onkeyup="showResult(this.value)" id="sp_keyword" class="form-control pull-right" placeholder="Search for a student">
											<div id="sp_response">
											</div>
										</div>
									</div>
								</div>
								
								<div class="panel box box-success">
									<div class="box-header with-border">
										<h4 class="box-title">
											<a data-toggle="collapse" data-parent="#accordion" href="#faculty_profile">
												Faculty Profile Search
											</a>
										</h4>
									</div>
									<div id="faculty_profile" class="panel-collapse collapse">
										<div class="box-body">
											<input type="text" onkeyup="showResult(this.value)" id="fp_keyword" class="form-control pull-right" placeholder="Search for faculty">
											<div id="fp_response">
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				
				<div class="col-md-6">
					<div class="nav-tabs-custom">
						<ul class="nav nav-tabs pull-right">
							<li class="active"><a href="#tab_1-1" data-toggle="tab">Examinations</a></li>
							<li><a href="#tab_2-2" data-toggle="tab">Almanac</a></li>
							<li><a href="#tab_3-2" data-toggle="tab">Syllabus</a></li>
							<li class="pull-left header"><i class="fa fa-th"></i> More Features</li>
						</ul>
						<div class="tab-content">
							<div class="tab-pane active" id="tab_1-1">
								<b>How to use:</b>
							<p>Exactly like the original bootstrap tabs except you should use
                  the custom wrapper <code>.nav-tabs-custom</code> to achieve this style.</p>
                A wonderful serenity has taken possession of my entire soul,
                like these sweet mornings of spring which I enjoy with my whole heart.
                I am alone, and feel the charm of existence in this spot,
                which was created for the bliss of souls like mine. I am so happy,
                my dear friend, so absorbed in the exquisite sense of mere tranquil existence,
                that I neglect my talents. I should be incapable of drawing a single stroke
                at the present moment; and yet I feel that I never was a greater artist than now.
							</div>
							<div class="tab-pane" id="tab_2-2">
                The European languages are members of the same family. Their separate existence is a myth.
                For science, music, sport, etc, Europe uses the same vocabulary. The languages only differ
                in their grammar, their pronunciation and their most common words. Everyone realizes why a
                new common language would be desirable: one could refuse to pay expensive translators. To
                achieve this, it would be necessary to have uniform grammar, pronunciation and more common
                words. If several languages coalesce, the grammar of the resulting language is more simple
                and regular than that of the individual languages.
							</div>
							<div class="tab-pane" id="tab_3-2">
                Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
                when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                It has survived not only five centuries, but also the leap into electronic typesetting,
                remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset
                sheets containing Lorem Ipsum passages, and more recently with desktop publishing software
                like Aldus PageMaker including versions of Lorem Ipsum.
							</div>
						</div>
					</div>
				</div>
			</section>
		</div>
  
		<?php include("../../../includes/footer.html"); ?> <!-- footer -->
	</div>

<!-- jQuery 2.2.3 -->
<script src="../../../plugins/jQuery/jquery-2.2.3.min.js"></script>
<script src="../../../bootstrap/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="../../../dist/js/app.min.js"></script> 	
</body>
</html>
