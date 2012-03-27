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
$pid = '9000838533500270'; //TO DO: Grab VALUE FROM SEARCH BOX

$rows_json = mysql_query("SELECT time, heart_rate FROM Presby WHERE id = '".$pid."'");

if (mysql_num_rows($rows_json) == 0) {
	echo "Error: unable to get patient " + $pid + "'s heart rate info.";
} 
else {
	while($row = mysql_fetch_array($rows_json)) 
	{
		echo $row['time'] . "\t" . $row['heart_rate']. "\n"; 
	} 
}
mysql_close($link);
?>
