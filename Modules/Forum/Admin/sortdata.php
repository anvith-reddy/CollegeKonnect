<?php
include("../../../includes/config.php");
include("../../../includes/functions.php");
$q = $_GET['q'];
$sql="select * from forum_q where status='".$q."' OR category='".$q."'";
$result=mysqli_query($db,$sql);
?>
<table class="table table-hover">
                <tr>
					<th>ID</th>
					<th>User</th>
					<th>Date</th>
					<th>
						<form>
						<select name="status" onchange="showUser(this.value)">
							<option value="">Status</option>
							<option value="open">OPEN</option>
							<option value="closed">CLOSED </option>
						</select>
					</th>
					<th>
						
						<select name="category" onchange="showUser(this.value)">
							<option value="">Category</option>
							<?php 
								$result1 = forum_categories();
								if ($result1->num_rows > 0) 
								{
									while($row = $result1->fetch_assoc()) 
									{	
										echo '<option value="'. $row["category"].'">'. $row["category"].'</option>';
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
							<tr onclick="document.location = 'view.php?thread=<?php echo $row["id"]; ?>';">>
							<td> <?php echo $row["id"]; ?></td>
							<td> <?php echo $row["display_name"]; ?> </td>
							<td> <?php echo $row["posted_on"]; ?> </td>
							<td> <label class="label label-warning"><?php echo $row["status"]; ?> </label></td>
							<td> <?php echo $row["category"]; ?> </td>
							<td> <?php echo $row["question"]; ?></td>
							</tr>
				<?php
						}						
					}
				?>
              </table>
