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

mysql_query("DROP VIEW IF EXISTS sbp_RWJ");
mysql_query("DROP VIEW IF EXISTS hr_RWJ");
mysql_query("DROP VIEW IF EXISTS temp_RWJ");
mysql_query("DROP VIEW IF EXISTS resp_RWJ");
mysql_query("DROP VIEW IF EXISTS wbc_RWJ");
mysql_query("DROP VIEW IF EXISTS lactate_RWJ");
mysql_query("DROP VIEW IF EXISTS bands_RWJ");

mysql_query("CREATE VIEW sbp_RWJ AS SELECT DISTINCT id, time FROM Presby WHERE sys_bp <= 90 AND sys_bp <> 0");
mysql_query("CREATE VIEW hr_RWJ AS SELECT DISTINCT id, time FROM Presby WHERE heart_rate >= 100");
mysql_query("CREATE VIEW temp_RWJ AS SELECT DISTINCT id, time FROM Presby WHERE (temp > 37.8) OR (temp < 36 AND temp<>0)");
mysql_query("CREATE VIEW resp_RWJ AS SELECT DISTINCT id, time FROM Presby WHERE resp_rate > 24");
mysql_query("CREATE VIEW wbc_RWJ AS SELECT DISTINCT id, time FROM Presby WHERE wbc > 12 OR (wbc < 4 AND wbc<>0)");
mysql_query("CREATE VIEW lactate_RWJ AS SELECT DISTINCT id, time FROM Presby WHERE lactate > 2");
mysql_query("CREATE VIEW bands_RWJ AS SELECT DISTINCT id, time FROM Presby WHERE bands > 10");

echo "1: Successfully updated";

mysql_close($link);
?>
