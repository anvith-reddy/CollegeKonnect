<?php
include("../../../includes/session.php");
include("../../../includes/functions.php");
include("../../../includes/config.php");
$user = $_SESSION["login_user"];
date_default_timezone_set('Asia/Kolkata');
$thread = $_GET["thread"];
$sql="select * from forum_q where id='$thread'";
$question=mysqli_fetch_array(mysqli_query($db,$sql));

$status = $question["status"];
$sql2 = "select * from forum_a where qid = '$thread'";
$answers = mysqli_query($db,$sql2);

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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  
<script>
function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}
function post_answer()
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
		 	
$( "#answers" ).load( "view.php?thread=<?php echo $thread; ?> #answers" );
document.getElementById("answer").value="";
      }
   }
  var answer = document.getElementById('answer').value;
  if (document.getElementById('anonymous').checked)
   {
	   var by_user = 'anonymous';
   }
   else 
   {
	   var by_user = '<?php echo $_SESSION['login_user']; ?>';
   }
  var qid = <?php echo $thread; ?>;
  var string = "?answer="+answer+"&qid="+qid+"&by_user="+by_user;
   
   ajaxRequest.open("GET", "post_answer.php"+string, true);
   ajaxRequest.send(null); 
	
}
function toggle_status()
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
		 	$( "#print" ).load( "view.php?thread=<?php echo $thread; ?> #print" );
      }
   }
  
  var qid = <?php echo $thread; ?>;
  var string = "?qid="+qid;
   
   ajaxRequest.open("GET", "toggle_status.php"+string, true);
   ajaxRequest.send(null); 
	
}
</script>
</head>
<body class="hold-transition skin-blue sidebar-mini">
	<div class="wrapper">
		<?php include("../../../includes/header.php"); ?> <!-- Header File -->
	
		<aside class="main-sidebar">
			<section class="sidebar">
				<?php include("../../../includes/smenu.html"); ?> <!-- Side Menu -->
			</section>
		</aside>
		
		<div class="content-wrapper">
			<section class="content-header">
				<div class="row">
					<div class="col-xs-12">
						<div class="box">
							<div class="box-header">
								<h3 class="box-title"><b>FORUM</b><small>&nbsp;&nbsp;View Thread</small></h3>
							</div>
						<div class="box-body table-responsive no-padding">
					</div>
				</div>
			</section>

			<section class="content">
				<div class="box" id="print">
					<div class="box-header with-border" id="thread_info">
						<h3 class="box-title"><mark class="bg-danger"><?php echo $question["id"]; ?></mark><b><small><?php echo $question["category"]; ?></small></b></h3>
						<div class="box-tools pull-right">
							<button type="button" class="btn btn-info" onclick="printDiv('print')"><i class="fa fa-print"></i></button>
							<?php if ($question["by_user"] == $user)
							{
							?>
							<?php if ($question["status"] == "open") 
							{
							?>
							<button type="button" onclick="toggle_status()" class="btn btn-danger" name="close">Close Thread</button>
							<?php
							}
							else if ($question["status"]=="closed") 
							{
							?>
							<button type="button" onclick="toggle_status()" class="btn btn-success" name="open">Open Thread</button> 
							<?php 
							} 
							?>
							<?php 
							}
							?>
						</div>
					</div>
					<div class="box-body">
						<div class="container">
							<div class="row">
								<div class="well" style="width:100%;">
								<?php echo $question["question"]; ?>
								<footer><b>By</b> <?php echo $question["by_user"]; ?><b>&nbsp;&nbsp;on&nbsp;&nbsp;</b><?php echo $question["posted_on"]; ?></footer>
							</div>
						</div>
					</div>
                </div>
				
				<div class="box" id="answers">
					<div class="box body">
						<?php
						if ((mysqli_num_rows($answers)) == 0)
						{
						?>
							<div class="alert alert-danger alert-dismissable fade in">
								<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
								<strong>Sorry!</strong> No Answers Yet. Take a chance of Posting an Answer to help your friend.
							</div>
						<?php
						}
						else 
						{
							while($row = $answers->fetch_assoc()) 
							{
						?>
							<blockquote class="blockquote-reverse">
								<p><?php echo $row['answer']; ?></p>
								<footer><b>By</b> <?php echo $row['display_name']; ?><b>&nbsp;&nbsp;on&nbsp;&nbsp;</b><?php echo $row['posted_on']; ?></footer>
							</blockquote>
						<?php 
							} 
						} 
						?>
					</div>
					<?php 
						if ($status == 'open')
						{
					?>
					<div class="box">
						<div class="box-header">
							<h3 class="box-title">Post an Answer.<small>Help your mates.</small></h3>
							<div class="pull-right box-tools">
								<button type="button" class="btn btn-default btn-sm" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
							</div>
							<div class="box-body pad">
								<textarea class="form-control" id="answer" placeholder="Place your Answer Here.." style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
							</div>
							<table>
								<tr>
									<td>
										<div class="form-group">
											<div class="checkbox">
												<label>
													&nbsp;
													<input type="checkbox" id="anonymous" value="anonymous">
													Stay Anonymous.&nbsp;
												</label>
											</div>
										</div>
									</td>
									<td> <?php for($i=0;$i<150;$i++) { ?>&nbsp; <?php } ?> </td>
									<td><button class="btn btn-success" type="button" onclick="post_answer()">Answer it</button></td>
								</tr>
							</table>
						</div>
					</div>
				</div>
			</section>
		<?php } ?>
		</div>
	
	
	<?php include("../../../includes/footer.html"); ?><!-- Footer File -->
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

<script src="../../../dist/js/app.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="../../../dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../../dist/js/demo.js"></script>
</body>
</html>
