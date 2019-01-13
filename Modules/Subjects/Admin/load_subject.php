<?php
include("../../../includes/config.php");
$id = $_GET["id"];
$sql = "select * from subjects where id = '$id'";
$result = mysqli_fetch_array(mysqli_query($db,$sql));
?>
<form class="form-horizontal" role="form" enctype="multipart/form-data" method="post">
									<div class="form-group">
                                            
                                            <div class="col-sm-12">
												<input type="text" name="subject_name" class="form-control"  placeholder="<?php echo $result["name"]; ?>">
                                            </div>
										</div>
										<div class="form-group">
                                            
											<div class="row">
                                            <div class="col-sm-6">
												<input type="text" name="subject_code" class="form-control" placeholder="<?php echo $result["code"]; ?>">
											</div>
											<div class="col-sm-6">
												<input type="text" name="subject_short" class="form-control" placeholder="<?php echo $result["short"]; ?>">
											</div>
											</div>
                                        </div>
										
										
										<div class="form-group">
                                            
											<div class="row">
                                            <div class="col-sm-6">
												<select class="form-control select2" name="credits" id="credits">
	<option value="<?php echo $result["credits"]; ?>"><?php echo $result["credits"]; ?></option>
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
	<option value="<?php echo $result["dept"]; ?>"><?php echo $result["dept"]; ?></option>
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
