<?php
include("includes/config.php");
if($_SERVER["REQUEST_METHOD"] == "POST") 
{
$uid = $_POST['rollno'];
$dob = $_POST["dob"];
$fname = $_POST["fname"];
$lname = $_POST["lname"];
$mname = $_POST["mname"];
$father = $_POST["father"];
$mother = $_POST["mother"];
$smobile = $_POST["smobile"];
$pmobile = $_POST["pmobile"];
$semail = $_POST["semail"];
$pemail = $_POST["pemail"];
$hno = $_POST["hno"];
$address1 = $_POST["address1"];
$address2 = $_POST["address2"];
$pincode = $_POST["pincode"];
$street = $_POST["street"];

if ($uid == "0")
{
	echo "Please select Roll No";
}
if ($fname == "")
{
	echo "please Enter First Name";
}
if ($lname == "")
{
	echo "please enter Last Name";
}
if ($father == "")
{
	echo "Please enter Father Name";
}
if ($mother == "")
{
	echo "Please Enter Mother Name";
}
if ($semail == "")
{
	echo "Please Enter Your Email ID";
}
if ($pemail == "")
{
	echo "Please Enter Your Parents Email Id";
}
if ($hno == "")
{
	echo "Please enter house Num";
}
if ($street == "")
{
	echo "Please enter street";
}
if ($address1 == "")
{
	echo "Please enter address";
}
if ($pincode == "")
{
	echo "Please enter pincode";
}
$sql1 = "INSERT INTO `users`(`uid`, `batch`, `fname`, `mname`, `lname`, `dob`, `father`, `mother`, `smobile`, `pmobile`, `semail`, `pemail`, `dept`, `hno`, `street`, `address1`, `address2`, `pincode`, `role`, `privacy`) 
	VALUES ('$uid','14','$fname','$mname','$lname','$dob','$father','$mother','$smobile','$pmobile','$semail','$pemail','it','$hno','$street','$address1','$address2','$pincode','1','0')";
	
$sql2 = "INSERT INTO `login`(`username`) VALUES ('$uid')";
if (mysqli_query($db,$sql1) && mysqli_query($db,$sql2))
{
echo "registered Successfully";
}	
}
?><!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>KITSW Konnect | Student</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  
</head>
<body>
<div id="response"></div>
<div class="box">
<div class="box box-header-with-border">
<h3> Register for <b style="color:red;">KITSW</b>  <b style="color:green;">Konnect</b></h3>
</div>
    <div class="box box-body">
	
        <form class="form-horizontal" method="post">
            <div class="form-group">
                <label for="inputName" class="col-sm-2 control-label">Student Details</label>
                    <div class="col-sm-10">
						<div class="row">
							<div class="col-xs-4">
								<select class="form-control" name="rollno">
									<option value="0">RollNo</option>
									<option value="b14it001">B14IT001</option>
									<option value="b14it003">B14IT003</option>
									<option value="b14it004">B14IT004</option>
									<option value="b14it005">B14IT005</option>
									<option value="b14it006">B14IT006</option>
									<option value="b14it007">B14IT007</option>
									<option value="b14it008">B14IT008</option>
									<option value="b14it009">B14IT009</option>
									<option value="b14it010">B14IT010</option>
									<option value="b14it011">B14IT011</option>
									<option value="b14it012">B14IT012</option>
									<option value="b14it013">B14IT013</option>
									<option value="b14it014">B14IT014</option>
									<option value="b14it015">B14IT015</option>
									<option value="b14it016">B14IT016</option>
									<option value="b14it017">B14IT017</option>
									<option value="b14it018">B14IT018</option>
									<option value="b14it019">B14IT019</option>
									<option value="b14it022">B14IT022</option>
									<option value="b14it023">B14IT023</option>
									<option value="b14it024">B14IT024</option>
									<option value="b14it025">B14IT025</option>
									<option value="b14it026">B14IT026</option>
									<option value="b14it027">B14IT027</option>
									<option value="b14it028">B14IT028</option>
									<option value="b14it029">B14IT029</option>
									<option value="b14it030">B14IT030</option>
									<option value="b14it031">B14IT031</option>
									<option value="b14it032">B14IT032</option>
									<option value="b14it033">B14IT033</option>
									<option value="b14it034">B14IT034</option>
									<option value="b14it035">B14IT035</option>
									<option value="b14it036">B14IT036</option>
									<option value="b14it037">B14IT037</option>
									<option value="b14it038">B14IT038</option>
									<option value="b14it039">B14IT039</option>
									<option value="b14it040">B14IT040</option>
									<option value="b14it041">B14IT041</option>
									<option value="b14it042">B14IT042</option>
									<option value="b14it043">B14IT043</option>
									<option value="b14it044">B14IT044</option>
									<option value="b14it045">B14IT045</option>
									<option value="b14it046">B14IT046</option>
									<option value="b14it047">B14IT047</option>
									<option value="b14it048">B14IT048</option>
									<option value="b14it049">B14IT049</option>
									<option value="b14it050">B14IT050</option>
									<option value="b14it051">B14IT051</option>
									<option value="b14it052">B14IT052</option>
									<option value="b14it053">B14IT053</option>
									<option value="b14it054">B14IT054</option>
									<option value="b14it055">B14IT055</option>
									<option value="b14it056">B14IT056</option>
									<option value="b14it057">B14IT057</option>
									<option value="b14it058">B14IT058</option>
									<option value="b14it059">B14IT059</option>
									<option value="b14it060">B14IT060</option>
									<option value="b15it061l">B15IT061L</option>
								</select>
							</div>
							<div class="col-xs-4">
								<input type="date" name="dob" class="form-control pull-right" placeholder=".col-xs-5">
							</div>
						</div>
                </div>
            </div>
			<div class="form-group">
                <label for="inputName" class="col-sm-2 control-label">Name</label>
                <div class="col-sm-10">
					<div class="row">
						<div class="col-xs-4">
							<input type="text" class="form-control" name="fname" placeholder="First Name">
						</div>
						<div class="col-xs-4">
							<input type="text" class="form-control" name="mname" placeholder="Middle Name">
						</div>
						<div class="col-xs-4">
							<input type="text" class="form-control" name="lname" placeholder="Last Name">
						</div>
					</div>
				</div>
            </div>
            <div class="form-group">
                <label for="inputExperience" class="col-sm-2 control-label">Parents</label>
                <div class="col-sm-10">
					<div class="row">
						<div class="col-xs-6">
							<input type="text" class="form-control" name="father" placeholder="Fathers Name">
						</div>
						<div class="col-xs-6">
							<input type="text" class="form-control" name="mother" placeholder="Mothers Name">
						</div>
					</div>
                </div>
            </div>
            <div class="form-group">
                <label for="inputSkills" class="col-sm-2 control-label">Contact</label>
					<div class="col-sm-10">
						<div class="row">
							<div class="col-xs-6">
								<input type="text" class="form-control" name="smobile" placeholder="Student Mobile">
							</div>	
							<div class="col-xs-6">
								<input type="text" class="form-control" name="pmobile"placeholder="Parent Mobile">
							</div>
						</div>
                    </div>
            </div>
            <div class="form-group">
                <label for="inputSkills" class="col-sm-2 control-label">Email</label>
                <div class="col-sm-10">
                    <div class="row">
						<div class="col-xs-6">
							<input type="text" class="form-control" name="semail" placeholder="Student Email">
						</div>
						<div class="col-xs-6">
							<input type="text" class="form-control" name="pemail"placeholder="Parent Email">
						</div>
					</div>
                </div>
            </div>
			<div class="form-group">
                <label for="inputSkills" class="col-sm-2 control-label">Address info</label>
                <div class="col-sm-10">
					<div class="row">
						<div class="col-xs-4">
							<input type="text" class="form-control" name="hno" placeholder="House No">
						</div>
						<div class="col-xs-4">
							<input type="text" class="form-control" name="street" placeholder="Street">
						</div>
						<div class="col-xs-4">
							<input type="text" class="form-control" name="pincode" placeholder="Pincode">
						</div>                
					</div>
                </div>
			</div>
			<div class="form-group">
                <label for="inputSkills" class="col-sm-2 control-label">Address</label>
                <div class="col-sm-10">
					<div class="row">
						<div class="col-xs-6">
							<input type="text" class="form-control" name="address1" placeholder="address1">
						</div>
						<div class="col-xs-6">
							<input type="text" class="form-control" name="address2" placeholder="address2">
						</div>
					</div>
                </div>                
            </div>
            <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
						<input type="submit" value="register" name="register">
                    </div>
            </div>
        </form>
    </div>
</div>
</body>
</html>