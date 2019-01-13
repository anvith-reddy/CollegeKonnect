<?php
include("../../../includes/session.php");
include("../../../includes/functions.php");
include("../../../includes/config.php");
$user=$_SESSION['login_user'];
date_default_timezone_set('Asia/Kolkata');
if (isset($_POST["submit"])) 
{
	
	$title=$_POST['title'];
	$edition=$_POST['edition'];
	$authors=$_POST['authors'];
	$domain=$_POST['domain'];
	$posted_on = date("Y-m-d H:i:s");
	$publications=$_POST['publications'];
	
	if (empty($_FILES['userfile']['name'])) $attachment = "0";
	else $attachment = "1";
	
	if($domain=="other")
	{
		$domain = $_POST['other'];
	}
	
	if($title == "")
	{
		echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Enter Book Title')
    window.location.href='index.php';
    </SCRIPT>");
	}
	else if($edition=="")
	{
		echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Enter Edition')
    window.location.href='index.php';
    </SCRIPT>");
	}
	else if($authors=="")
	{
		echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Enter Book Authors')
    window.location.href='index.php';
    </SCRIPT>");
	}
	else if($attachment==0)
	{
		echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('No Files Selected Please Try Again')
    window.location.href='index.php';
    </SCRIPT>");
	}
	else 
	{	
		$contents = "INSERT INTO `library`(`by_user`, `posted_on`, `title`, `edition`, `publications`, `authors`, `domain`) 
		VALUES ('$user','$posted_on','$title','$edition','$publications','$authors','$domain')";
		if ($db->query($contents) === TRUE)
		{
			$inserted = $db->insert_id;
				$filename = $_FILES['userfile']['name'];
				$tmpname = $_FILES['userfile']['tmp_name'];
				$file_size = $_FILES['userfile']['size'];
				$file_type = $_FILES['userfile']['type'];
				$ext = pathinfo($filename, PATHINFO_EXTENSION);
			
				$fp      = fopen($tmpname, 'r');
				$content = fread($fp, filesize($tmpname));
				$content = addslashes($content);
				fclose($fp);
				
				$final = "INSERT INTO `files`(`by_user`,`name`, `type`, `size`, `data`, `category`, `categoryid`) 
				VALUES('$user','$filename','$file_type','$file_size','$content','library','$inserted')";
				if(mysqli_query($db,$final))
				{
					header("location: index.php?message=success");
				}
		}
		else 
		{
			echo ("<SCRIPT LANGUAGE='JavaScript'>
			window.alert('Unable to Send Temporarily. Please check your Inputs...')
			window.location.href='index.php';
			</SCRIPT>");
		}
	}
}

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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
	
	<script>
	
	function printDiv(divName) // Function for Printing
	{
		var printContents = document.getElementById(divName).innerHTML;
		var originalContents = document.body.innerHTML;
	
		document.body.innerHTML = printContents;
	
		window.print();
	
		document.body.innerHTML = originalContents;
	}

	function showUser(str)// Function for Sorting the Results
	{
		if (str == "") {
			document.getElementById("files_data").innerHTML = "";
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
                document.getElementById("files_data").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","sortdata.php?q="+str,true);
        xmlhttp.send();
    }
	}

	function displayRecords(numRecords, pageNum) // Function to fetch library Records on Page Load
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
		<?php include("../../../includes/header.php"); ?><!-- Header File -->
		
		<aside class="main-sidebar">
			<section class="sidebar">
				<?php include("../../../includes/smenu.html"); ?><!-- Side Menu -->
			</section>
		</aside>
		
		<div class="content-wrapper">
			<section class="content">
				<div class="container"><!-- START@ Form for Uploading New File -->
					<div class="modal fade" id="newfile" role="dialog">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header" style="padding:35px 50px;">
									<button type="button" class="close" data-dismiss="modal">&times;</button>
									<h4><span class=""></span>Add New File.</h4>
								</div>
								<div class="modal-body" style="padding:40px 50px;">
									<form class="form-horizontal" role="form" enctype="multipart/form-data" method="post">
										<div class="form-group">
                                            <label for="inputEmail3" class="col-sm-3 control-label">Book Title</label>
                                            <div class="col-sm-6">
												<input type="text" name="title" class="form-control"  placeholder="Title of Book">
                                            </div>
										</div>
										<div class="form-group">
                                            <label for="inputEmail3" class="col-sm-3 control-label">Edition</label>
                                            <div class="col-sm-6">
												<input type="text" name="edition" class="form-control"  placeholder="Book's Edition...">
                                            </div>
										</div>
										<div class="form-group">
                                            <label for="inputEmail3" class="col-sm-3 control-label">Author/s</label>
                                            <div class="col-sm-6">
												<input type="text" name="authors" class="form-control" placeholder="Author's Names...">
                                            </div>
										</div>
										<div class="form-group">
                                            <label for="inputEmail3" class="col-sm-3 control-label">Publications</label>
                                            <div class="col-sm-6">
												<input type="text" name="publications" class="form-control" placeholder="Publications..">
											</div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Domain</label>
                                            <div class="col-sm-6">
												<select class="form-control" name="domain" onchange="if (this.value=='other'){this.form['other'].style.visibility='visible'}else {this.form['other'].style.visibility='hidden'};">
													<option value="0">Category</option>
													<?php 
														$query="select distinct domain from library";
														$result = mysqli_query($db,$query);
														if ($result->num_rows > 0) 
														{
															while($row = $result->fetch_assoc()) 
															{	
																echo '<option value="'. $row["domain"].'">'. $row["domain"].'</option>';
															}						
														}
													?>
													<option value="other">other</option>
												</select>
												<input type="textbox" class="form-control" name="other" placeholder="please specify" style="visibility:hidden;"/>
                                            </div>
                                        </div>
										<div class="form-group" class="col-sm-6">
											<div class="col-sm-6">
												<center> <input name="userfile" align="center" type="file"/> </center>
											</div>
										</div>
                                        <div class="form-group m-b-0">
											<div class="col-sm-offset-3 col-sm-9">
												<input type="submit" name="submit" class="btn btn-info waves-effect waves-light">Submit</button>
                                            </div>
                                        </div>
                                    </form>
								</div>
							</div>
						</div>
					</div> 
				</div><!-- END@ Form for uploading New File -->

				<div class="container"> <!-- START@ Modal for giving messages to User-->
					<div id="myModal" class="modal fade" role="dialog">
						<div class="modal-dialog modal-sm">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal">&times;</button>
									<?php 
										if (($_GET['message'])=='success')
										{ 
									?>
									<center><i class="fa fa-check-circle-o" style="font-size:100px;color:green;"></i></center>
									<center><h4>File Successfully Uploaded</h4></center>
									<?php 
										}
										
									?>
									
								</div>
							</div>
						</div>
					</div>
				</div><!-- END@ Modal for giving messages to User-->

				<div class="box" id="print"><!-- START@ Main Content -->
					<div class="box-header with-border">
						<h3 class="box-title">DIGITAL LIBRARY<small> Browse your Needs...</small></h3>
						<div class="box-tools pull-right">	
							<button type="button" class="btn btn-info" data-toggle="modal" data-target="#newfile"><i class="fa fa-file-o"></i></button>
							<button type="button" class="btn btn-info" onclick="printDiv('print')"><i class="fa fa-print"></i></button>
							<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
						</div>
					</div>
					<div class="box-body">
						<div class="row">
							<div class="col-xs-12">
								<div class="box">
									<div class="box-body table-responsive no-padding" id="files_data">
									<!-- Area For Displaying the records fetched -->
									</div>	
								</div>
							</div>
						</div>
                    </div>
                </div><!-- END@ Main Content -->
			</section>
		</div>
		<?php include("../../../includes/footer.html"); ?><!-- Footer -->
	</div>
<!-- ./wrapper -->

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
</body>
</html>
