<?php
$db_username = "brchiang";
$db_password = "sepsis";
$db_host = "fling.seas.upenn.edu";
$db_name = "brchiang";

//OPEN CONNETION
$link = mysql_connect($db_host, $db_username, $db_password);
if (!$link) {
	die('Could not connect: ' . mysql_error());
}

mysql_select_db($db_name, $link);

$unix_time = 1320037200;
$current_time = new DateTime();
$current_time->setTimestamp($unix_time);

mysql_query("DROP TABLE thresholds");
mysql_query("CREATE TABLE IF NOT EXISTS thresholds (id BIGINT NOT NULL, count INT NOT NULL, trig VARCHAR(50) NOT NULL, CONSTRAINT pk PRIMARY KEY(id,count)) ENGINE=MEMORY");

$mysqldate = date('Y-m-d H:i:s',$unix_time);

$day_length = 240000;
$num_days = 5;
$time_diff = $day_length * $num_days;

$query = "SELECT id, COUNT(id) AS count, GROUP_CONCAT(flag ORDER BY flag ASC SEPARATOR ' ') AS trig FROM (SELECT DISTINCT id, 'temp' AS flag FROM temp WHERE TIMEDIFF('".$mysqldate."',time) < ".$time_diff." UNION ALL SELECT DISTINCT id, 'hr' AS flag FROM hr WHERE TIMEDIFF('".$mysqldate."',time) < ".$time_diff." UNION ALL SELECT DISTINCT id, 'wbc' AS flag FROM wbc WHERE TIMEDIFF('".$mysqldate."',time) < ".$time_diff." UNION ALL SELECT DISTINCT id, 'sbc' AS flag FROM sbc WHERE TIMEDIFF('".$mysqldate."',time) < ".$time_diff." UNION ALL SELECT DISTINCT id, 'lac' AS flag FROM lactate WHERE TIMEDIFF('".$mysqldate."',time) < ".$time_diff." UNION ALL SELECT DISTINCT id, 'resp' AS flag FROM resp WHERE TIMEDIFF('".$mysqldate."',time) < ".$time_diff.") t GROUP BY id";
$patientCounts = mysql_query($query);
while($row = mysql_fetch_array($patientCounts)){
	$patientID = $row['id'];
	$count = $row['count'];
	$trig = $row['trig'];
	mysql_query("INSERT IGNORE INTO thresholds VALUES ('".$patientID."', '".$count."', '".$trig."')");
}

//Grab the search values
$limit = 3;
$pid = '9000862378300270'; //grab value from the search box
$result = mysql_query("SELECT DISTINCT id, trig FROM thresholds WHERE id = '".$pid."'");

if (mysql_num_rows($result) == 0) {
	echo "Error: unable to get patient info.";
} else {
	echo "<table>";
	$count = 0;
	while ($row = mysql_fetch_array($result)){
		echo "<tr><td>".$row['id']."</td><td>".$row['trig']."</td></tr>";
		$count = $count + 1;
	}
	echo "<tr><td>Total Results: ".$count."</td></tr>";
	echo "</table>";
	
}

//CLOSE CONNECTION
mysql_close($link);
?>