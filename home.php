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

//Thresholds from SCC

$tempC = 38.3;
$hr = 90;
$wbc_high = 12;
$wbc_low = 4;
$sys_bp = 90;
$lactate = 2.5;

//create temporary table to store patients that trip temp threshold
mysql_query("CREATE TEMPORARY TABLE IF NOT EXISTS temp (id BIGINT NOT NULL, time TIMESTAMP NOT NULL) ENGINE=MEMORY");
$query = "SELECT DISTINCT id, time FROM Presby WHERE temp > '".$tempC."'";
$patientTemps = mysql_query($query);
while($row = mysql_fetch_array($patientTemps)){
	$patientID = $row['id'];
	$time = $row['time'];
	mysql_query("INSERT INTO temp VALUES ('".$patientID."', '".$time."')");
}

//create temporary table to store patients that trip heart rate threshold
mysql_query("CREATE TEMPORARY TABLE IF NOT EXISTS hr (id BIGINT NOT NULL, time TIMESTAMP NOT NULL) ENGINE=MEMORY");
$query = "SELECT DISTINCT id, time FROM Presby WHERE heart_rate > '".$hr."'";
$patientHR = mysql_query($query);
while($row = mysql_fetch_array($patientHR)){
	$patientID = $row['id'];
	$time = $row['time'];
	mysql_query("INSERT INTO hr VALUES ('".$patientID."', '".$time."')");
}

//create temporary table to store patients that trip wbc threshold
mysql_query("CREATE TEMPORARY TABLE IF NOT EXISTS wbc (id BIGINT NOT NULL, time TIMESTAMP NOT NULL) ENGINE=MEMORY");
$query = "SELECT DISTINCT id, time FROM Presby WHERE wbc > '".$wbc_high."' OR (wbc < '".$wbc_low."' AND wbc <> 0)";
$patientWBC = mysql_query($query);
while($row = mysql_fetch_array($patientWBC)){
	$patientID = $row['id'];
	$time = $row['time'];
	mysql_query("INSERT INTO wbc VALUES ('".$patientID."', '".$time."')");
}

//create temporary table to store patients that trip heart rate threshold
mysql_query("CREATE TEMPORARY TABLE IF NOT EXISTS sbc (id BIGINT NOT NULL, time TIMESTAMP NOT NULL) ENGINE=MEMORY");
$query = "SELECT DISTINCT id, time FROM Presby WHERE sys_bp < '".$sys_bp."' AND sys_bp <> 0";
$patientSBC = mysql_query($query);
while($row = mysql_fetch_array($patientSBC)){
	$patientID = $row['id'];
	$time = $row['time'];
	mysql_query("INSERT INTO sbc VALUES ('".$patientID."', '".$time."')");
}

//create temporary table to store patients that trip lactate threshold
mysql_query("CREATE TEMPORARY TABLE IF NOT EXISTS lactate (id BIGINT NOT NULL, time TIMESTAMP NOT NULL) ENGINE=MEMORY");
$query = "SELECT DISTINCT id, time FROM Presby WHERE lactate > '".$lactate."'";
$patientLactate = mysql_query($query);
while($row = mysql_fetch_array($patientLactate)){
	$patientID = $row['id'];
	$time = $row['time'];
	mysql_query("INSERT INTO lactate VALUES ('".$patientID."', '".$time."')");
}

//create temporary table to store patients and counts of threshold trips
mysql_query("CREATE TEMPORARY TABLE IF NOT EXISTS thresholds (id BIGINT NOT NULL, count INT NOT NULL) ENGINE=MEMORY");
//$query = "SELECT id, COUNT(id) AS count FROM temp t, hr h, wbc w, sbc s, lactate l WHERE id IN (SELECT DISTINCT id FROM t) OR id IN (SELECT DISTINCT id FROM h) OR id IN (SELECT DISTINCT id FROM w) OR id IN (SELECT DISTINCT id FROM s) OR id IN (SELECT DISTINCT id FROM l) GROUP BY id";
//$query = "SELECT id, COUNT(id) AS count FROM temp t WHERE id=t.id GROUP BY id";
//$query = "SELECT id, COUNT(id) FROM (SELECT DISTINCT id FROM temp) t, (SELECT DISTINCT id FROM hr) h, (SELECT DISTINCT id FROM wbc) w, (SELECT DISTINCT id FROM sbc) s, (SELECT DISTINCT id FROM lactate) l GROUP BY id";
$query = "SELECT id, count(id) AS count FROM (SELECT DISTINCT id FROM temp UNION ALL SELECT DISTINCT id FROM hr UNION ALL SELECT DISTINCT id FROM wbc UNION ALL SELECT DISTINCT id FROM sbc UNION ALL SELECT DISTINCT id FROM lactate) t GROUP BY id";
$patientCounts = mysql_query($query);
while($row = mysql_fetch_array($patientCounts)){
	$patientID = $row['id'];
	$count = $row['count'];
	mysql_query("INSERT INTO thresholds VALUES ('".$patientID."', '".$count."')");
}

$limit = 3;
$result = mysql_query("SELECT DISTINCT id FROM thresholds WHERE count >= '".$limit."'");

if (mysql_num_rows($result) == 0) {
	echo "Error: unable to get patient info.";
} else {
	echo "<table>";
	echo "<tr><td><b>Thresholds</b></td></tr>";
	echo "<tr><td>Heart Rate: ".$hr."</td><td>Temp: ".$tempC."</td></tr>";
	echo "<tr><td>WBC High: ".$wbc_high."</td><td>WBC Low: ".$wbc_low."</td></tr>";
	echo "<tr><td>Systolic BP: ".$sys_bp."</td><td>Lactate: ".$lactate."</td></tr>";
	echo "</table><br>";
	echo "Showing patients with ".$limit." or more threshold trips<br>";
	echo "<table>";
	while ($row = mysql_fetch_array($result)){
		echo "<td><td>".$row['id']."</td></tr>";
	}
	echo "</table>";
	
}

mysql_query("DROP TABLE temp");
mysql_query("DROP TABLE hr");
mysql_query("DROP TABLE wbc");
mysql_query("DROP TABLE sbc");
mysql_query("DROP TABLE lactate");
mysql_query("DROP TABLE thresholds");
mysql_close($link);
?>