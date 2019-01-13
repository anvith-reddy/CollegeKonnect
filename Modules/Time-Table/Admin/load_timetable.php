<?php
include("../../../includes/config.php");
include("../../../includes/functions.php");
include("../../../includes/session.php");
$user = $_SESSION['login_user'];
$year = $_POST['year'];
$dept = $_POST['dept'];
$section = $_POST['section'];

if ($year == "0" || $dept =="0" || $section == "0")
{
 echo "Please check all Fields";
} 


$section = $dept.$section;
$dept_slot = "select `".$year."` from dept_slots where class = '$section'";
$dept_slot = mysqli_fetch_array(mysqli_query($db,$dept_slot));

$time = "select * from time_table where dept_slots = '$dept_slot[0]'";
$some = mysqli_fetch_array(mysqli_query($db,$time));
$timings = "select start_time,end_time from time_slots";
$timings = mysqli_query($db,$timings);
?>
<input type="hidden" id="dept_slot" value="<?php echo $dept_slot[0]; ?>">
<div class="box-body table-responsive no-padding" id="forum_data">
              <table class="table table-hover">
			  <tr>
					<th>Time/Day</th>
					<th>Monday</th>
					<th>Tuesday</th>
					<th>Wednesday</th>
					<th>Thursday</th>
					<th>Friday</th>
					<th>Saturday</th>
					</tr>
    <?php
$i=1;	foreach($timings as $timings)
	{
		echo '<tr>';?> <th class="headcol"><b><?php
		echo $timings["start_time"];echo "-";echo $timings["end_time"];?></b></th><?php
		while ($i<sizeof($some)-2)
		{
			if($i % 6 == 0)
			{
				echo '<td>';
				echo subject_parse($some[$i]);
				?>
				<a data-toggle="modal" data-id='<?php echo $some[$i]; ?>' class="open-viewFacultyDialog" href="#viewFacultyDialog"><i class="fa fa-edit pull-right"></i></a><?php
				
				echo '</td></tr>';
				$i=$i+1;
				
				break;
			}
			else{
				echo '<td>';
				?>
				<?php echo subject_parse($some[$i]); ?>
				<a data-toggle="modal" data-id='<?php echo $i; ?>' class="open-viewFacultyDialog" href="#viewFacultyDialog"> <i class="fa fa-edit pull-right"></i></a><?php
				echo '</td>';
				$i =$i+1;
			}
		}
		
	}?>
	

</table>