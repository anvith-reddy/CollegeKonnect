<?php
function login($myusername, $mypassword)
{
	include("includes/config.php");
if ($myusername=='' || $mypassword=='')
		{
			echo '<script language="javascript">';
			echo 'alert("Please enter valid username or password")';
			echo '</script>';
		}
		else
		{
      
			$sql = "SELECT password FROM login WHERE username = '$myusername'";
			$result = mysqli_query($db,$sql);
			$result = mysqli_fetch_array($result);
			$hash = $result[0];
			
			$sql = "SELECT role FROM users WHERE uid = '$myusername'";
			$role = mysqli_query($db,$sql);
			$role = mysqli_fetch_array($role);
			$role = $role[0];
			
			if(password_verify($mypassword, $hash))
			{ 	
				if ($role == '1')
				{
					$_SESSION['login_user'] = $myusername;
					header("location: Modules/Dashboard/Student/Student.php");
				}
				else if ($role == '2')
				{
					$_SESSION['login_user'] = $myusername;
					header("location: Modules/Dashboard/Faculty/Faculty.php");
				}
				else if ($role == '3')
				{
					$_SESSION['login_user'] = $myusername;
					header("location: Modules/Dashboard/Admin/Admin.php");
				}
				else if ($role == '')
				{
					echo '<script language="javascript">';
					echo 'alert("Error Code:(001) Please contact administrator")';
					echo '</script>';
				}
			}
			else 
				{
					echo '<script language="javascript">';
					echo 'alert("Username or password wrong")';
					echo '</script>';
				}
		}
	}
	function forum_categories()
	{	
	include("config.php");
		$sql = "select DISTINCT category from forum_q";
		$answer = mysqli_query($db,$sql);
		return $answer;
	}
	function forum_data()
	{
		include("config.php");
		$sql="select * from forum_q";
		$answer = mysqli_query($db,$sql);
		return $answer;
	}
	function get_mail($mail, $user)
	{
		include("config.php");
		echo getcwd();
		$sql="select * from mail where id = '$mail' and receiver='$user'";
		$result = mysqli_query($db,$sql);
		return $result;
	}
	
	function live_session($user)
	{
		include("config.php");
		if (strlen($user) == 8)
		{
			$batch = substr($user,1,2);
			$lateral = 0;
		}
		else if (strlen($user) == 9)
		{
			$batch = substr($user,1,2) - 1;
			$lateral = 1;
			echo $batch;
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
		$anoth = "select `".$year."` from dept_slots where class = '$section'";
		$reee = mysqli_fetch_array(mysqli_query($db,$anoth));

		date_default_timezone_set("Asia/kolkata");
		$temp = date("h:i:sa");
		$tem =  substr($temp,0,8);
		$tiim = strtotime($tem);
		$day = substr(date("l"),0,3);
		$clg_start = "09:40:00am";
		$clg_end = "04:30:00pm";
		if ($day == "Sun")
		{
			return "It's Sunday.Get something to work..";
		}
		else if ($temp > strtotime($clg_end) || $temp < strtotime($clg_start))
		{
			return "No ClassWork";
		}
		else
		{
			$test1 = "select id,start_time,end_time from time_slots";
			$answer3 = mysqli_query($db,$test1);
			foreach($answer3 as $row1) 
			{
				$start = strtotime($row1["start_time"]);
				$end = strtotime($row1["end_time"]);
				if ($tiim >= $start)
				{
					if ($tiim <= $end)
					{
						$slot_id = $row1["id"];
						$que = "select `".$day."` from time_slots where id = '$slot_id'";
						$result1 = mysqli_fetch_array(mysqli_query($db,$que));
						$slot1 = $result1[0];
						$slot2 = $result1[0] + 6;
						$anoth1 = "select `".$slot1."` from time_table where dept_slots='$reee[0]'";
						$next9 = mysqli_fetch_array(mysqli_query($db,$anoth1));
						$live_session = $next9[0];			
						$anoth3 = "select `".$slot2."` from time_table where dept_slots='$reee[0]'";
						$next8 = mysqli_fetch_array(mysqli_query($db,$anoth3));
						$next_session = $next8[0];
						break;
					}
				}
			}
		}
		$pos = strpos($live_session,",");
		$len = strlen($live_session);
		if($len == 1)
		{
			if ($live_session == 0)
			{
				return "NULL";
			}
			else if ($live_session == 1)
			{
				return "assosciation";
			}
			else if ($live_session == 2)
			{
				return "Lunch";
			}	
			else if ($live_session == 3)
			{	
				return "remedial";
			}
			else 
			{
				return "undefined";
			}
		}
		else if ($len == 8)
		{
			$prsub="select name from subjects where code='$live_session'";
			$prsub = mysqli_fetch_array(mysqli_query($db,$prsub));
			return $prsub[0];
		}
		else if($len == 17)
		{
			$b1 = substr($live_session,0,8);
			$b2 = substr($live_session,9,8);
			$lab1 = "select name from subjects where code='$b1'";
			$lab1 = mysqli_fetch_array(mysqli_query($db,$lab1));
			$lab1res = $lab1[0];
			$lab2 = "select name from subjects where code='$b2'";
			$lab2 = mysqli_fetch_array(mysqli_query($db,$lab2));
			$lab2res = $lab2[0];
			$labs = "B1-{$lab1res}<br>B2-{$lab2res}";
			return $labs;
		}
		else if($len == 5)
		{
			$elec = substr($live_session,0,2);
			if ($elec == "pe")
			{
				return "Professional elective";
			}
			else if ($elec == "oe")
			{
				return "Optional Elective";
			}
		}
	}
	function next_session($user)
	{
		include("config.php");
		if (strlen($user) == 8)
		{
			$batch = substr($user,1,2);
			$lateral = 0;
		}
		else if (strlen($user) == 9)
		{
			$batch = substr($user,1,2) - 1;
			$lateral = 1;
			echo $batch;
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
		$anoth = "select `".$year."` from dept_slots where class = '$section'";
		$reee = mysqli_fetch_array(mysqli_query($db,$anoth));

		date_default_timezone_set("Asia/kolkata");
		$temp = date("h:i:sa");
		$tem =  substr($temp,0,8);
		$clg_start = "09:40:00am";
		$clg_end = "04:30:00pm";
		$tiim = strtotime($tem);
		$day = substr(date("l"),0,3);
		if ($day == "Sun")
		{
			return "It's Sunday.Get something to work..";
		}
		else if ($temp > strtotime($clg_end) || $temp < strtotime($clg_start))
		{
			return "No ClassWork";
		}
		else
		{
			$test1 = "select id,start_time,end_time from time_slots";
			$answer3 = mysqli_query($db,$test1);
			foreach($answer3 as $row1) 
			{
				$start = strtotime($row1["start_time"]);
				$end = strtotime($row1["end_time"]);
				if ($tiim >= $start)
				{
					if ($tiim <= $end)
					{
						$slot_id = $row1["id"];
						$que = "select `".$day."` from time_slots where id = '$slot_id'";
						$result1 = mysqli_fetch_array(mysqli_query($db,$que));
						$slot2 = $result1[0] + 6;
						$anoth3 = "select `".$slot2."` from time_table where dept_slots='$reee[0]'";
						$next8 = mysqli_fetch_array(mysqli_query($db,$anoth3));
						$next_session = $next8[0];
						break;
					}
				}
			}
		}
		$pos = strpos($next_session,",");
		$len = strlen($next_session);
		if($len == 1)
		{
			if ($next_session == 0)
			{
				return "NULL";
			}
			else if ($next_session == 1)
			{
				return "assosciation";
			}
			else if ($next_session == 2)
			{
				return "Lunch";
			}	
			else if ($next_session == 3)
			{	
				return "remedial";
			}
			else 
			{
				return "undefined";
			}
		}
		else if ($len == 8)
		{
			$prsub="select name from subjects where code='$next_session'";
			$prsub = mysqli_fetch_array(mysqli_query($db,$prsub));
			return $prsub[0];
		}
		else if($len == 17)
		{
			$b1 = substr($next_session,0,8);
			$b2 = substr($next_session,9,8);
			$lab1 = "select name from subjects where code='$b1'";
			$lab1 = mysqli_fetch_array(mysqli_query($db,$lab1));
			$lab1res = $lab1[0];
			$lab2 = "select name from subjects where code='$b2'";
			$lab2 = mysqli_fetch_array(mysqli_query($db,$lab2));
			$lab2res = $lab2[0];
			$labs = "B1-{$lab1res}<br>B2-{$lab2res}";
			return $labs;
		}
		else if($len == 5)
		{
			$elec = substr($next_session,0,2);
			if ($elec == "pe")
			{
				return "Professional elective";
			}
			else if ($elec == "oe")
			{
				return "Optional Elective";
			}
		}
	}
	function subject_parse($next_session)
	{
		include("config.php");
		$pos = strpos($next_session,",");
		$len = strlen($next_session);
		if($len == 1)
		{
			if ($next_session == 0)
			{
				return "NULL";
			}
			else if ($next_session == 1)
			{
				return "assosciation";
			}
			else if ($next_session == 2)
			{
				return "Lunch";
			}	
			else if ($next_session == 3)
			{	
				return "remedial";
			}
			else 
			{
				return "undefined";
			}
		}
		else if ($len == 8)
		{
			$prsub="select name from subjects where code='$next_session'";
			$prsub = mysqli_fetch_array(mysqli_query($db,$prsub));
			return $prsub[0];
		}
		else if($len == 17)
		{
			$b1 = substr($next_session,0,8);
			$b2 = substr($next_session,9,8);
			$lab1 = "select name from subjects where code='$b1'";
			$lab1 = mysqli_fetch_array(mysqli_query($db,$lab1));
			$lab1res = $lab1[0];
			$lab2 = "select name from subjects where code='$b2'";
			$lab2 = mysqli_fetch_array(mysqli_query($db,$lab2));
			$lab2res = $lab2[0];
			$labs = "B1-{$lab1res}<br>B2-{$lab2res}";
			return $labs;
		}
		else if($len == 5)
		{
			$elec = substr($next_session,0,2);
			if ($elec == "pe")
			{
				return "Professional elective";
			}
			else if ($elec == "oe")
			{
				return "Optional Elective";
			}
		}
	}
	function mailer($id)
	{
		include("config.php");
		$user = $_SESSION['login_user'];
		$query="select sender,receiver from mail where id = '$id'";
		$result = mysqli_fetch_array(mysqli_query($db,$query));
		if ($result[0]==$user)
		{
			return  'sender';
		}
		else if ($result[1]==$user)
		{
			return 'receiver';
		}
		else return 'error';
	}
?>