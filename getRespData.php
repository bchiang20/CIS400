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
$result = mysql_query("SELECT time, resp_rate FROM Presby WHERE id = '".$pid."'") or die(mysql_error());
				
	if (mysql_num_rows($result) == 0) {
		echo "Error: unable to get patient " + $pid + "'s heart rate info.";
	} 
	else {

	}
mysql_close($link); 
?>