<?php
include("../../../includes/config.php");
include("../../../includes/functions.php");

// Very important to set the page number first.
if (!(isset($_GET['pagenum']))) { 
	 $pagenum = 1; 
} else {
	$pagenum = intval($_GET['pagenum']); 		
}
//Number of results displayed per page 	by default its 10.
$page_limit =  ($_GET["show"] <> "" && is_numeric($_GET["show"]) ) ? intval($_GET["show"]) : 10;

// Get the total number of rows in the table
$sql = "SELECT count(*) FROM subjects  WHERE 1" ;
    $stmt = mysqli_query($db,$sql);
	$tresults = mysqli_fetch_array($stmt);
$cnt = $tresults[0];


//Calculate the last page based on total number of rows and rows per page. 
$last = ceil($cnt/$page_limit);


//this makes sure the page number isn't below one, or more than our maximum pages 
if ($pagenum < 1) { 
	$pagenum = 1; 
} elseif ($pagenum > $last)  { 
	$pagenum = $last; 
}
$lower_limit = ($pagenum - 1) * $page_limit;

$result1 = forum_categories();
$sql2 = " SELECT * FROM subjects WHERE 1 limit ". ($lower_limit)." ,  ". ($page_limit). " ";
$result = mysqli_query($db,$sql2);
?>
<div class="box-body table-responsive no-padding" id="forum_data">
              <table class="table table-hover" cellspacing=0>
			  <tr>
					<th>ID</th>
					<th>Name</th>
					<th>Code</th>
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
					<th>Operations</th>
					</tr>
    <?php 
					if ($result->num_rows > 0) 
					{
						while($row = $result->fetch_assoc()) 
							{	
				?>
							<tr>
							<td> <?php echo $row["id"]; ?> </td>
							<td> <?php echo $row["name"]; ?> </td>
							<td> <?php echo $row["code"]; ?> </td>
							<td> <label class="label label-warning"><?php echo $row["short"]; ?> </label></td>
							<td> <?php echo $row["credits"]; ?> </td>
							<td> <?php echo $row["dept"]; ?> </td>
							<td>
							<button class="btn btn-success btn-xs"><a href="download.php?id=<?php echo $row["id"]; ?>"><i class="fa fa-download"></i></a></button>
							<a data-toggle="modal" data-id='<?php echo $row["id"]; ?>' class="open-edit_subject" href="#edit_subject"> <i class="fa fa-edit pull-right"></i></a>
							<button class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></button>
							</tr>
				<?php
						}						
					}
				?>
<tr>
  <td valign="top" align="left">
	
<label> Rows Limit: 
<select name="show" onChange="changeDisplayRowCount(this.value);">
  <option value="10" <?php if ($_GET["show"] == 10 || $_GET["show"] == "" ) { echo ' selected="selected"'; }  ?> >10</option>
  <option value="20" <?php if ($_GET["show"] == 20) { echo ' selected="selected"'; }  ?> >20</option>
  <option value="30" <?php if ($_GET["show"] == 30) { echo ' selected="selected"'; }  ?> >30</option>
</select>
</label>

	</td>
  <td valign="top" align="center" >
 
	<?php
	if ( ($pagenum-1) > 0) {
	?>	
	 <a href="javascript:void(0);" class="links" onclick="displayRecords('<?php echo $page_limit;  ?>', '<?php echo 1; ?>');"><button class="btn btn-info btn-xs">First</button></a>
	<a href="javascript:void(0);" class="links"  onclick="displayRecords('<?php echo $page_limit;  ?>', '<?php echo $pagenum-1; ?>');"><button class="btn btn-info btn-xs"><i class="fa fa-arrow-left"></i><b>&nbsp;Previous</b></button></a>
	<?php
	}
	//Show page links
	for($i=1; $i<=$last; $i++) {
		if ($i == $pagenum ) {
?>
		<a href="javascript:void(0);" class="selected" ><button class="btn btn-info btn-xs"><?php echo $i ?></button></a>
<?php
	} else {  
?>
	<a href="javascript:void(0);" class="links"  onclick="displayRecords('<?php echo $page_limit;  ?>', '<?php echo $i; ?>');" ><button class="btn btn-info btn-xs"><?php echo $i ?></button></a>
<?php 
	}
} 
if ( ($pagenum+1) <= $last) {
?>
	<a href="javascript:void(0);" onclick="displayRecords('<?php echo $page_limit;  ?>', '<?php echo $pagenum+1; ?>');" class="links"><button class="btn btn-info btn-xs"><i class="fa fa-arrow-circle-right"></i><b>&nbsp;Next</b></button></a>
<?php } if ( ($pagenum) != $last) { ?>	
	<a href="javascript:void(0);" onclick="displayRecords('<?php echo $page_limit;  ?>', '<?php echo $last; ?>');" class="links" ><button class="btn btn-info btn-xs"><i class="angle-double-right"></i><b>&nbsp;Last</b></button></a> 
<?php
	} 
?>
</td>
	<td align="right" valign="top" class="pull-right">
	Page <?php echo $pagenum; ?> of <?php echo $last; ?>
	</td>
</tr>
</table>