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
$sql = "SELECT count(*) FROM library  WHERE 1" ;
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
$sql2 = " SELECT * FROM library WHERE 1 order by title limit ". ($lower_limit)." ,  ". ($page_limit). " ";
$result = mysqli_query($db,$sql2);
?>
<div class="box-body table-responsive no-padding" id="forum_data">
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
	 <a href="javascript:void(0);" class="links" onclick="displayRecords('<?php echo $page_limit;  ?>', '<?php echo 1; ?>');"><button>First</button></a>
	<a href="javascript:void(0);" class="links"  onclick="displayRecords('<?php echo $page_limit;  ?>', '<?php echo $pagenum-1; ?>');"><button>Previous</button></a>
	<?php
	}
	//Show page links
	for($i=1; $i<=$last; $i++) {
		if ($i == $pagenum ) {
?>
		<a href="javascript:void(0);" class="selected" ><button><?php echo $i ?></button></a>
<?php
	} else {  
?>
	<a href="javascript:void(0);" class="links"  onclick="displayRecords('<?php echo $page_limit;  ?>', '<?php echo $i; ?>');" ><button><?php echo $i ?></button></a>
<?php 
	}
} 
if ( ($pagenum+1) <= $last) {
?>
	<a href="javascript:void(0);" onclick="displayRecords('<?php echo $page_limit;  ?>', '<?php echo $pagenum+1; ?>');" class="links"><button>Next</button></a>
<?php } if ( ($pagenum) != $last) { ?>	
	<a href="javascript:void(0);" onclick="displayRecords('<?php echo $page_limit;  ?>', '<?php echo $last; ?>');" class="links" ><button>Last</button></a> 
<?php
	} 
?>
</td>
	<td align="right" valign="top" class="pull-right">
	Page <?php echo $pagenum; ?> of <?php echo $last; ?>
	</td>
</tr>
</table>