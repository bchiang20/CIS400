<?php
$db_username = "brchiang";
$db_password = "sepsis";
$db_host = "fling.seas.upenn.edu";
$db_name = "brchiang";
				
$link = mysql_connect($db_host, $db_username, $db_password);
if (!$link) {
	die('Could not connect: ' . mysql_error());
}

mysql_select_db($db_name, $link);
//$pid = '9000838533500270'; //TO DO: Grab VALUE FROM SEARCH BOX
$pid = $_GET["id"];

$thresholds = mysql_query("SELECT curr_date FROM date WHERE id = 1");
$row = mysql_fetch_array($thresholds);
$date = $row['curr_date'];

$unix_time = strtotime($date);
$mysqldate = date('Y-m-d H:i:s',$unix_time);

$rows_json = mysql_query("SELECT time, wbc FROM Presby WHERE id = '".$pid."' AND wbc > 0 AND TIME_TO_SEC(timediff(time, '".$mysqldate."'))/(3600*24) > -5 AND TIME_TO_SEC(timediff(time, '".$mysqldate."'))/(3600*24) <= 0");

if (mysql_num_rows($rows_json) == 0) {
	echo "Error: unable to get patient " + $pid + "'s white blood count info.";
} 
else {
	while($row = mysql_fetch_array($rows_json)) 
	{
		echo $row['time'] . "\t" . $row['wbc']. "\n"; 
	} 
}
mysql_close($link);
?>
