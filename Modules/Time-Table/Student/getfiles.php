<?php
include("../../../includes/config.php");
include("../../../includes/functions.php");
include("../../../includes/session.php");
$user = $_SESSION['login_user'];

if (strlen($user) == 8)
{
	$batch = substr($user,1,2);
	$lateral = 0;
}
else if (strlen($user) == 9)
{
	$batch = substr($user,1,2) - 1;
	$lateral = 1;
}

$dept = substr($user,3,2);
$roll = substr($user,5,3);

$que = "select value1,value2,value3 from options where option = 'section'";
$result = mysqli_fetch_array(mysqli_query($db,$que));
for($j=0;$j<3;$j++)
{
	if ($lateral == 0)
	{
		$low = substr($result[$j],0,3);
		$high = substr($result[$j],4,3);
		if ($roll >= $low && $roll <=$high)
		{
			$section = $j + 1;
			
		}
	}
	else if ($lateral == 1)
	{
		$low = substr($result[$j],8,3);
		$high = substr($result[$j],12,3);
		if ($roll >= $low && $roll <=$high)
		{
			$section = $j + 1;
			
		}
	}
}

$query1 = "select option,value1,value2,value3,value4 from options where option = 'batch'";
$result = mysqli_fetch_array(mysqli_query($db,$query1));
for($i=1;$i<5;$i++)
{
	if ($result[$i] == $batch)
	{
		if ($i == 1)
		{
			$year = 'I';
			break;
		}
		else if ($i == 2)
		{
			$year = "II";
			break;
		}
		else if ($i == 3)
		{
			$year = "III";
			break;
		}
		else if ($i == 4)
		{
			$year = "IV";
			break;
		}
	}
	
}
$section = $dept.$section;
$dept_slot = "select `".$year."` from dept_slots where class = '$section'";
$dept_slot = mysqli_fetch_array(mysqli_query($db,$dept_slot));

$time = "select * from time_table where dept_slots = '$dept_slot[0]'";
$some = mysqli_fetch_array(mysqli_query($db,$time));
$timings = "select start_time,end_time from time_slots";
$timings = mysqli_query($db,$timings);
?>

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
				echo subject_parse($some[$i]);$sub = "select name from subjects where code='$some[$i]'";
				$sub1 = mysqli_fetch_row(mysqli_query($db,$sub));
				echo '</td></tr>';
				$i=$i+1;break;
			}
			else{
				echo '<td>';echo subject_parse($some[$i]);$sub = "select name from subjects where code='$some[$i]'";
				$sub1 = mysqli_fetch_row(mysqli_query($db,$sub));
				echo '</td>';
				$i =$i+1;
			}
		}
		
	}?>
	

</table>