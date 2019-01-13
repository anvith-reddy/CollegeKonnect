<?php
include("../../../includes/config.php");
include("../../../includes/functions.php");
include("../../../includes/session.php");
$user = $_SESSION['login_user'];

// Very important to set the page number first.
if (!(isset($_GET['pagenum']))) { 
	 $pagenum = 1; 
} else {
	$pagenum = intval($_GET['pagenum']); 		
}
//Number of results displayed per page 	by default its 10.
$page_limit =  ($_GET["show"] <> "" && is_numeric($_GET["show"]) ) ? intval($_GET["show"]) : 10;

// Get the total number of rows in the table
$sql = "SELECT count(*) FROM forum_a  WHERE by_user='$user'" ;
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
$sql2 = " SELECT * FROM forum_a WHERE by_user='$user' limit ". ($lower_limit)." ,  ". ($page_limit). " ";
$result = mysqli_query($db,$sql2);
?>

<div class="box-body table-responsive no-padding" id="forum_data">
              <table class="table table-hover">
			  <tr>
					<th>Question ID</th>
					<th>Posted as</th>
					<th>Date</th>
					<th>Answer</th>
					</tr>
    <?php 
					if ($result->num_rows > 0) 
					{
						while($row = $result->fetch_assoc()) 
							{	
				?>
							<tr onclick="document.location = 'view.php?thread=<?php echo $row["qid"]; ?>';">
							<td> <?php echo $row["qid"]; ?> </td>
							<td> <?php echo $row["display_name"]; ?> </td>
							<td> <?php echo $row["posted_on"]; ?> </td>
							<td> <?php echo $row["answer"]; ?> </td>
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
	 <a href="javascript:void(0);" class="links" onclick="my_answers('<?php echo $page_limit;  ?>', '<?php echo 1; ?>');"><button>First</button></a>
	<a href="javascript:void(0);" class="links"  onclick="my_answers('<?php echo $page_limit;  ?>', '<?php echo $pagenum-1; ?>');"><button>Previous</button></a>
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
	<a href="javascript:void(0);" class="links"  onclick="my_answers('<?php echo $page_limit;  ?>', '<?php echo $i; ?>');" ><button><?php echo $i ?></button></a>
<?php 
	}
} 
if ( ($pagenum+1) <= $last) {
?>
	<a href="javascript:void(0);" onclick="my_answers('<?php echo $page_limit;  ?>', '<?php echo $pagenum+1; ?>');" class="links"><button>Next</button></a>
<?php } if ( ($pagenum) != $last) { ?>	
	<a href="javascript:void(0);" onclick="my_answers('<?php echo $page_limit;  ?>', '<?php echo $last; ?>');" class="links" ><button>Last</button></a> 
<?php
	} 
?>
</td>
	<td align="right" valign="top" class="pull-right">
	Page <?php echo $pagenum; ?> of <?php echo $last; ?>
	</td>
</tr>
</table>