<?php

$connect = mysqli_connect('localhost','sumean','Whoami21?','db') or die("fai23");

$pn=$_GET[pn];


$query = "insert into sms(pn) values('$pn')";

$result = $connect->query($query);

if($result) {
	include '/var/www/html/succ.html';	
}
else{
    echo("승인실패");
}

mysqli_close($connect);

?>
