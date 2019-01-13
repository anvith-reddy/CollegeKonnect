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
$sql = "SELECT count(*) FROM mail  WHERE ((sender = '$user') AND (sarchived = 1)) OR ((receiver = '$user') AND (rarchived = 1))" ;
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
$sql2 = " SELECT * FROM mail WHERE ((sender = '$user') AND (sarchived = 1)) OR ((receiver = '$user') AND (rarchived = 1)) order by mdate DESC limit ". ($lower_limit)." ,  ". ($page_limit). " ";
$numrows = "0";
?>

              <table class="table table-hover table-striped">
			  
    <?php 
					if($result = mysqli_query($db,$sql2))
{
	$numrows = mysqli_num_rows($result);
}
					if ($numrows > 0) 
					{
						while($row = $result->fetch_assoc()) 
							{	
				?>
							<tr>
							<th>
								<form method="post">
								<input type="hidden" name="value" value="<?php echo $row['id']; ?>">
								<button type='submit' name='delete' ><i class='fa fa-trash'></i></button>
								<b><a href="view.php?mail=<?php echo $row['id']; ?>"><b> <?php echo $row['sender']; ?> </b></a></b></form>
							</th><td>
							<a href="view.php?mail=<?php echo $row['id']; ?>"><?php echo htmlspecialchars($row['subject']); ?></a><b>-</b>
							 <i><?php echo strip_tags($row['message']);?></i> </td>
							
							</tr>
				<?php
						}						
					}
					else
					{
						echo '<div class="alert alert-danger alert-dismissable">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
					<strong>SORRY!</strong> No Mails in your archived.
				</div>';
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
	 <a href="javascript:void(0);" class="links" onclick="archived('<?php echo $page_limit;  ?>', '<?php echo 1; ?>');"><button>First</button></a>
	<a href="javascript:void(0);" class="links"  onclick="archived('<?php echo $page_limit;  ?>', '<?php echo $pagenum-1; ?>');"><button>Previous</button></a>
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
	<a href="javascript:void(0);" class="links"  onclick="archived('<?php echo $page_limit;  ?>', '<?php echo $i; ?>');" ><button><?php echo $i ?></button></a>
<?php 
	}
} 
if ( ($pagenum+1) <= $last) {
?>
	<a href="javascript:void(0);" onclick="archived('<?php echo $page_limit;  ?>', '<?php echo $pagenum+1; ?>');" class="links"><button>Next</button></a>
<?php } if ( ($pagenum) != $last) { ?>	
	<a href="javascript:void(0);" onclick="archived('<?php echo $page_limit;  ?>', '<?php echo $last; ?>');" class="links" ><button>Last</button></a> 
<?php
	} 
?>
</td>
	<td align="right" valign="top" class="pull-right">
	Page <?php echo $pagenum; ?> of <?php echo $last; ?>
	</td>
</tr>
</table>