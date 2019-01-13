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
	
	$(document).ready(function (e) {
	$("#widget").on('submit',(function(e) {
		e.preventDefault();
		$.ajax({
        	url: "add_widget.php",
			type: "POST",
			data:  new FormData(this),
			beforeSend: function(){$("#body-overlay").show();},
			contentType: false,
    	    processData:false,
			success: function(data)
		    {
			$("#response").html(data);
			$.ajax({
    url: 'index.php',
    dataType: 'html',
    success: function(html) {
        var div = $('#widgets2', $(html)).addClass('done');
        $('#widgets1').html(div);
    }
});
			},
		  	error: function() 
	    	{
	    	} 	        
	   });
	}));
});
function delete_notify(id,category)
{
	$.ajax({
        	url: "delete_notification.php?id="+id"&category="+category,
			type: "GET",
			success: function(data)
		    {
			alert("done");
			},
		  	error: function() 
	    	{
	    	} 	        
	   });
}
</script>
</head>
<body class="hold-transition skin-blue sidebar-mini">
	<div class="wrapper">
		<?php include("../../../includes/header.php"); ?> <!-- Header File -->
	
		<aside class="main-sidebar">
			<section class="sidebar">
				<?php include("../../../includes/amenu.html"); ?> <!-- sidebar menu -->
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
				
				<div class="col-md-6" id="widgets1">
					<div class="nav-tabs-custom" id="widgets2">
						<ul class="nav nav-tabs pull-right">
							<li class="active"><a href="#tab_2-1" data-toggle="tab">Notifications</a></li>
							<li><a href="#tab_2-2" data-toggle="tab">Examinations</a></li>
							<li><a href="#tab_2-3" data-toggle="tab">Almanac</a></li>
							<li><a href="#tab_2-4" data-toggle="tab">Syllabus</a></li>
							<li><a href="#tab_2-5" data-toggle="tab"><i class="fa fa-plus">&nbsp;Add New</i></a></li>

						</ul>
						<div class="tab-content">
							<div class="tab-pane active" id="tab_2-1">
							<?php
								$query = "SELECT * from widgets where type='notification' order by posted_on DESC";
								$result = mysqli_query($db,$query);
								while ($row = $result->fetch_assoc()) 
								{			
							?>		
									<li>
										<a data-toggle="collapse" data-target="#demo<?php echo $row["id"]; ?>"><?php echo $row["title"]; ?></a>
										<button class="btn btn-xs btn-danger" onclick="delete_notify(<?php echo $row["id"]; ?>)"><i class="fa fa-trash"></i></button>
										<div id="demo<?php echo $row["id"]; ?>" class="collapse">
							<?php 		
										echo $row["content"]; 
							?>
										<br> 
							<?php 
										if ($row["files"] > 0)
										{
											$widget_id = $row["id"];
											$files4 = "SELECT id,name from files where category='notification' and categoryid='$widget_id'";
											$files_result = mysqli_query($db,$files4);
											if ($files_result->num_rows > 0) 
											{
												while($file_ids = $files_result->fetch_assoc()) 
												{
							?>
													<i class="fa fa-download"><a href='download.php?id=<?php echo $file_ids["id"]; ?>'>&nbsp;<?php echo $file_ids["name"]; ?></a></i><br>
							<?php
												}
											}
										}
							?>
										</div>
									</li>
							<?php			
								}						
							?>
						</div>
						<div class="tab-pane" id="tab_2-2">
						<?php
								$query = "SELECT * from widgets where type='examination' order by posted_on DESC";
								$result = mysqli_query($db,$query);
								while ($row = $result->fetch_assoc()) 
								{			
							?>		
									<li>
										<a data-toggle="collapse" data-target="#demo<?php echo $row["id"]; ?>"><?php echo $row["title"]; ?></a>
										<button class="btn btn-xs btn-danger" onclick="delete_notify(<?php echo $row["id"]; ?>,<?php echo $row["type"]; ?>)"><i class="fa fa-trash"></i></button>
										<div id="demo<?php echo $row["id"]; ?>" class="collapse">
							<?php 		
										echo $row["content"]; 
							?>
										<br> 
							<?php 
										if ($row["files"] > 0)
										{
											$widget_id = $row["id"];
											$files4 = "SELECT id,name from files where category='examination' and categoryid='$widget_id'";
											$files_result = mysqli_query($db,$files4);
											if ($files_result->num_rows > 0) 
											{
												while($file_ids = $files_result->fetch_assoc()) 
												{
							?>
													<i class="fa fa-download"><a href='download.php?id=<?php echo $file_ids["id"]; ?>'>&nbsp;<?php echo $file_ids["name"]; ?></a></i><br>
							<?php
												}
											}
										}
							?>
										</div>
									</li>
							<?php			
								}						
							?>
			</div>
							<div class="tab-pane" id="tab_2-3">
							<?php
								$query = "SELECT * from widgets where type='almanac' order by posted_on DESC";
								$result = mysqli_query($db,$query);
								while ($row = $result->fetch_assoc()) 
								{			
							?>		
									<li>
										<a data-toggle="collapse" data-target="#demo<?php echo $row["id"]; ?>"><?php echo $row["title"]; ?></a>
										<button class="btn btn-xs btn-danger" onclick="delete_notify(<?php echo $row["id"]; ?>)"><i class="fa fa-trash"></i></button>
										<div id="demo<?php echo $row["id"]; ?>" class="collapse">
							<?php 		
										echo $row["content"]; 
							?>
										<br> 
							<?php 
										if ($row["files"] > 0)
										{
											$widget_id = $row["id"];
											$files4 = "SELECT id,name from files where category='almanac' and categoryid='$widget_id'";
											$files_result = mysqli_query($db,$files4);
											if ($files_result->num_rows > 0) 
											{
												while($file_ids = $files_result->fetch_assoc()) 
												{
							?>
													<i class="fa fa-download"><a href='download.php?id=<?php echo $file_ids["id"]; ?>'>&nbsp;<?php echo $file_ids["name"]; ?></a></i><br>
							<?php
												}
											}
										}
							?>
										</div>
									</li>
							<?php			
								}						
							?>
							</div>
							<div class="tab-pane" id="tab_2-4">
							<?php
								$query = "SELECT * from widgets where type='syllabus' order by posted_on DESC";
								$result = mysqli_query($db,$query);
								while ($row = $result->fetch_assoc()) 
								{			
							?>		
									<li>
										<a data-toggle="collapse" data-target="#demo<?php echo $row["id"]; ?>"><?php echo $row["title"]; ?></a>
										<button class="btn btn-xs btn-danger" onclick="delete_notify(<?php echo $row["id"]; ?>)"><i class="fa fa-trash"></i></button>
										<div id="demo<?php echo $row["id"]; ?>" class="collapse">
							<?php 		
										echo $row["content"]; 
							?>
										<br> 
							<?php 
										if ($row["files"] > 0)
										{
											$widget_id = $row["id"];
											$files4 = "SELECT id,name from files where category='syllabus' and categoryid='$widget_id'";
											$files_result = mysqli_query($db,$files4);
											if ($files_result->num_rows > 0) 
											{
												while($file_ids = $files_result->fetch_assoc()) 
												{
							?>
													<i class="fa fa-download"><a href='download.php?id=<?php echo $file_ids["id"]; ?>'>&nbsp;<?php echo $file_ids["name"]; ?></a></i><br>
							<?php
												}
											}
										}
							?>
										</div>
									</li>
							<?php			
								}						
							?>
							</div>
							<div class="tab-pane" id="tab_2-5">
								
				<form role="form" id="widget">
				<div class="form-group">
                  <label>Choose your mode</label>
                  <select id="category" name="category" class="form-control">
				  <option value="">Category</option>
                    <option value="notification">Notification</option>
                    <option value="examination">Examination</option>
                    <option value="almanac">Almanac</option>
                    <option value="syllabus">Syllabus</option>
                  </select>
                </div>
              <div class="box-body">
                <div class="form-group">
                  <input type="text" class="form-control" name="title" placeholder="Enter Title....">
                </div>
                <div class="form-group">
                  <input type="text" class="form-control" name="content" placeholder="Enter content....">
                </div>
                <div class="form-group">
                 <input type="file" multiple name="userfile[]">
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
			<div id="response"></div>
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
