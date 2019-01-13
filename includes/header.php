				<div class="container">
				<!-- Modal -->
					<div class="modal fade" id="profile" role="dialog">
						<div class="modal-dialog modal-sm">
							<!-- Modal content-->
							<div class="modal-content">
								
								<div class="modal-body" style="padding:10px 10px 0px 10px;">
									<div class="row">
									<div class="col-md-12">
          <!-- Widget: user widget style 1 -->
          <div class="box box-widget widget-user">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-aqua-active">
              <center><h3 class="widget-user-username"><b><?php echo strtoupper($_SESSION['login_user']); ?></b></h3></center>
              
            </div>
            <div class="widget-user-image">
			<?php $query="select profile from users where uid='$user'";
					$result = mysqli_fetch_assoc(mysqli_query($db,$query));
				echo '<img class="img-circle" src="data:image/jpeg;base64,'.base64_encode( $result['profile'] ).'" />'?>
            </div>
            <div class="box-footer">
              <div class="row">
                <div class="col-sm-6 border-right">
                  <div class="description-block">
                    <a href="../../Profile/Student/"><h5 class="badge"><i class="fa fa-user"> </i></h5><br>PROFILE</a>
                  </div>
                  <!-- /.description-block -->
                </div>
                
                <!-- /.col -->
                <div class="col-sm-6">
                  <div class="description-block">
                    
                    <span class="description-text"><a href="../../../includes/logout.php"><h5 class="badge"><i class="fa fa-sign-out"> </i></h5><br>SIGN OUT</a></span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
          </div>
          <!-- /.widget-user -->
        </div>
		</div>
								</div>
							</div>
						</div>
					</div> 
				</div>

<header class="main-header">
    <!-- Logo -->
    <a href="index2.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>KITS</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>KITSW</b>&nbsp;zone</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="javascript:void(0);" data-toggle="modal" data-target="#profile" class="dropdown-toggle">
            
              <button class="btn btn-info btn-xs"><span class="hidden-xs"><?php echo strtoupper($_SESSION['login_user']); ?></span></button>
            </a>
            
          </li>
          <!-- Control Sidebar Toggle Button -->
        </ul>
      </div>
    </nav>
  </header>
  