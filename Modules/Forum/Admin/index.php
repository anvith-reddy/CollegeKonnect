<?php
include("../../../includes/session.php");
include("../../../includes/functions.php");
$user=$_SESSION['login_user'];
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
        document.getElementById("forum_data").innerHTML = "";
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
        xmlhttp.open("GET","sortdata.php?q="+str,true);
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
						$('table#search').append('<tr><td><a href="view.php?thread=' + this.id + '">' +  this.question + '</a></td></tr>');
					});
				}, "json");
			}
		});
	});
	</script>
	<script src="jquery-1.9.0.min.js"></script>
        <script type="text/javascript">
        // fetching records
                            function displayRecords(numRecords, pageNum) {
                                $.ajax({
                                    type: "GET",
                                    url: "getrecords.php",
                                    data: "show=" + numRecords + "&pagenum=" + pageNum,
                                    cache: false,
                                    beforeSend: function() {
                                        $('.loader').html('<img src="loader.gif" alt="" width="24" height="24" style="padding-left: 400px; margin-top:10px;" >');
                                    },
                                    success: function(html) {
                                        $("div#forum_data").html(html);
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
							
							
        </script>
		
<script language="javascript" type="text/javascript">
<!-- 
//Browser Support Code
function post_question(){
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
   var question = document.getElementById('question').value;
   if ((document.getElementById('category').value) == 'other')
   {
	   var category = document.getElementById('other').value;
   }
   else
   {
	   var category = document.getElementById('category').value;
   }
   if (document.getElementById('anonymous').checked)
   {
	   var postedby = 'anonymous';
   }
   else 
   {
	   var postedby = '<?php echo $_SESSION['login_user']; ?>';
   }
   
   var queryString = "?question=" + question +"&category="+category +"&postedby="+postedby;
   ajaxRequest.open("GET", "post_question.php"+queryString, true);
   ajaxRequest.send(null); 
}
//-->
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
      <?php include("../../../includes/amenu.html"); ?>
	  <!-- sidebar menu end -->
    </section>
    <!-- /.sidebar -->
  </aside>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
	<div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title"><b>FORUM</b><small>&nbsp;&nbsp;HOME</small></h3>
              <div class="box-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
				<form>
                  <input type="text" onkeyup="showResult(this.value)" id="keyword" class="form-control pull-right" placeholder="Search for a question">
				</form>
                </div>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover" id="search">
                <tr id="search"></tr>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
	
	
    </section>
	<div id="response"></div>
    <!-- Main content -->
	<section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Post a Question.
                <small>Get an Answer.</small>
              </h3>
              <div id="myid"></div>
            <!-- /.box-header -->
			<form method="post" id="myform" name="myForm">
				<div class="box-body pad">
					<textarea class="form-control" id="question" placeholder="Post Your Question Here..." style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
				</div>
				
				<table>
					<tr>
						<td>
							<select class="form-control" id="category" onchange="if (this.value=='other'){this.form['other'].style.visibility='visible'}else {this.form['other'].style.visibility='hidden'};">
								<option value="0">Category</option>
									<?php 
										$result = forum_categories();
										if ($result->num_rows > 0) 
										{
											while($row = $result->fetch_assoc()) 
											{	
												echo '<option value="'. $row["category"].'">'. $row["category"].'</option>';
											}						
										}
									?>
								<option value="other">other</option>
							</select>
						</td>
						<td>
							<input type="textbox" class="form-control" id="other" placeholder="please specify" style="visibility:hidden;"/>
						</td>
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
						<td> <?php for($i=0;$i<99;$i++) { ?>&nbsp; <?php } ?> </td>
						<td>
							<button type='button' class="btn btn-success" onclick='post_question()'>Submit</button>
						</td>
					</tr>
				</table>
			</form>
			</div>
          </div>
        </div>
        <!-- /.col-->
      </div>
      <!-- ./row -->
    </section>

	<section class="content">
      <div class="row" id="print">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Questions</h3>
			  <div class="box-tools pull-right">
							<button type="button" class="btn btn-info btn-sm" onclick="printDiv('print')"><i class="fa fa-print"></i></button>
							<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
						</div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding" id="forum_data">
              
			 </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>
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
