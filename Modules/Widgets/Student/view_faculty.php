<?php
include("../../../includes/session.php");
include("../../../includes/functions.php");
include("../../../includes/config.php");
$uid = $_GET['id'];
$query = "select * from faculty where uid = '$uid'";
$result = mysqli_fetch_array(mysqli_query($db,$query));
?>
<div class="box box-widget widget-user">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-aqua-active">
              <h3 class="widget-user-username"><b><?php echo $result["mname"];echo " ";echo $result["lname"];echo " "; echo $result["fname"]; ?></b></h3>
              <h5 class="widget-user-desc"><?php echo $result["designation"]; ?></h5>
            </div>
            <div class="widget-user-image">
			<?php echo '<img class="img-circle" src="data:image/jpeg;base64,'.base64_encode( $result['profile'] ).'" />'; ?>
            </div>
            <div class="box-footer">
              <div class="row">
                <div class="col-sm-4 border-right">
                  <div class="description-block">
                    <h5 class="description-header"><i class="fa fa-home"></i></h5>
                    <span class="description-text">Block No :<?php echo $result["block"]; ?><br>Room No :<?php echo $result["room"]; ?></span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-4 border-right">
                  <div class="description-block">
                    <h5 class="description-header"><i class="fa fa-envelope-o"></i></h5>
                    <span class="description-text"><?php echo $result["email"]; ?></span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-4">
                  <div class="description-block">
                    <h5 class="description-header"><i class="fa fa-phone"></i></h5>
                    <span class="description-text"><?php echo $result["mobile"]; ?></span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
			<div class="box-footer no-padding">
              <ul class="nav nav-stacked">
                <li><a>Address <span class="pull-right"><?php echo $result["address"]; ?></span></a></li>
                <li><a href="#">Tasks <span class="pull-right badge bg-aqua">5</span></a></li>
                <li><a href="#">Completed Projects <span class="pull-right badge bg-green">12</span></a></li>
                <li><a href="#">Followers <span class="pull-right badge bg-red">842</span></a></li>
              </ul>
            </div>
          </div>';

