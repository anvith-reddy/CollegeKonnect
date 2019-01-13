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
                    $("div#time_table").html(html);
                    $('.loader').html('');
                }
            });
        }

        $(document).ready(function() 
		{
            displayRecords(10, 1);
		});				
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
				<h1>TIME TABLE<small>Home</small></h1>
			</section>
			
			<section class="content">
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
</body>
</html>