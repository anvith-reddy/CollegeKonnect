<?php
include("../../../includes/session.php");
include("../../../includes/functions.php");
include("../../../includes/config.php");
$id = $_GET["id"];
$query = "select * from users where uid='$id'";
$result = mysqli_fetch_array(mysqli_query($db,$query));
?>
<div class="row">
<div class="col-md-12">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#activity" data-toggle="tab">Overview</a></li>
              <li><a href="#timeline" data-toggle="tab">Profile</a></li>
              <li><a href="#settings" data-toggle="tab">Settings</a></li>
            </ul>
            <div class="tab-content">
              <div class="active tab-pane" id="activity">
                <div class="row">
        <div class="col-md-6">
          <!-- Widget: user widget style 1 -->
          <div class="box box-widget widget-user-2">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            
            <div class="box-footer no-padding">
              <ul class="nav nav-stacked">
                <li><a href="#">Achievements <span class="pull-right badge bg-blue">31</span></a></li>
                <li><a href="#">Events <span class="pull-right badge bg-aqua">5</span></a></li>
                <li><a href="#">Questions <span class="pull-right badge bg-green">12</span></a></li>
                <li><a href="#">Answers <span class="pull-right badge bg-red">842</span></a></li>
              </ul>
            </div>
          </div>
          <!-- /.widget-user -->
        </div>
        <!-- /.col -->
        <div class="col-md-6">
          <!-- Widget: user widget style 1 -->
          <div class="box box-widget widget-user">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-aqua-active">
              <h3 class="widget-user-username"><?php echo $result['fname']." ".$result['mname']." ".$result['lname']; ?></h3>
              <h5 class="widget-user-desc"><?php echo $result['uid']; ?></h5>
            </div>
            <div class="widget-user-image">
              <img class="img-circle" src="../dist/img/user1-128x128.jpg" alt="User Avatar">
            </div>
            
          </div>
          <!-- /.widget-user -->
        </div><!-- /.post -->
              </div>
			  </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="timeline">
                <!-- The timeline -->
                <form class="form-horizontal">
                  <div class="form-group">
                    <label for="inputName"  class="col-sm-2 control-label"><?php echo strtoupper($result["uid"]); ?>'s Details</label>

                    <div class="col-sm-10">
                      <div class="row">
                <div class="col-xs-4">
                  <input type="hidden" class="form-control" placeholder=".col-xs-3">
                </div>
                <div class="col-xs-4">
                  <input type="hidden" class="form-control" placeholder=".col-xs-4">
                </div>
                <div class="col-xs-4">
                  <input type="date" id="dob" class="form-control pull-right" placeholder=".col-xs-5">
                </div>
              </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Student Details</label>

                    <div class="col-sm-10">
                      <div class="row">
                <div class="col-xs-4">
                  <input type="text" class="form-control" id="uid" placeholder="<?php echo $result['uid']; ?>">
                </div>
                <div class="col-xs-4">
                  <select id="dept" class="form-control">
					<option value=""><?php echo $result['dept']; ?></option>
					<option value="cs">CSE</option>
					<option value="ec">ECE</option>
					<option value="ee">EEE</option>
					<option value="me">MEC</option>
					<option value="ce">CIV</option>
					<option value="ei">EIE</option>
					<option value="it">IT</option>
					</select>
                </div>
                <div class="col-xs-4">
                  <select id="batch" class="form-control">
					<option value=""><?php echo $result['batch']; ?></option>
					<option value="14">2014</option>
					<option value="15">2015</option>
					<option value="16">2016</option>
					<option value="17">2017</option>
					<option value="18">2018</option>
					<option value="19">2019</option>
					<option value="20">2020</option>
					<option value="21">2021</option>
					<option value="22">2022</option>
					<option value="23">2023</option>
					<option value="24">2024</option>
					<option value="25">2025</option>
					<option value="26">2026</option>
					</select>
                </div>
              </div>
                    </div>
                  </div><div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Name</label>

                    <div class="col-sm-10">
                      <div class="row">
                <div class="col-xs-4">
                  <input type="text" class="form-control" id="fname" placeholder="<?php echo $result['fname']; ?>">
                </div>
                <div class="col-xs-4">
                  <input type="text" class="form-control" id="mname" placeholder="<?php echo $result['mname']; ?>">
                </div>
                <div class="col-xs-4">
                  <input type="text" class="form-control" id="lname" placeholder="<?php echo $result['lname']; ?>">
                </div>
              </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputExperience" class="col-sm-2 control-label">Parents</label>

                    <div class="col-sm-10">
                      <div class="row">
                <div class="col-xs-6">
                  <input type="text" class="form-control" id="father" placeholder="<?php echo $result['father']; ?>">
                </div>
                <div class="col-xs-6">
                  <input type="text" class="form-control" id="mother" placeholder="<?php echo $result['mother']; ?>">
                </div>
                
              </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputSkills" class="col-sm-2 control-label">Contact</label>

                    <div class="col-sm-10">
                      <div class="row">
                <div class="col-xs-6">
                  <input type="text" class="form-control" id="smobile" placeholder="<?php echo $result['smobile']; ?>">
                </div>
                <div class="col-xs-6">
                  <input type="text" class="form-control" id="pmobile"placeholder="<?php echo $result['pmobile']; ?>">
                </div>
                
              </div>
                    </div>
                
                  </div>
                  <div class="form-group">
                    <label for="inputSkills" class="col-sm-2 control-label">Email</label>

                    <div class="col-sm-10">
                      <div class="row">
                <div class="col-xs-6">
                  <input type="text" class="form-control" id="semail" placeholder="<?php echo $result['semail']; ?>">
                </div>
                <div class="col-xs-6">
                  <input type="text" class="form-control" id="pemail"placeholder="<?php echo $result['pemail']; ?>">
                </div>
                
              </div>
                    </div>
           
                  </div>
				  <div class="form-group">
                    <label for="inputSkills" class="col-sm-2 control-label">Address info</label>

                    <div class="col-sm-10">
                      <div class="row">
                <div class="col-xs-4">
                  <input type="text" class="form-control" id="hno" placeholder="<?php echo $result['hno']; ?>">
                </div>
                <div class="col-xs-4">
                  <input type="text" class="form-control" id="street" placeholder="<?php echo $result['street']; ?>">
                </div>
				<div class="col-xs-4">
                  <input type="text" class="form-control" id="pincode" placeholder="<?php echo $result['pincode']; ?>">
                </div>
                
              </div>
                    </div>
                
                  </div>
				  <div class="form-group">
                    <label for="inputSkills" class="col-sm-2 control-label">Address</label>

                    <div class="col-sm-10">
                      <div class="row">
                <div class="col-xs-6">
                  <input type="text" class="form-control" id="address1" placeholder="<?php echo $result['address1']; ?>">
                </div>
                <div class="col-xs-6">
                  <input type="text" class="form-control" id="address2" placeholder="<?php echo $result['address2']; ?>">
                </div>
				
                
              </div>
                    </div>
                
                  </div>
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10 pull-right">
                      <button type="button" onclick="update_user('<?php echo $result['uid']; ?>')"class="btn btn-info">Update</button>
                    </div>
                  </div>
                </form>
              
              </div>
              <!-- /.tab-pane -->

              <div class="tab-pane" id="settings">
                <div class="row">
					<div class="form group">
						<button class="btn btn-info"> Reset Password </button>
						<button class="btn btn-info"> Reset Pin </button>
						
					</div>
					<div class="form group">
						<select id="role" class="form-group">
						<option value=""> Role </option>
						<option value="1">Student</option>
						<option value="2">Faculty</option>
						<option value="3">Admin</option>
						</select>
				</div>
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
