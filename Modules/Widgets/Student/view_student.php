<?php
include("../../../includes/session.php");
include("../../../includes/functions.php");
include("../../../includes/config.php");
$uid = $_GET['id'];
$query = "select * from users where uid = '$uid'";
$result = mysqli_fetch_array(mysqli_query($db,$query));
if  ($result["privacy"] == 0 )
{
?>
<div class="box box-widget widget-user">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-aqua-active">
              <h3 class="widget-user-username"><b><?php echo $result["mname"];echo " ";echo $result["lname"];echo " "; echo $result["fname"]; ?></b></h3>
              <h5 class="widget-user-desc"><?php echo $result["uid"]; ?></h5>
            </div>
            <div class="widget-user-image">
			<?php echo '<img class="img-circle" src="data:image/jpeg;base64,'.base64_encode( $result['profile'] ).'" />'; ?>
            </div>
            
            
            <div class="box-footer">
              <div class="row">
                <div class="col-sm-4 border-right">
                  <div class="description-block">
                    <h5 class="description-header"><i class="fa fa-home"></i></h5>
                    <span class="badge"><?php echo $result["hno"]; echo '<br>'; echo $result["street"]."<br>".$result["address1"]."<br>".$result["address2"]; echo '<br>';echo $result['pincode']; ?></span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-4 border-right">
                  <div class="description-block">
                    <h5 class="description-header"><i class="fa fa-envelope-o"></i></h5>
                    <span class="badge"><i class="fa fa-user">    <b><?php echo $result["semail"]; ?></b></i></span><br>
					<span class="badge"><i class="fa fa-group">    <b><?php echo $result["pemail"]; ?></b></i></span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-4">
                  <div class="description-block">
                    <h5 class="description-header"><i class="fa fa-phone"></i></h5>
                    <span class="badge"><i class="fa fa-user">       <b><?php echo $result["smobile"]; ?></b></i></span><br>
					<span class="badge"><i class="fa fa-group">    <b><?php echo $result["pmobile"]; ?></b></i></span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
			<div class="box-footer no-padding">
              <ul class="nav nav-stacked">
                <li><a><b>Date of Birth </b><span class="pull-right badge bg-green"><?php echo $result["dob"]; ?></span></a></li>
                <li><a href="#"><b>Father's Name </b><span class="pull-right badge bg-aqua"><b><?php echo ucwords($result["father"]); ?></b></span></a></li>
                <li><a href="#"><b>Mother's Name </b><span class="pull-right badge bg-aqua"><b><?php echo ucwords($result["mother"]); ?></b></span></a></li>
              </ul>
            </div>
          </div>

          </div>';
<?php 
}
else
{
	?>
	Sorry! User enabled Privacy.
<?php } ?>