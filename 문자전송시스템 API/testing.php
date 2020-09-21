<?php

	$connect = mysqli_connect('localhost','sumean','Whoami21?','db') or die("fail");
	
	$query = "select * from sms";

	$result = mysqli_query($connect, $query);
	$n = mysqli_num_rows($result);
	$last = array();
	$last2 = array();

	for($i=0;$i<$n;$i=$i+1){
		$row = mysqli_fetch_row($result);
		$last[$i] = $row[0];
		$last2[$i] = $row[1];
	
		echo $last[$i]."  |  ".$last2[$i]."<br/>";
	}

?>
