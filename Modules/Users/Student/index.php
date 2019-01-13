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
  
  
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="../../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>


<script>
function update_user(id)
{
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
		  document.getElementById("fetcheddata").innerHTML = "";
         var ajaxDisplay = document.getElementById('fetcheddata');
         ajaxDisplay.innerHTML = ajaxRequest.responseText;
      }
   }
   var uid = document.getElementById('uid').value;
   var dept = document.getElementById('dept').value;
   var batch = document.getElementById('batch').value;
   var dob = document.getElementById('dob').value;
   var fname = document.getElementById('fname').value;
   var mname = document.getElementById('mname').value;
   var lname = document.getElementById('lname').value;
   var father = document.getElementById('father').value;
   var mother = document.getElementById('mother').value;
   var smobile = document.getElementById('smobile').value;
   var pmobile = document.getElementById('pmobile').value;
   var semail = document.getElementById('semail').value;
   var pemail = document.getElementById('pemail').value;
   var hno = document.getElementById('hno').value;
   var street = document.getElementById('street').value;
   var address1 = document.getElementById('address1').value;
   var address2 = document.getElementById('address2').value;
   var pincode = document.getElementById('pincode').value;
   
   var queryString = "?id="+id+"&uid="+uid+"&dept="+dept+"&batch="+batch+"&dob="+dob+"&fname="+fname+"&mname="+mname+"&lname="+lname+"&father="+father+"&mother="+mother+"&smobile="+smobile+"&pmobile="+pmobile+"&semail="+semail+"&pemail="+pemail+"&hno="+hno+"&street="+street+"&address1="+address1+"&address2="+address2+"&pincode="+pincode;
   ajaxRequest.open("GET", "update_user.php"+queryString, true);
   ajaxRequest.send(null);
}
function edit_user(id)
{
	window.alert(id);
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
		  document.getElementById("fetcheddata").innerHTML = "";
         var ajaxDisplay = document.getElementById('fetcheddata');
         ajaxDisplay.innerHTML = ajaxRequest.responseText;
      }
   }
   
   var queryString = "?id=" + id;
   ajaxRequest.open("GET", "fetch_user.php"+queryString, true);
   ajaxRequest.send(null);
}
function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}
function edit_users(id)
{
	window.alert(id);
}
$(document).ready(function() {
		$('#search_keyword').on('input', function() {
			var searchKeyword = $(this).val();
			if (searchKeyword.length >= 6) {
				$.post('student_search.php', { keywords: searchKeyword }, function(data) {
					$.each(data, function() {
						$(".test").hide();
						$('table#search').append('<tr class="test"><td>'+this.uid+'</td><td>'+this.fname+this.mname+this.lname+'</td><td>'+this.smobile+'</td><td>'+this.pmobile+'</td><td> <button class="btn btn-info btn-xs" onclick=" edit_user('+this.semail+') "><i class="fa fa-wrench"></i></button> </td></tr>');
					});
				}, "json");
			}
		});
	});
function achievement_details(id)
{
	window.alert("clicked");
}
function fetch_records(){
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
		  document.getElementById("fetcheddata").innerHTML = "";
         var ajaxDisplay = document.getElementById('fetcheddata');
         ajaxDisplay.innerHTML = ajaxRequest.responseText;
      }
   }
   var batch = document.getElementById('batch').value;
   var dept = document.getElementById('dept').value;
   
   var queryString = "?batch=" + batch +"&dept="+dept;
   ajaxRequest.open("GET", "fetch_records.php"+queryString, true);
   ajaxRequest.send(null); 
}

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
				<h1>USERS <small>STUDENTS</small></h1>
			</section>

			<section class="content"> <!-- Main content -->
				<div class="row">
        <div class="col-md-9">
          <div class="box box-default">
            <div class="box-header with-border">
              <i class="fa fa-info"></i>

              <h3 class="box-title">Users Information</h3>
			  <div class="box-tools pull-right">	
							<button type="button" class="btn btn-info" onclick="new_file()"><i class="fa fa-file-o"></i></button>
							<button type="button" class="btn btn-info" onclick="printDiv('fetcheddata')"><i class="fa fa-print"></i></button>
							<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
						</div>
            </div>
            <!-- /.box-header -->
            <div class="box-body" id="fetcheddata">
            <table class="table table-hover" id="search">
			<tr>
					<th>Roll No</th>
					<th>Name</th>
					<th>S-Mobile</th>
					<th>P-Mobile</th>
					<th>S-Email</th>
					<th>Operations</th>
				</tr>
			</table>  
            </div>
			
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->

        <div class="col-md-3">
          <div class="box box-default">
            <div class="box-header with-border">
              <i class="fa fa-wrench"></i>

              <h3 class="box-title">Tools</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
			
              
			  <div class="form-group">
		<input type="text" class="form-control" id="search_keyword" placeholder="search user">
		<div id="search">
		</div>
		</div>
		<form>
    <div class="form-group">
      <select class="form-control" id="batch" onchange="if (this.value!=''){this.form['dept'].style.visibility='visible'}else {this.form['dept'].style.visibility='hidden'};">
	  <option value="">Year</option>
	  <option value="value1">I Year </option>
	  <option value="value2">II Year </option>
	  <option value="value3">III Year </option>
	  <option value="value4">IV Year </option>
	  </select>
    </div>
    <div class="form-group" >
      <select class="form-control" id="dept" style="visibility:hidden;" onchange="fetch_records()">
	  <option value="">Dept</option>
	  <option value="cs">CSE </option>
	  <option value="ec">ECE </option>
	  <option value="ee">EEE </option>
	  <option value="ei">EIE </option>
	  <option value="me">MEC </option>
	  <option value="ce">CIV </option>
	  <option value="it">IT </option>
	  </select>
    </div>
	
  
              <div class="callout callout-info">
                <h4>I am an info callout!</h4>

                <p>Follow the steps to continue to payment.</p>
              </div>
              <div class="callout callout-warning">
                <h4>I am a warning callout!</h4>

                <p>This is a yellow callout.</p>
              </div>
              <div class="callout callout-success">
                <h4>I am a success callout!</h4>

                <p>This is a green callout.</p>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      
				
				
<hr>

				
			</section>
		</div>
  <!-- END@ content-wrapper -->
  
  <?php include("../../../includes/footer.html"); ?> <!-- footer -->

</div>

<!-- jQuery 2.2.3 -->
<script src="../../../plugins/jQuery/jquery-2.2.3.min.js"></script>
<script src="../../../bootstrap/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="../../../dist/js/app.min.js"></script> 	
</body>
</html>
