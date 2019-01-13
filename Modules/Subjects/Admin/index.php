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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  
  <script>
function showUser(str) {
    if (str == "") {
        document.getElementById("subjects_data").innerHTML = "";
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
                document.getElementById("subjects_data").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","sortdata.php?q="+str,true);
        xmlhttp.send();
    }
}
</script>

    
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
                                    url: "getsubjects.php",
                                    data: "show=" + numRecords + "&pagenum=" + pageNum,
                                    cache: false,
                                    beforeSend: function() {
                                        $('.loader').html('<img src="loader.gif" alt="" width="24" height="24" style="padding-left: 400px; margin-top:10px;" >');
                                    },
                                    success: function(html) {
                                        $("div#subjects_data").html(html);
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

$(document).on("click", ".open-edit_subject", function () {
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
				var ajaxDisplay = document.getElementById('subdetails');
				ajaxDisplay.innerHTML = ajaxRequest.responseText;
			}
		}
		var queryString = "?id="+uid;
		ajaxRequest.open("GET", "load_subject.php"+queryString, true);
		ajaxRequest.send(null);
	});
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
	
	<section class="content">
	<div id="details"></div>
	<div class="modal fade" id="new_subject" role="dialog">
						<div class="modal-dialog" >
							<div class="modal-content">
								<div class="modal-header" style="padding:3px 5px;">
									<button class="btn btn-danger btn-xs pull-right" data-dismiss="modal"><i class="fa fa-window-close"></i></button>
									<h4><span class=""></span><b>Add New Subject.</b></h4>
								</div>
								<div class="modal-body" style="padding:40px 50px;">
									<form class="form-horizontal" role="form" enctype="multipart/form-data" method="post">
									<div class="form-group" id="subject_details">
                                            
                                            <div class="col-sm-12">
												<input type="text" name="subject_name" class="form-control"  placeholder="Subject's Name...">
                                            </div>
										</div>
										<div class="form-group">
                                            
											<div class="row">
                                            <div class="col-sm-6">
												<input type="text" name="subject_code" class="form-control" placeholder="Subject Code...{allotted by University}">
											</div>
											<div class="col-sm-6">
												<input type="text" name="subject_short" class="form-control" placeholder="Short Code...">
											</div>
											</div>
                                        </div>
										
										
										<div class="form-group">
                                            
											<div class="row">
                                            <div class="col-sm-6">
												<select class="form-control select2" name="credits" id="credits">
	<option value="0">Credits</option>
		<option value="1">1</option>
		<option value="2">2</option>
		<option value="3">3</option>
		<option value="4">4</option>
		<option value="5">5</option>
		<option value="6">6</option>
		<option value="7">7</option>
		<option value="8">8</option>
		
	</select>
											</div>
											<div class="col-sm-6">
												<select class="form-control select2" name="dept" id="dept">
	<option value="0">Dept</option>
		<option value="cs">C.S.E</option>
		<option value="it">I.T</option>
		<option value="ee">E.E.E</option>
		<option value="ec">E.C.E</option>
		<option value="ei">E.I.E</option>
		<option value="ce">Civil</option>
		<option value="me">Mechanical</option>
		
		
	</select>
												
                                            </div>
											</div>
                                        </div>
                                        
										<div class="form-group" class="col-sm-6">
											<div class="col-sm-6">
												<center> <input name="userfile" align="center" type="file"/> </center>
											</div>
										</div>
                                        <div class="form-group m-b-0">
											<div class="col-sm-offset-3 col-sm-9">
												<button class="btn btn-info btn-sm pull-right" name="add_subject">Add Subject</button>
                                            </div>
                                        </div>
                                    </form>
								</div>
							</div>
						</div>
					</div>
					
					<div class="modal fade" id="edit_subject" role="dialog">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header" style="padding:3px 5px;">
									<button class="btn btn-danger btn-xs pull-right" data-dismiss="modal"><i class="fa fa-window-close"></i></button>
									<h4><span class=""></span><b>Edit Subject.</b></h4>
								</div>
								<div class="modal-body" id="subdetails" style="padding:40px 50px;">
								
								</div>
								
							</div>
						</div>
					</div>
					
      <div class="row" id="print">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Questions</h3>
			  <div class="box-tools pull-right">
			  <button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#new_subject"><i class="fa fa-pencil"></i></button>
							<button type="button" class="btn btn-info btn-xs" onclick="printDiv('print')"><i class="fa fa-print"></i></button>
							
							<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
						</div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding" id="subjects_data">
              
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
 
 <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
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

<!-- AdminLTE App -->
<script src="../../../dist/js/app.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="../../../dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../../dist/js/demo.js"></script>
<script src="../../../plugins/select2/select2.full.min.js"></script>
<script>
  $(function () {
    //Initialize Select2 Elements
    $(".select2").select2();

  })
</script>

</body>
</html>
