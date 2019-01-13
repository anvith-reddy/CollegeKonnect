<?php
include("../../../includes/session.php");
include("../../../includes/config.php");
$user = $_SESSION['login_user'];

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
	<script src="../../../bootstrap/js/jquery.min.js"></script></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
	<script type="text/javascript">
        
		
$(document).ready(function (e) {
	$("#load_timetable").on('submit',(function(e) {
		e.preventDefault();
		$.ajax({
        	url: "load_timetable.php",
			type: "POST",
			data:  new FormData(this),
			contentType: false,
    	    cache: false,
			processData:false,
			success: function(data)
		    {
			$("#time_table").html(data);
		    },
		  	error: function() 
	    	{
	    	} 	        
	   });
	}));
});
$(document).on("click", ".open-viewFacultyDialog", function () {
		var uid = $(this).data('id');
		 $('#update').click(function() {
			 
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
				var year1 = document.getElementById('year').value;
				var dept1 = document.getElementById('dept').value;
				var section1 = document.getElementById('section').value;
		$.ajax({
        	url: "load_timetable.php",
			type: "POST",
			data:  {year: year1, dept: dept1, section: section1},
			success: function(data)
		    {
			$("#time_table").html(data);
		    },
		  	error: function() 
	    	{
	    	} 	        
	   });
	   document.getElementById("update_action_response").innerHTML = "";
				var ajaxDisplay = document.getElementById('update_action_response');
				ajaxDisplay.innerHTML = ajaxRequest.responseText;
	   
			}
		}
		var dept_slot = document.getElementById('dept_slot').value;
		
		
		var faculty1 = document.getElementById('faculty1').value;
		var faculty2 = document.getElementById('faculty2').value;
		var faculty3 = document.getElementById('faculty3').value;
		
		var queryString = "?id="+uid+"&dept_slot="+dept_slot+"&subject="+subject+"&faculty1="+faculty1+"&faculty2="+faculty2+"&faculty3="+faculty3;
		ajaxRequest.open("GET", "update_timetable.php"+queryString, true);
		ajaxRequest.send(null);
    });
	});

    </script>
	<link rel="stylesheet" href="../../../plugins/select2/select2.min.css">
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
			<section class="content-header">
				<h1>TIME TABLE<small>Home</small></h1>
			</section>
			
			<div name="test" id="test"></div>
			<section class="content">
			<div class="modal fade" style="overflow:hidden;" role="dialog" id="viewFacultyDialog">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button class="close" data-dismiss="modal">×</button>
							</div>
							<div class="modal-body">
							<div class="form-group">
                <label>Subject</label>
                <select class="form-control select2" id="subject" data-placeholder="Select a Subject" style="width: 100%;">
				<option value="0">Select Subject</option>
				<?php
				$subjects = "select code,name from subjects";
				$subjects = mysqli_query($db,$subjects);
				if ($subjects->num_rows > 0) 
										{
											while($row = $subjects->fetch_assoc()) 
											{	
												echo '<option value="'. $row["code"].'">'. $row["code"] . "-" . $row["name"].'</option>';
											}						
										}
				?>
                </select>
              </div>
			  <div class="form-group">
                <label>Professor</label>
                <select class="form-control select2" id="faculty1" data-placeholder="Select Faculty" style="width: 100%;">
				<option value="0">Select Faculty No 1</option>
                  <?php
				$faculty1 = "select uid,fname,mname,lname from faculty";
				$faculty1= mysqli_query($db,$faculty1);
				if ($faculty1->num_rows > 0) 
										{
											while($faculty_row1 = $faculty1->fetch_assoc()) 
											{	
												echo '<option value="'. $faculty_row1["uid"].'">'. $faculty_row1["uid"] . "-" . $faculty_row1["mname"] . " " . $faculty_row1["lname"] . " " . $faculty_row["fname"] .'</option>';
											}						
										}
				?>
                </select>
				</div>
				<div class="form-group">
				<select class="form-control select2" id="faculty2" data-placeholder="Select Faculty" style="width: 100%;">
				<option value="0">Select Faculty No 2</option>
                  <?php
				$faculty2 = "select uid,fname,mname,lname from faculty";
				$faculty2 = mysqli_query($db,$faculty2);
				if ($faculty2->num_rows > 0) 
										{
											while($faculty_row2 = $faculty2->fetch_assoc()) 
											{	
												echo '<option value="'. $faculty_row2["uid"].'">'. $faculty_row2["uid"] . "-" . $faculty_row2["mname"] . " " . $faculty_row2["lname"] . " " . $faculty_row2["fname"] .'</option>';
											}						
										}
				?>
                </select>
				</div>
				<div class="form-group">
				<select class="form-control select2" id="faculty3" data-placeholder="Select Faculty" style="width: 100%;">
				<option value="0">Select Faculty No 3</option>
                  <?php
				$faculty3 = "select uid,fname,mname,lname from faculty";
				$faculty3 = mysqli_query($db,$faculty3);
				if ($faculty3->num_rows > 0) 
										{
											while($faculty_row3 = $faculty3->fetch_assoc()) 
											{	
												echo '<option value="'. $faculty_row3["uid"].'">'. $faculty_row3["uid"] . "-" . $faculty_row3["mname"] . " " . $faculty_row3["lname"] . " " . $faculty_row3["fname"] .'</option>';
											}						
										}
				?>
                </select>
              </div>
			  <div class="form-group">
			  <button id="update" class="btn btn-info btn-sm pull-right">Update</button>
								</div>
								</div>
								
								<div id="update_action_response">
								        
							</div>
						</div>
					</div>
				</div>
				
			<div class="form-group">
			<form class="form-inline" id="load_timetable" action="load_timetable.php" method="post">
  <div class="form-group">
    <select class="form-control" name="year" id="year">
	<option value="0">YEAR/BATCH</option>
		<option value="I">I year </option>
		<option value="II">II year </option>
		<option value="III">III year </option>
		<option value="IV">IV year </option>
	</select>
  </div>
  <div class="form-group">
    <select class="form-control" name="dept" id="dept">
	<option value="0">DEPT</option>
		<option value="cs">C.S.E	 </option>
		<option value="ec">E.C.E </option>
		<option value="ee">E.E.E</option>
		<option value="ei">E.I.E </option>
		<option value="me">MECHANICAL</option>
		<option value="ce">CIVIL</option>
		<option value="it">I.T</option>
	</select>
  </div>
  <div class="form-group">
    <select class="form-control" name="section" id="section">
		<option value="0">SECTION</option>
		<option value="1">Section 1</option>
		<option value="2">Section 2</option>
		<option value="3">Section 3</option>
	</select>
  </div>
  <button type="submit" class="btn btn-default">Load</button>
</form>
</div>
				<div class="row">
					<div class="col-xs-12">
						<div class="box">
							
							<div class="box-body table-responsive no-padding" id="time_table">
							</div>
						</div>
					</div>
				</div>
			</section>
		</div>
		<?php include("../../../includes/footer.html"); ?>
	</div>

<!-- jQuery 2.2.3 -->
<script src="../../../plugins/jQuery/jquery-2.2.3.min.js"></script>
<script src="../../../bootstrap/js/bootstrap.min.js"></script>

<!-- AdminLTE App -->
<script src="../../../dist/js/app.min.js"></script> 	
<script src="../../../plugins/select2/select2.full.min.js"></script>
<script>
  $(function () {
    //Initialize Select2 Elements
    $(".select2").select2();

  })
</script>
</body>
</html>