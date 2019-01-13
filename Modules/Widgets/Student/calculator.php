<?php
$percentage=$_GET['percentage'];
$total=$_GET['total'];
$present=$_GET['present'];
if ($percentage>100) { echo "Percentage shouldn't be greater than 100"; } 
else if ($present > $total) { echo "Classes present must be Less than Total Classes"; }
else
{
	if ((($present/$total)*100)== $percentage) { echo "Your attendance is already "; echo $percentage; }
	else
	{
	for($i=1;$i<300;$i++)
	{
		if (((($present+$i)/($total+$i))*100) > $percentage )
		{
			echo "Please attend more ";echo $i;echo " classes";
			break;
		}
	}
	}
}
?>