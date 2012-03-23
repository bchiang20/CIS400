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
$hr = $_GET["hr"];
$temp = $_GET["temp"];
$wbc_high = $_GET["wbc_high"];
$wbc_low = $_GET["wbc_low"];
$sys_bp = $_GET["sys_bp"];
$lactate = $_GET["lactate"];
$resp = $_GET["resp"];
$limit = $_GET["limit"];
$date = $_GET["date"];
//echo $date;

//update current_threshold table
mysql_query("UPDATE current_thresholds SET value = " . $hr . " WHERE threshold_name = 'heart_rate'");
mysql_query("UPDATE current_thresholds SET value = " . $temp . " WHERE threshold_name = 'temp'");
mysql_query("UPDATE current_thresholds SET value = " . $wbc_high . " WHERE threshold_name = 'wbc_high'");
mysql_query("UPDATE current_thresholds SET value = " . $wbc_low . " WHERE threshold_name = 'wbc_low'");
mysql_query("UPDATE current_thresholds SET value = " . $sys_bp . " WHERE threshold_name = 'sys_bp'");
mysql_query("UPDATE current_thresholds SET value = " . $lactate . " WHERE threshold_name = 'lactate'");
mysql_query("UPDATE current_thresholds SET value = " . $resp . " WHERE threshold_name = 'resp'");
mysql_query("UPDATE current_thresholds SET value = " . $limit . " WHERE threshold_name = 'limit'");
mysql_query("UPDATE date SET curr_date = '" . $date . "' WHERE id = 1");

//drop current tables
/*mysql_query("DROP TABLE temp");
mysql_query("DROP TABLE hr");
mysql_query("DROP TABLE wbc");
mysql_query("DROP TABLE sbc");
mysql_query("DROP TABLE resp");
mysql_query("DROP TABLE lactate");*/

//update tables based on new thresholds
//create table to store patients that trip temp threshold
/*mysql_query("CREATE TABLE IF NOT EXISTS temp (id BIGINT NOT NULL, time TIMESTAMP NOT NULL, CONSTRAINT pk PRIMARY KEY(id,time)) ENGINE=MEMORY");
$query = "SELECT DISTINCT id, time FROM Presby WHERE temp > '".$temp."'";
$patientTemps = mysql_query($query);
while($row = mysql_fetch_array($patientTemps)){
	$patientID = $row['id'];
	$time = $row['time'];
	mysql_query("INSERT IGNORE INTO temp VALUES ('".$patientID."', '".$time."')");
}

//create table to store patients that trip heart rate threshold
mysql_query("CREATE TABLE IF NOT EXISTS hr (id BIGINT NOT NULL, time TIMESTAMP NOT NULL, CONSTRAINT pk PRIMARY KEY(id,time)) ENGINE=MEMORY");
$query = "SELECT DISTINCT id, time FROM Presby WHERE heart_rate > '".$hr."'";
$patientHR = mysql_query($query);
while($row = mysql_fetch_array($patientHR)){
	$patientID = $row['id'];
	$time = $row['time'];
	mysql_query("INSERT IGNORE INTO hr VALUES ('".$patientID."', '".$time."')");
}

//create table to store patients that trip wbc threshold
mysql_query("CREATE TABLE IF NOT EXISTS wbc (id BIGINT NOT NULL, time TIMESTAMP NOT NULL, CONSTRAINT pk PRIMARY KEY(id,time)) ENGINE=MEMORY");
$query = "SELECT DISTINCT id, time FROM Presby WHERE wbc > '".$wbc_high."' OR (wbc < '".$wbc_low."' AND wbc <> 0)";
$patientWBC = mysql_query($query);
while($row = mysql_fetch_array($patientWBC)){
	$patientID = $row['id'];
	$time = $row['time'];
	mysql_query("INSERT IGNORE INTO wbc VALUES ('".$patientID."', '".$time."')");
}

//create table to store patients that trip heart rate threshold
mysql_query("CREATE TABLE IF NOT EXISTS sbc (id BIGINT NOT NULL, time TIMESTAMP NOT NULL, CONSTRAINT pk PRIMARY KEY(id,time)) ENGINE=MEMORY");
$query = "SELECT DISTINCT id, time FROM Presby WHERE sys_bp < '".$sys_bp."' AND sys_bp <> 0";
$patientSBC = mysql_query($query);
while($row = mysql_fetch_array($patientSBC)){
	$patientID = $row['id'];
	$time = $row['time'];
	mysql_query("INSERT IGNORE INTO sbc VALUES ('".$patientID."', '".$time."')");
}

//create table to store patients that trip lactate threshold
mysql_query("CREATE TABLE IF NOT EXISTS lactate (id BIGINT NOT NULL, time TIMESTAMP NOT NULL, CONSTRAINT pk PRIMARY KEY(id,time)) ENGINE=MEMORY");
$query = "SELECT DISTINCT id, time FROM Presby WHERE lactate > '".$lactate."'";
$patientLactate = mysql_query($query);
while($row = mysql_fetch_array($patientLactate)){
	$patientID = $row['id'];
	$time = $row['time'];
	mysql_query("INSERT IGNORE INTO lactate VALUES ('".$patientID."', '".$time."')");
}

//create table to store patients that trip lactate threshold
mysql_query("CREATE TABLE IF NOT EXISTS resp (id BIGINT NOT NULL, time TIMESTAMP NOT NULL, CONSTRAINT pk PRIMARY KEY(id,time)) ENGINE=MEMORY");
$query = "SELECT DISTINCT id, time FROM Presby WHERE resp_rate > '".$resp."'";
$patientResp = mysql_query($query);
while($row = mysql_fetch_array($patientResp)){
	$patientID = $row['id'];
	$time = $row['time'];
	mysql_query("INSERT IGNORE INTO resp VALUES ('".$patientID."', '".$time."')");
}*/

mysql_query("DROP VIEW temp");
mysql_query("DROP VIEW hr");
mysql_query("DROP VIEW wbc");
mysql_query("DROP VIEW sbc");
mysql_query("DROP VIEW resp");
mysql_query("DROP VIEW lactate");

mysql_query("CREATE VIEW temp AS SELECT DISTINCT id, time FROM Presby WHERE temp > ".$temp."");
mysql_query("CREATE VIEW hr AS SELECT DISTINCT id, time FROM Presby WHERE heart_rate > '".$hr."'");
mysql_query("CREATE VIEW wbc AS SELECT DISTINCT id, time FROM Presby WHERE wbc > '".$wbc_high."' OR (wbc < '".$wbc_low."' AND wbc <> 0)");
mysql_query("CREATE VIEW sbc AS SELECT DISTINCT id, time FROM Presby WHERE sys_bp < '".$sys_bp."' AND sys_bp <> 0");
mysql_query("CREATE VIEW lactate AS SELECT DISTINCT id, time FROM Presby WHERE lactate > '".$lactate."'");
mysql_query("CREATE VIEW resp AS SELECT DISTINCT id, time FROM Presby WHERE resp_rate > '".$resp."'");

echo "1: Successfully updated";

mysql_close($link);
?>
