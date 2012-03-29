<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Senior Design - Search</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="./bootstrap/css/bootstrap.css" rel="stylesheet">
    <style>
      body {
        padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
      }
    </style>
    <link href="../bootstrap/css/bootstrap-responsive.css" rel="stylesheet">

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="../assets/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="../assets/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="../assets/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="../assets/ico/apple-touch-icon-57-precomposed.png">
   </head>
	<body>
		<div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container-fluid">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="#">Senior Design</a>
          <div class="nav-collapse">
            <ul class="nav">
              <li class="active"><a href="home.php">Home</a></li>
              <li><a href="search.php">Search</a></li>
              <li><a href="editThresholds.php">Edit Thresholds</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>
    <div class="hero-unit">
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
	
	//Pull thresholds from table
	$thresholds = mysql_query("SELECT value FROM current_thresholds WHERE threshold_name = 'heart_rate'");
	$row = mysql_fetch_array($thresholds);
	$hr = $row['value'];
	
	$thresholds = mysql_query("SELECT value FROM current_thresholds WHERE threshold_name = 'temp'");
	$row = mysql_fetch_array($thresholds);
	$tempC = $row['value'];
	
	$thresholds = mysql_query("SELECT value FROM current_thresholds WHERE threshold_name = 'wbc_high'");
	$row = mysql_fetch_array($thresholds);
	$wbc_high = $row['value'];
	
	$thresholds = mysql_query("SELECT value FROM current_thresholds WHERE threshold_name = 'wbc_low'");
	$row = mysql_fetch_array($thresholds);
	$wbc_low = $row['value'];
	
	$thresholds = mysql_query("SELECT value FROM current_thresholds WHERE threshold_name = 'sys_bp'");
	$row = mysql_fetch_array($thresholds);
	$sys_bp = $row['value'];
	
	$thresholds = mysql_query("SELECT value FROM current_thresholds WHERE threshold_name = 'lactate'");
	$row = mysql_fetch_array($thresholds);
	$lactate = $row['value'];
	
	$thresholds = mysql_query("SELECT value FROM current_thresholds WHERE threshold_name = 'resp'");
	$row = mysql_fetch_array($thresholds);
	$resp = $row['value'];
	
	//Thresholds from SCC
	
	/*$tempC = 38.3;
	$hr = 90;
	$wbc_high = 12;
	$wbc_low = 4;
	$sys_bp = 90;
	$lactate = 2.5;
	$resp = 20;*/
	
	$thresholds = mysql_query("SELECT curr_date FROM date WHERE id = 1");
	$row = mysql_fetch_array($thresholds);
	$date = $row['curr_date'];
	
	//$unix_time = 1319518800;
	$unix_time = strtotime($date);
	$current_time = new DateTime();
	$current_time->setTimestamp($unix_time);
	//echo $current_time->format('Y-m-d H:i:s') . "\n";
	/*
	//create temporary table to store patients that trip temp threshold
	mysql_query("CREATE TABLE IF NOT EXISTS temp (id BIGINT NOT NULL, time TIMESTAMP NOT NULL, CONSTRAINT pk PRIMARY KEY(id,time)) ENGINE=MEMORY");
	$query = "SELECT DISTINCT id, time FROM Presby WHERE temp > '".$tempC."'";
	$patientTemps = mysql_query($query);
	while($row = mysql_fetch_array($patientTemps)){
		$patientID = $row['id'];
		$time = $row['time'];
		//mysql_query("INSERT IGNORE INTO temp VALUES ('".$patientID."', '".$time."')");
	}
	
	//create temporary table to store patients that trip heart rate threshold
	mysql_query("CREATE TABLE IF NOT EXISTS hr (id BIGINT NOT NULL, time TIMESTAMP NOT NULL, CONSTRAINT pk PRIMARY KEY(id,time)) ENGINE=MEMORY");
	$query = "SELECT DISTINCT id, time FROM Presby WHERE heart_rate > '".$hr."'";
	$patientHR = mysql_query($query);
	while($row = mysql_fetch_array($patientHR)){
		$patientID = $row['id'];
		$time = $row['time'];
		//mysql_query("INSERT IGNORE INTO hr VALUES ('".$patientID."', '".$time."')");
	}
	
	//create temporary table to store patients that trip wbc threshold
	mysql_query("CREATE TABLE IF NOT EXISTS wbc (id BIGINT NOT NULL, time TIMESTAMP NOT NULL, CONSTRAINT pk PRIMARY KEY(id,time)) ENGINE=MEMORY");
	$query = "SELECT DISTINCT id, time FROM Presby WHERE wbc > '".$wbc_high."' OR (wbc < '".$wbc_low."' AND wbc <> 0)";
	$patientWBC = mysql_query($query);
	while($row = mysql_fetch_array($patientWBC)){
		$patientID = $row['id'];
		$time = $row['time'];
		//mysql_query("INSERT IGNORE INTO wbc VALUES ('".$patientID."', '".$time."')");
	}
	
	//create temporary table to store patients that trip heart rate threshold
	mysql_query("CREATE TABLE IF NOT EXISTS sbc (id BIGINT NOT NULL, time TIMESTAMP NOT NULL, CONSTRAINT pk PRIMARY KEY(id,time)) ENGINE=MEMORY");
	$query = "SELECT DISTINCT id, time FROM Presby WHERE sys_bp < '".$sys_bp."' AND sys_bp <> 0";
	$patientSBC = mysql_query($query);
	while($row = mysql_fetch_array($patientSBC)){
		$patientID = $row['id'];
		$time = $row['time'];
		//mysql_query("INSERT IGNORE INTO sbc VALUES ('".$patientID."', '".$time."')");
	}
	
	//create temporary table to store patients that trip lactate threshold
	mysql_query("CREATE TABLE IF NOT EXISTS lactate (id BIGINT NOT NULL, time TIMESTAMP NOT NULL, CONSTRAINT pk PRIMARY KEY(id,time)) ENGINE=MEMORY");
	$query = "SELECT DISTINCT id, time FROM Presby WHERE lactate > '".$lactate."'";
	$patientLactate = mysql_query($query);
	while($row = mysql_fetch_array($patientLactate)){
		$patientID = $row['id'];
		$time = $row['time'];
		//mysql_query("INSERT IGNORE INTO lactate VALUES ('".$patientID."', '".$time."')");
	}
	
	//create temporary table to store patients that trip lactate threshold
	mysql_query("CREATE TABLE IF NOT EXISTS resp (id BIGINT NOT NULL, time TIMESTAMP NOT NULL, CONSTRAINT pk PRIMARY KEY(id,time)) ENGINE=MEMORY");
	$query = "SELECT DISTINCT id, time FROM Presby WHERE resp_rate > '".$resp."'";
	$patientResp = mysql_query($query);
	while($row = mysql_fetch_array($patientResp)){
		$patientID = $row['id'];
		$time = $row['time'];
		//mysql_query("INSERT IGNORE INTO resp VALUES ('".$patientID."', '".$time."')");
	}
	
	//create temporary table to store patients and counts of threshold trips
	*/
	//mysql_query("DROP TABLE thresholds");
	//mysql_query("CREATE TABLE IF NOT EXISTS thresholds (id BIGINT NOT NULL, count INT NOT NULL, trig VARCHAR(50) NOT NULL, CONSTRAINT pk PRIMARY KEY(id,count)) ENGINE=MEMORY");
	//$query = "SELECT id, COUNT(id) AS count FROM temp t, hr h, wbc w, sbc s, lactate l WHERE id IN (SELECT DISTINCT id FROM t) OR id IN (SELECT DISTINCT id FROM h) OR id IN (SELECT DISTINCT id FROM w) OR id IN (SELECT DISTINCT id FROM s) OR id IN (SELECT DISTINCT id FROM l) GROUP BY id";
	//$query = "SELECT id, COUNT(id) AS count FROM temp t WHERE id=t.id GROUP BY id";
	//$query = "SELECT id, COUNT(id) FROM (SELECT DISTINCT id FROM temp) t, (SELECT DISTINCT id FROM hr) h, (SELECT DISTINCT id FROM wbc) w, (SELECT DISTINCT id FROM sbc) s, (SELECT DISTINCT id FROM lactate) l GROUP BY id";
	$mysqldate = date('Y-m-d H:i:s',$unix_time);
	
	$day_length = 240000;
	$num_days = 1;
	$time_diff = $day_length * $num_days;
	$pastdate = date('Y-m-d H:i:s',$unix_time - ($num_days*86400));
	//echo $mysqldate.", ".$time_diff;
	//$query = "SELECT id, COUNT(id) AS count, GROUP_CONCAT(flag ORDER BY flag ASC SEPARATOR ' ') AS trig FROM (SELECT DISTINCT id, 'temp' AS flag FROM temp WHERE TIMEDIFF('".$mysqldate."',time) < ".$time_diff." UNION ALL SELECT DISTINCT id, 'hr' AS flag FROM hr WHERE TIMEDIFF('".$mysqldate."',time) < ".$time_diff." UNION ALL SELECT DISTINCT id, 'wbc' AS flag FROM wbc WHERE TIMEDIFF('".$mysqldate."',time) < ".$time_diff." UNION ALL SELECT DISTINCT id, 'sbc' AS flag FROM sbc WHERE TIMEDIFF('".$mysqldate."',time) < ".$time_diff." UNION ALL SELECT DISTINCT id, 'lac' AS flag FROM lactate WHERE TIMEDIFF('".$mysqldate."',time) < ".$time_diff." UNION ALL SELECT DISTINCT id, 'resp' AS flag FROM resp WHERE TIMEDIFF('".$mysqldate."',time) < ".$time_diff.") t GROUP BY id";
	/*$patientCounts = mysql_query($query);
	while($row = mysql_fetch_array($patientCounts)){
		$patientID = $row['id'];
		$count = $row['count'];
		$trig = $row['trig'];
		mysql_query("INSERT IGNORE INTO thresholds VALUES ('".$patientID."', '".$count."', '".$trig."')");
	}*/
	
	mysql_query("DROP TABLE IF EXISTS thresholds");
	mysql_query("CREATE TABLE thresholds (id BIGINT NOT NULL, count INT NOT NULL, trig VARCHAR(255) NOT NULL, CONSTRAINT pk PRIMARY KEY(id,count)) SELECT id, COUNT(id) AS count, GROUP_CONCAT(flag ORDER BY flag ASC SEPARATOR ' ') AS trig FROM (SELECT DISTINCT id, '<img src=\"img/temp.png\" />' AS flag FROM temp WHERE TIMEDIFF('".$mysqldate."',time) < ".$time_diff." AND TIMEDIFF('".$mysqldate."',time) >=0 UNION ALL SELECT DISTINCT id, '<img src=\"img/hr.png\" />' AS flag FROM hr WHERE TIMEDIFF('".$mysqldate."',time) < ".$time_diff." AND TIMEDIFF('".$mysqldate."',time) >=0 UNION ALL SELECT DISTINCT id, '<img src=\"img/wbc.png\" />' AS flag FROM wbc WHERE TIMEDIFF('".$mysqldate."',time) < ".$time_diff." AND TIMEDIFF('".$mysqldate."',time) >=0 UNION ALL SELECT DISTINCT id, '<img src=\"img/sbp.png\" />' AS flag FROM sbc WHERE TIMEDIFF('".$mysqldate."',time) < ".$time_diff." AND TIMEDIFF('".$mysqldate."',time) >=0 UNION ALL SELECT DISTINCT id, '<img src=\"img/lac.png\" />' AS flag FROM lactate WHERE TIMEDIFF('".$mysqldate."',time) < ".$time_diff." AND TIMEDIFF('".$mysqldate."',time) >=0 UNION ALL SELECT DISTINCT id, '<img src=\"img/resp.png\" />' AS flag FROM resp WHERE TIMEDIFF('".$mysqldate."',time) < ".$time_diff." AND TIMEDIFF('".$mysqldate."',time) >=0) t GROUP BY id");
	
	$thresholds = mysql_query("SELECT value FROM current_thresholds WHERE threshold_name = 'limit'");
	$row = mysql_fetch_array($thresholds);
	$limit = $row['value'];
	$result = mysql_query("SELECT DISTINCT id, trig FROM thresholds WHERE count >= '".$limit."' ORDER BY count DESC");
	
	mysql_query("DROP TABLE IF EXISTS thresholds_past");
	mysql_query("CREATE TABLE thresholds_past (id BIGINT NOT NULL, count INT NOT NULL, trig VARCHAR(255) NOT NULL, CONSTRAINT pk PRIMARY KEY(id,count)) SELECT id, COUNT(id) AS count, GROUP_CONCAT(flag ORDER BY flag ASC SEPARATOR ' ') AS trig FROM (SELECT DISTINCT id, '<img src=\"img/temp.png\" />' AS flag FROM temp WHERE TIMEDIFF('".$pastdate."',time) < ".$time_diff." AND TIMEDIFF('".$pastdate."',time) >=0 UNION ALL SELECT DISTINCT id, '<img src=\"img/hr.png\" />' AS flag FROM hr WHERE TIMEDIFF('".$pastdate."',time) < ".$time_diff." AND TIMEDIFF('".$pastdate."',time) >=0 UNION ALL SELECT DISTINCT id, '<img src=\"img/wbc.png\" />' AS flag FROM wbc WHERE TIMEDIFF('".$pastdate."',time) < ".$time_diff." AND TIMEDIFF('".$pastdate."',time) >=0 UNION ALL SELECT DISTINCT id, '<img src=\"img/sbp.png\" />' AS flag FROM sbc WHERE TIMEDIFF('".$pastdate."',time) < ".$time_diff." AND TIMEDIFF('".$pastdate."',time) >=0 UNION ALL SELECT DISTINCT id, '<img src=\"img/lac.png\" />' AS flag FROM lactate WHERE TIMEDIFF('".$pastdate."',time) < ".$time_diff." AND TIMEDIFF('".$pastdate."',time) >=0 UNION ALL SELECT DISTINCT id, '<img src=\"img/resp.png\" />' AS flag FROM resp WHERE TIMEDIFF('".$pastdate."',time) < ".$time_diff." AND TIMEDIFF('".$pastdate."',time) >=0) t GROUP BY id");
	
	$result_past = mysql_query("SELECT DISTINCT id, trig FROM thresholds_past WHERE count >= '".$limit."' ORDER BY count DESC");
	
	mysql_query("DROP TABLE IF EXISTS uk_scores");
	mysql_query("CREATE TABLE uk_scores (id BIGINT NOT NULL, time DATETIME NOT NULL, score INT NOT NULL, trig VARCHAR(50) NOT NULL, CONSTRAINT pk PRIMARY KEY(id,time)) SELECT id , time, SUM(score) AS scoring, GROUP_CONCAT(flag ORDER BY flag ASC SEPARATOR ' ') AS trig FROM (SELECT DISTINCT id,time,score, 'temp2' AS flag FROM temp_UK_2 WHERE TIMEDIFF('".$mysqldate."',time) < ".$time_diff." AND TIMEDIFF('".$mysqldate."',time) >=0 UNION ALL SELECT DISTINCT id,time,score, 'hr1' AS flag FROM hr_UK_1 WHERE TIMEDIFF('".$mysqldate."',time) < ".$time_diff." AND TIMEDIFF('".$mysqldate."',time) >=0 UNION ALL SELECT DISTINCT id,time,score, 'hr2' AS flag FROM hr_UK_2 WHERE TIMEDIFF('".$mysqldate."',time) < ".$time_diff." AND TIMEDIFF('".$mysqldate."',time) >=0 UNION ALL SELECT DISTINCT id,time,score, 'hr3' AS flag FROM hr_UK_3 WHERE TIMEDIFF('".$mysqldate."',time) < ".$time_diff." AND TIMEDIFF('".$mysqldate."',time) >=0 UNION ALL SELECT DISTINCT id,time,score, 'sbp1' AS flag FROM sbp_UK_1 WHERE TIMEDIFF('".$mysqldate."',time) < ".$time_diff." AND TIMEDIFF('".$mysqldate."',time) >=0 UNION ALL SELECT DISTINCT id,time,score, 'sbp2' AS flag FROM sbp_UK_2 WHERE TIMEDIFF('".$mysqldate."',time) < ".$time_diff." AND TIMEDIFF('".$mysqldate."',time) >=0 UNION ALL SELECT DISTINCT id,time,score, 'sbp3' AS flag FROM sbp_UK_3 WHERE TIMEDIFF('".$mysqldate."',time) < ".$time_diff." AND TIMEDIFF('".$mysqldate."',time) >=0 UNION ALL SELECT DISTINCT id,time,score, 'resp1' AS flag FROM resp_UK_1 WHERE TIMEDIFF('".$mysqldate."',time) < ".$time_diff." AND TIMEDIFF('".$mysqldate."',time) >=0 UNION ALL SELECT DISTINCT id,time,score, 'resp2' AS flag FROM resp_UK_2 WHERE TIMEDIFF('".$mysqldate."',time) < ".$time_diff." AND TIMEDIFF('".$mysqldate."',time) >=0 UNION ALL SELECT DISTINCT id,time,score, 'resp3' AS flag FROM resp_UK_3 WHERE TIMEDIFF('".$mysqldate."',time) < ".$time_diff." AND TIMEDIFF('".$mysqldate."',time) >=0) t GROUP BY id,time");
	
	mysql_query("DROP TABLE IF EXISTS uk_results");
	mysql_query("CREATE TABLE uk_results select id1 AS id,sum(scoring) AS score, group_concat(flag order by flag asc separator ' ') AS trig from (select id as id1,score as scoring,'age1' as flag from age_UK_1 union all select id as id1,score as scoring,'age2' as flag from age_UK_2 union all select id as id1,score as scoring,'age3' as flag from age_UK_3 UNION ALL (select id as id1, scoring, trig as flag from uk_scores, (select id as in_id,max(scoring) as max from uk_scores group by in_id) t where id=in_id and scoring = max group by id)) y group by id1 having sum(scoring)>5");
	$result_uk = mysql_query("SELECT DISTINCT id, trig FROM uk_results");
	
		echo "<table><tr><td valign=\"top\">";
		echo "<table>";
		echo "<tr><td><b>Thresholds</b> (<a href=\"editThresholds.php\">Edit</a>)</td></tr>";
		echo "<tr><td width=150>Heart Rate: ".$hr."</td><td width=300>Temp (C): ".$tempC."</td></tr>";
		echo "<tr><td>WBC High: ".$wbc_high."</td><td>WBC Low: ".$wbc_low."</td></tr>";
		echo "<tr><td>Systolic BP: ".$sys_bp."</td><td>Lactate: ".$lactate."</td></tr>";
		echo "<tr><td>Resp Rate: ".$resp."</td><td>Threshold Limit: ".$limit."</td></tr>";
		echo "<tr><td>Num Days: ".$num_days."</td><td>Reference Date: ".$mysqldate."</td></tr>";
		echo "</table></td><td valign=\"top\">";
		echo "<table><tr><td valign=\"top\">";
		echo "<b>Threshold Legend</b><br>";
		echo "<img src=\"img/hr.png\" /> - Heart Rate<br>";
		echo "<img src=\"img/temp.png\" /> - Temperature<br>";
		echo "<img src=\"img/wbc.png\" /> - White Blood Cell Count<br>";
		echo "<img src=\"img/sbp.png\" /> - Systolic Blood Pressure<br>";
		echo "<img src=\"img/lac.png\" /> - Lactate<br>";
		echo "<img src=\"img/resp.png\" /> - Respiratory Rate<br>";
		echo "</td></tr></table></td></tr></table><br>";
		//echo "Showing patients with ".$limit." or more threshold trips<br>";
		if (mysql_num_rows($result) == 0) {
		echo "Error: unable to get patient info.";
		} else {
		echo "<table><tr><td width=300 valign=\"top\">";
		echo "<b>Active Patients</b>";
		echo "<table>";
		$count = 0;
		while ($row = mysql_fetch_array($result)){
			echo "<tr><td><a href=\"profile.php?id=".$row['id']."\">".$row['id']."</a></td><td>".$row['trig']."</td></tr>";
			$count = $count + 1;
		}
		echo "<tr><td>Total Patients: ".$count."</td></tr>";
		echo "</table></td>";
		
		echo "<td valign=\"top\" width=300><b>Past Patients</b>";
		echo "<table>";
		$count = 0;
		while ($row = mysql_fetch_array($result_past)){
			echo "<tr><td><a href=\"profile.php?id=".$row['id']."\">".$row['id']."</a></td><td>".$row['trig']."</td></tr>";
			$count = $count + 1;
		}
		echo "<tr><td>Total Patients: ".$count."</td></tr>";
		echo "</table></td>";
		
		echo "<td valign=\"top\"><b>Univ. Kentucky Scoring</b>";
		echo "<table>";
		$count = 0;
		while ($row = mysql_fetch_array($result_uk)){
			echo "<tr><td>".$row['id']."</td><td>".$row['trig']."</td></tr>";
			$count = $count + 1;
		}
		echo "<tr><td>Total Patients: ".$count."</td></tr>";
		echo "</table>";
		echo "</td></tr></table>";
		
	}
	
	/*mysql_query("DROP TABLE temp");
	mysql_query("DROP TABLE hr");
	mysql_query("DROP TABLE wbc");
	mysql_query("DROP TABLE sbc");
	mysql_query("DROP TABLE resp");
	mysql_query("DROP TABLE lactate");
	mysql_query("DROP TABLE thresholds");*/
	mysql_close($link);
	?>
	</div>

<!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="../assets/js/jquery.js"></script>
    <script src="../assets/js/bootstrap-transition.js"></script>
    <script src="../assets/js/bootstrap-alert.js"></script>
    <script src="../assets/js/bootstrap-modal.js"></script>
    <script src="../assets/js/bootstrap-dropdown.js"></script>
    <script src="../assets/js/bootstrap-scrollspy.js"></script>
    <script src="../assets/js/bootstrap-tab.js"></script>
    <script src="../assets/js/bootstrap-tooltip.js"></script>
    <script src="../assets/js/bootstrap-popover.js"></script>
    <script src="../assets/js/bootstrap-button.js"></script>
    <script src="../assets/js/bootstrap-collapse.js"></script>
    <script src="../assets/js/bootstrap-carousel.js"></script>
    <script src="../assets/js/bootstrap-typeahead.js"></script>
	</body>
	
</html>