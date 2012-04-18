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

mysql_query("DROP VIEW IF EXISTS temp_MH_1");
mysql_query("DROP VIEW IF EXISTS temp_MH_2");
mysql_query("DROP VIEW IF EXISTS temp_MH_3");
mysql_query("DROP VIEW IF EXISTS temp_MH_4");
mysql_query("DROP VIEW IF EXISTS hr_MH_2");
mysql_query("DROP VIEW IF EXISTS hr_MH_3");
mysql_query("DROP VIEW IF EXISTS hr_MH_4");
mysql_query("DROP VIEW IF EXISTS resp_MH_1");
mysql_query("DROP VIEW IF EXISTS resp_MH_2");
mysql_query("DROP VIEW IF EXISTS resp_MH_3");
mysql_query("DROP VIEW IF EXISTS resp_MH_4");
mysql_query("DROP VIEW IF EXISTS wbc_MH_1");
mysql_query("DROP VIEW IF EXISTS wbc_MH_2");
mysql_query("DROP VIEW IF EXISTS wbc_MH_4");


mysql_query("CREATE VIEW temp_MH_1 AS SELECT DISTINCT id, time, 1 AS score FROM Presby WHERE (temp >= 34 AND temp <=35.9) OR (temp >= 38.5 AND temp <= 38.9)");
mysql_query("CREATE VIEW temp_MH_2 AS SELECT DISTINCT id, time, 2 AS score FROM Presby WHERE (temp >= 32 AND temp <=33.9)");
mysql_query("CREATE VIEW temp_MH_3 AS SELECT DISTINCT id, time, 3 AS score FROM Presby WHERE (temp >= 30 AND temp <=31.9) OR (temp >= 39 AND temp <= 40.9)");
mysql_query("CREATE VIEW temp_MH_4 AS SELECT DISTINCT id, time, 4 AS score FROM Presby WHERE (temp <= 29.9 AND temp<>0) OR temp >= 41");
mysql_query("CREATE VIEW hr_MH_2 AS SELECT DISTINCT id, time, 2 AS score FROM Presby WHERE (heart_rate >= 55 AND heart_rate <= 69) OR (heart_rate >= 110 AND heart_rate <= 139)");
mysql_query("CREATE VIEW hr_MH_3 AS SELECT DISTINCT id, time, 3 AS score FROM Presby WHERE (heart_rate >= 40 AND heart_rate <= 54) OR (heart_rate >= 140 AND heart_rate <= 179)");
mysql_query("CREATE VIEW hr_MH_4 AS SELECT DISTINCT id, time, 4 AS score FROM Presby WHERE (heart_rate <= 39 AND heart_rate<>0) OR heart_rate >= 180");
mysql_query("CREATE VIEW resp_MH_1 AS SELECT DISTINCT id, time, 1 AS score FROM Presby WHERE (resp_rate >= 10 AND resp_rate <= 11) OR (resp_rate >= 25 AND heart_rate <= 34)");
mysql_query("CREATE VIEW resp_MH_2 AS SELECT DISTINCT id, time, 2 AS score FROM Presby WHERE resp_rate >= 6 AND resp_rate <= 9");
mysql_query("CREATE VIEW resp_MH_3 AS SELECT DISTINCT id, time, 3 AS score FROM Presby WHERE resp_rate >= 35 AND resp_rate <= 49");
mysql_query("CREATE VIEW resp_MH_4 AS SELECT DISTINCT id, time, 4 AS score FROM Presby WHERE resp_rate >= 50 OR (resp_rate <= 5 AND resp_rate<>0)");
mysql_query("CREATE VIEW wbc_MH_1 AS SELECT DISTINCT id, time, 1 AS score FROM Presby WHERE wbc >= 15 AND wbc <= 19.9");
mysql_query("CREATE VIEW wbc_MH_2 AS SELECT DISTINCT id, time, 2 AS score FROM Presby WHERE (wbc >= 1 AND wbc <= 2.9) OR (wbc >= 20 AND wbc <= 39.9)");
mysql_query("CREATE VIEW wbc_MH_4 AS SELECT DISTINCT id, time, 4 AS score FROM Presby WHERE wbc >= 40 OR (wbc < 1 AND wbc<>0)");

echo "1: Successfully updated";

mysql_close($link);
?>
