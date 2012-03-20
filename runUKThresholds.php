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

//update current_threshold table
/*mysql_query("UPDATE current_thresholds SET value = " . $hr . " WHERE threshold_name = 'heart_rate'");
mysql_query("UPDATE current_thresholds SET value = " . $temp . " WHERE threshold_name = 'temp'");
mysql_query("UPDATE current_thresholds SET value = " . $wbc_high . " WHERE threshold_name = 'wbc_high'");
mysql_query("UPDATE current_thresholds SET value = " . $wbc_low . " WHERE threshold_name = 'wbc_low'");
mysql_query("UPDATE current_thresholds SET value = " . $sys_bp . " WHERE threshold_name = 'sys_bp'");
mysql_query("UPDATE current_thresholds SET value = " . $lactate . " WHERE threshold_name = 'lactate'");
mysql_query("UPDATE current_thresholds SET value = " . $resp . " WHERE threshold_name = 'resp'");
mysql_query("UPDATE current_thresholds SET value = " . $limit . " WHERE threshold_name = 'limit'");
*/
mysql_query("DROP VIEW IF EXISTS temp_UK_2");
mysql_query("DROP VIEW IF EXISTS hr_UK_1");
mysql_query("DROP VIEW IF EXISTS hr_UK_2");
mysql_query("DROP VIEW IF EXISTS hr_UK_3");
mysql_query("DROP VIEW IF EXISTS sbp_UK_1");
mysql_query("DROP VIEW IF EXISTS sbp_UK_2");
mysql_query("DROP VIEW IF EXISTS sbp_UK_3");
mysql_query("DROP VIEW IF EXISTS resp_UK_1");
mysql_query("DROP VIEW IF EXISTS resp_UK_2");
mysql_query("DROP VIEW IF EXISTS resp_UK_3");
mysql_query("DROP VIEW IF EXISTS age_UK_1");
mysql_query("DROP VIEW IF EXISTS age_UK_2");


mysql_query("CREATE VIEW temp_UK_2 AS SELECT DISTINCT id, time, 2 AS score FROM Presby WHERE temp >= 38.5");
mysql_query("CREATE VIEW hr_UK_1 AS SELECT DISTINCT id, time, 1 AS score FROM Presby WHERE (heart_rate >= 101 AND heart_rate <= 110) OR (heart_rate >= 41 AND heart_rate<=50)");
mysql_query("CREATE VIEW hr_UK_2 AS SELECT DISTINCT id, time, 2 AS score FROM Presby WHERE (heart_rate >= 111 AND heart_rate <= 129) OR (heart_rate <= 40 AND heart_rate<>0)");
mysql_query("CREATE VIEW hr_UK_3 AS SELECT DISTINCT id, time, 3 AS score FROM Presby WHERE heart_rate >= 130");
mysql_query("CREATE VIEW sbp_UK_1 AS SELECT DISTINCT id, time, 1 AS score FROM Presby WHERE sys_bp >=81 AND sys_bp <= 100");
mysql_query("CREATE VIEW sbp_UK_2 AS SELECT DISTINCT id, time, 2 AS score FROM Presby WHERE (sys_bp >=71 AND sys_bp <= 80) OR (sys_bp >=200)");
mysql_query("CREATE VIEW sbp_UK_3 AS SELECT DISTINCT id, time, 3 AS score FROM Presby WHERE sys_bp <= 70 AND sys_bp <> 0");
mysql_query("CREATE VIEW resp_UK_1 AS SELECT DISTINCT id, time, 1 AS score FROM Presby WHERE resp_rate >= 15 AND resp_rate <= 20");
mysql_query("CREATE VIEW resp_UK_2 AS SELECT DISTINCT id, time, 2 AS score FROM Presby WHERE (resp_rate >= 21 AND resp_rate <= 29) OR (resp_rate < 9 AND resp_rate <> 0)");
mysql_query("CREATE VIEW resp_UK_3 AS SELECT DISTINCT id, time, 3 AS score FROM Presby WHERE resp_rate >= 30");
mysql_query("CREATE VIEW age_UK_1 AS SELECT DISTINCT id, 1 AS score FROM Patients WHERE age >= 65 AND age <= 74");
mysql_query("CREATE VIEW age_UK_2 AS SELECT DISTINCT id, 2 AS score FROM Patients WHERE age >= 75 AND age <= 84");
mysql_query("CREATE VIEW age_UK_3 AS SELECT DISTINCT id, 3 AS score FROM Patients WHERE age >= 85");

echo "1: Successfully updated";

mysql_close($link);
?>
