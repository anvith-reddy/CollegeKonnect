<?php
include("../../../includes/config.php");
include("../../../includes/functions.php");
$q = $_GET['q'];
$sql="select * from library where publications='".$q."' OR domain='".$q."'";
$result=mysqli_query($db,$sql);
?>
<table class="table table-hover">
                <tr>
					<th>Uploaded By</th>
					<th>Title</th>
					<th>Edition</th>
					<th>Authors</th>
					<th>
						<form>
						<select name="publications" onchange="showUser(this.value)">
							<option value="">Publications</option>
							<?php 
								$queryas = "select distinct publications from library";
								$res1 = mysqli_query($db,$queryas);
								if ($res1->num_rows > 0) 
								{
									while($rowa1 = $res1->fetch_assoc()) 
									{	
										echo '<option value="'. $rowa1["publications"].'">'. $rowa1["publications"].'</option>';
									}						
								}
							?>
						</select>
						
					</th>
					<th><select name="publications" onchange="showUser(this.value)">
							<option value="">domain</option>
							<?php 
								$query1 = "select distinct domain from library";
								$result2 = mysqli_query($db,$query1);
								if ($result2->num_rows > 0) 
								{
									while($row2 = $result2->fetch_assoc()) 
									{	
										echo '<option value="'. $row2["domain"].'">'. $row2["domain"].'</option>';
									}						
								}
							?>
						</select>
					</form></th>
				</tr>
				<?php 
					if ($result->num_rows > 0) 
					{
						while($row = $result->fetch_assoc()) 
							{	
				?>
							<tr onclick="document.location = 'download.php?id=<?php echo $row["id"]; ?>';">
							<td> <?php echo $row["by_user"]; ?> </td>
							<td> <?php echo $row["title"]; ?></td>
							<td> <?php echo $row["edition"]; ?> </td>
							<td> <?php echo $row["authors"]; ?> </td>
							<td> <?php echo $row["publications"]; ?> </td>
							<td> <?php echo $row["domain"]; ?> </td>
						
							</tr>
				<?php
						}						
					}
				?>
              </table>
