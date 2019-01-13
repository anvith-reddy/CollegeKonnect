<?php
include("../../../includes/config.php");
include("../../../includes/functions.php");
$q = $_GET['q'];
$sql="select * from subjects where dept='".$q."'";
$result=mysqli_query($db,$sql);
?>
<table class="table table-hover">
                <tr>
					<th>ID</th>
					<th>Code</th>
					<th>Name</th>
					<th>Short Code</th>
					<th>Credits</th>
					<th>
						
						<select name="category" onchange="showUser(this.value)">
							<option value="0">Department</option>
							<?php 
								$sql_subjects = "select DISTINCT(dept) from subjects";
								$result1 = mysqli_query($db,$sql_subjects);
								if ($result1->num_rows > 0) 
								{
									while($row1 = $result1->fetch_assoc()) 
									{	
										echo '<option value="'. $row1["dept"].'">'. $row1["dept"].'</option>';
									}						
								}
							?>
						</select>
						</form>
					</th>
					<th>Question</th>
				</tr>
				<?php 
					if ($result->num_rows > 0) 
					{
						while($row = $result->fetch_assoc()) 
							{	
				?>
							<tr>
							<td> <?php echo $row["id"]; ?> </td>
							<td> <?php echo $row["code"]; ?> </td>
							<td> <?php echo $row["name"]; ?> </td>
							<td> <label class="label label-warning"><?php echo $row["short"]; ?> </label></td>
							<td> <?php echo $row["credits"]; ?> </td>
							<td> <?php echo $row["dept"]; ?> </td>
							</tr>
				<?php
						}						
					}
				?>
              </table>
