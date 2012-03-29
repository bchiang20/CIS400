<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
    	<title>Patient Profile</title>
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

    	<link rel="shortcut icon" href="../assets/ico/favicon.ico">
    	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="../assets/ico/apple-touch-icon-114-precomposed.png">
    	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="../assets/ico/apple-touch-icon-72-precomposed.png">
    	<link rel="apple-touch-icon-precomposed" href="../assets/ico/apple-touch-icon-57-precomposed.png">
    	
		<script type="text/javascript" src="js/jquery-1.7.1.min.js">// <![CDATA[
		// ]]></script>
		<script type="text/javascript" src="js/highcharts.js"></script>
    	<script type="text/javascript" src="js/themes/gray.js"></script>
    	
    	<script type="text/javascript">// <![CDATA[
    		getHeartChart();
    		getTemperatureChart();
    		getBloodPressureChart();
    		getLactateChart();
    		getRespirationChart();
    		getWbcChart();
    		
    		function getHeartChart() {
    			var chart;
            	$(document).ready(function() {
                	var options = {
                    	chart: {
                        	renderTo: 'heart',
                        	defaultSeriesType: 'line',
                        	marginRight: 130,
                        	marginBottom: 25
                    	},
                    	title: {
                        	text: 'Heart Rate (BPM) vs. Time',
                        	x: -20 //center
                    	},
                    	subtitle: {
                        	text: '',
                        	x: -20
                   	 	},
                    	xAxis: {
                    		title: {
                    			text: 'Time'
                    		},
                        	type: 'datetime',
                        	tickInterval: 3600 * 1000, // one hour
                        	tickWidth: 0,
                        	gridLineWidth: 1,
                        	labels: {
                            	align: 'center',
                            	x: -3,
                            	y: 20,
                            	formatter: function() {
                                	return Highcharts.dateFormat('%l%p', this.value);
                            	}
                        	}
                    	},
                    	yAxis: {
                        	title: {
                            	text: 'Heart Rate (BPM)'
                        	},
                        	plotLines: [{
                            	value: 0,
                            	width: 1,
                            	color: '#808080'
                        	}]
                    	},
                    	tooltip: {
                        	formatter: function() {
                                return Highcharts.dateFormat('%l%p', this.x-(1000*3600)) +'-'+ Highcharts.dateFormat('%l%p', this.x) +': <b>'+ this.y + '</b>';
                        	}
                    	},
                    	legend: {
                        	layout: 'vertical',
                        	align: 'right',
                        	verticalAlign: 'top',
                        	x: -10,
                        	y: 100,
                        	borderWidth: 0
                    	},
                    	series: [{
                        	name: 'Heart Rate (BPM)'
                    	}]
                	}
                	
                	// Load data asynchronously using jQuery. On success, add the data
                	// to the options and initiate the chart.
                	// This data is obtained by exporting a GA custom report to TSV.
                	// http://api.jquery.com/jQuery.get/
					var id = <?php echo $_GET["id"];?>;
					var page = 'getHeartData.php?id=' + id;
                	jQuery.get(page, null, function(tsv) {
                    	var lines = [];
                    	traffic = [];
                    	try {
                        	// split the data return into lines and parse them
                        	tsv = tsv.split(/\n/g);
                        	jQuery.each(tsv, function(i, line) {
                            	line = line.split(/\t/);
                            	date = Date.parse(line[0] +' UTC');
                            	traffic.push([
                                	date,
                                	parseInt(line[1].replace(',', ''), 10)
                            	]);
                        	});
                    	} catch (e) {  }
                    	options.series[0].data = traffic;
                    	chart = new Highcharts.Chart(options);
                	});
            	});
            	}//end of getHeartChart
            	
           function getTemperatureChart() {
    			var chart;
            	$(document).ready(function() {
                	var options = {
                    	chart: {
                        	renderTo: 'temp',
                        	defaultSeriesType: 'line',
                        	marginRight: 130,
                        	marginBottom: 25
                    	},
                    	title: {
                        	text: 'Body Temperature (C) vs. Time',
                        	x: -20 //center
                    	},
                    	subtitle: {
                        	text: '',
                        	x: -20
                   	 	},
                    	xAxis: {
                    		title: {
                    			text: 'Time'
                    		},
                        	type: 'datetime',
                        	tickInterval: 3600 * 1000, // one hour
                        	tickWidth: 0,
                        	gridLineWidth: 1,
                        	labels: {
                            	align: 'center',
                            	x: -3,
                            	y: 20,
                            	formatter: function() {
                                	return Highcharts.dateFormat('%l%p', this.value);
                            	}
                        	}
                    	},
                    	yAxis: {
                        	title: {
                            	text: 'Temperature (C)'
                        	},
                        	plotLines: [{
                            	value: 0,
                            	width: 1,
                            	color: '#808080'
                        	}]
                    	},
                    	tooltip: {
                        	formatter: function() {
                                return Highcharts.dateFormat('%l%p', this.x-(1000*3600)) +'-'+ Highcharts.dateFormat('%l%p', this.x) +': <b>'+ this.y + '</b>';
                        	}
                    	},
                    	legend: {
                        	layout: 'vertical',
                        	align: 'right',
                        	verticalAlign: 'top',
                        	x: -10,
                        	y: 100,
                        	borderWidth: 0
                    	},
                    	series: [{
                        	name: 'Temperature (C)'
                    	}]
                	}
                	// Load data asynchronously using jQuery. On success, add the data
                	// to the options and initiate the chart.
                	// This data is obtained by exporting a GA custom report to TSV.
                	// http://api.jquery.com/jQuery.get/
                	var id = <?php echo $_GET["id"];?>;
					var page = 'getTemperatureData.php?id=' + id;
                	jQuery.get(page, null, function(tsv) {
                    	var lines = [];
                    	traffic = [];
                    	try {
                        	// split the data return into lines and parse them
                        	tsv = tsv.split(/\n/g);
                        	jQuery.each(tsv, function(i, line) {
                            	line = line.split(/\t/);
                            	date = Date.parse(line[0] +' UTC');
                            	traffic.push([
                                	date,
                                	parseInt(line[1].replace(',', ''), 10)
                            	]);
                        	});
                    	} catch (e) {  }
                    	options.series[0].data = traffic;
                    	chart = new Highcharts.Chart(options);
                	});
            	});
            	}//end of getTemperatureChart
            	
            	function getBloodPressureChart() {
    			var chart;
            	$(document).ready(function() {
                	var options = {
                    	chart: {
                        	renderTo: 'bp',
                        	defaultSeriesType: 'line',
                        	marginRight: 130,
                        	marginBottom: 25
                    	},
                    	title: {
                        	text: 'Blood Pressure vs. Time',
                        	x: -20 //center
                    	},
                    	subtitle: {
                        	text: '',
                        	x: -20
                   	 	},
                    	xAxis: {
                    		title: {
                    			text: 'Time'
                    		},
                        	type: 'datetime',
                        	tickInterval: 3600 * 1000, // one hour
                        	tickWidth: 0,
                        	gridLineWidth: 1,
                        	labels: {
                            	align: 'center',
                            	x: -3,
                            	y: 20,
                            	formatter: function() {
                                	return Highcharts.dateFormat('%l%p', this.value);
                            	}
                        	}
                    	},
                    	yAxis: {
                        	title: {
                            	text: 'Blood Pressure'
                        	},
                        	plotLines: [{
                            	value: 0,
                            	width: 1,
                            	color: '#808080'
                        	}]
                    	},
                    	tooltip: {
                        	formatter: function() {
                                return Highcharts.dateFormat('%l%p', this.x-(1000*3600)) +'-'+ Highcharts.dateFormat('%l%p', this.x) +': <b>'+ this.y + '</b>';
                        	}
                    	},
                    	legend: {
                        	layout: 'vertical',
                        	align: 'right',
                        	verticalAlign: 'top',
                        	x: -10,
                        	y: 100,
                        	borderWidth: 0
                    	},
                    	series: [{
                        	name: 'Blood Pressure'
                    	}]
                	}
                	// Load data asynchronously using jQuery. On success, add the data
                	// to the options and initiate the chart.
                	// This data is obtained by exporting a GA custom report to TSV.
                	// http://api.jquery.com/jQuery.get/
                	var id = <?php echo $_GET["id"];?>;
					var page = 'getBloodPressureData.php?id=' + id;
                	jQuery.get(page, null, function(tsv) {
                    	var lines = [];
                    	traffic = [];
                    	try {
                        	// split the data return into lines and parse them
                        	tsv = tsv.split(/\n/g);
                        	jQuery.each(tsv, function(i, line) {
                            	line = line.split(/\t/);
                            	date = Date.parse(line[0] +' UTC');
                            	traffic.push([
                                	date,
                                	parseInt(line[1].replace(',', ''), 10)
                            	]);
                        	});
                    	} catch (e) {  }
                    	options.series[0].data = traffic;
                    	chart = new Highcharts.Chart(options);
                	});
            	});
            	}//end of getBloodPressureChart
            	
            function getLactateChart() {
    			var chart;
            	$(document).ready(function() {
                	var options = {
                    	chart: {
                        	renderTo: 'lactate',
                        	defaultSeriesType: 'line',
                        	marginRight: 130,
                        	marginBottom: 25
                    	},
                    	title: {
                        	text: 'Lactate vs. Time',
                        	x: -20 //center
                    	},
                    	subtitle: {
                        	text: '',
                        	x: -20
                   	 	},
                    	xAxis: {
                    		title: {
                    			text: 'Time'
                    		},
                        	type: 'datetime',
                        	tickInterval: 3600 * 1000, // one hour
                        	tickWidth: 0,
                        	gridLineWidth: 1,
                        	labels: {
                            	align: 'center',
                            	x: -3,
                            	y: 20,
                            	formatter: function() {
                                	return Highcharts.dateFormat('%l%p', this.value);
                            	}
                        	}
                    	},
                    	yAxis: {
                        	title: {
                            	text: 'Lactate'
                        	},
                        	plotLines: [{
                            	value: 0,
                            	width: 1,
                            	color: '#808080'
                        	}]
                    	},
                    	tooltip: {
                        	formatter: function() {
                                return Highcharts.dateFormat('%l%p', this.x-(1000*3600)) +'-'+ Highcharts.dateFormat('%l%p', this.x) +': <b>'+ this.y + '</b>';
                        	}
                    	},
                    	legend: {
                        	layout: 'vertical',
                        	align: 'right',
                        	verticalAlign: 'top',
                        	x: -10,
                        	y: 100,
                        	borderWidth: 0
                    	},
                    	series: [{
                        	name: 'Lactate'
                    	}]
                	}
                	// Load data asynchronously using jQuery. On success, add the data
                	// to the options and initiate the chart.
                	// This data is obtained by exporting a GA custom report to TSV.
                	// http://api.jquery.com/jQuery.get/
                	var id = <?php echo $_GET["id"];?>;
					var page = 'getLactateData.php?id=' + id;
					//alert(page);
                	jQuery.get(page, null, function(tsv) {
                    	var lines = [];
                    	traffic = [];
                    	try {
                        	// split the data return into lines and parse them
                        	tsv = tsv.split(/\n/g);
                        	jQuery.each(tsv, function(i, line) {
                            	line = line.split(/\t/);
                            	date = Date.parse(line[0] +' UTC');
                            	traffic.push([
                                	date,
                                	parseInt(line[1].replace(',', ''), 10)
                            	]);
                        	});
                    	} catch (e) {  }
                    	options.series[0].data = traffic;
                    	chart = new Highcharts.Chart(options);
                	});
            	});
            	}//end of getLactateChart
            	
            function getRespirationChart() {
    			var chart;
            	$(document).ready(function() {
                	var options = {
                    	chart: {
                        	renderTo: 'resp',
                        	defaultSeriesType: 'line',
                        	marginRight: 130,
                        	marginBottom: 25
                    	},
                    	title: {
                        	text: 'Respiration Rate vs. Time',
                        	x: -20 //center
                    	},
                    	subtitle: {
                        	text: '',
                        	x: -20
                   	 	},
                    	xAxis: {
                    		title: {
                    			text: 'Time'
                    		},
                        	type: 'datetime',
                        	tickInterval: 3600 * 1000, // one hour
                        	tickWidth: 0,
                        	gridLineWidth: 1,
                        	labels: {
                            	align: 'center',
                            	x: -3,
                            	y: 20,
                            	formatter: function() {
                                	return Highcharts.dateFormat('%l%p', this.value);
                            	}
                        	}
                    	},
                    	yAxis: {
                        	title: {
                            	text: 'Respiration Rate'
                        	},
                        	plotLines: [{
                            	value: 0,
                            	width: 1,
                            	color: '#808080'
                        	}]
                    	},
                    	tooltip: {
                        	formatter: function() {
                                return Highcharts.dateFormat('%l%p', this.x-(1000*3600)) +'-'+ Highcharts.dateFormat('%l%p', this.x) +': <b>'+ this.y + '</b>';
                        	}
                    	},
                    	legend: {
                        	layout: 'vertical',
                        	align: 'right',
                        	verticalAlign: 'top',
                        	x: -10,
                        	y: 100,
                        	borderWidth: 0
                    	},
                    	series: [{
                        	name: 'Respiration Rate'
                    	}]
                	}
                	// Load data asynchronously using jQuery. On success, add the data
                	// to the options and initiate the chart.
                	// This data is obtained by exporting a GA custom report to TSV.
                	// http://api.jquery.com/jQuery.get/
                	var id = <?php echo $_GET["id"];?>;
					var page = 'getRespirationData.php?id=' + id;
                	jQuery.get(page, null, function(tsv) {
                    	var lines = [];
                    	traffic = [];
                    	try {
                        	// split the data return into lines and parse them
                        	tsv = tsv.split(/\n/g);
                        	jQuery.each(tsv, function(i, line) {
                            	line = line.split(/\t/);
                            	date = Date.parse(line[0] +' UTC');
                            	traffic.push([
                                	date,
                                	parseInt(line[1].replace(',', ''), 10)
                            	]);
                        	});
                    	} catch (e) {  }
                    	options.series[0].data = traffic;
                    	chart = new Highcharts.Chart(options);
                	});
            	});
            	}//end of getRespirationChart
            	
            function getWbcChart() {
    			var chart;
            	$(document).ready(function() {
                	var options = {
                    	chart: {
                        	renderTo: 'wbc',
                        	defaultSeriesType: 'line',
                        	marginRight: 130,
                        	marginBottom: 25
                    	},
                    	title: {
                        	text: 'WBC vs. Time',
                        	x: -20 //center
                    	},
                    	subtitle: {
                        	text: '',
                        	x: -20
                   	 	},
                    	xAxis: {
                    		title: {
                    			text: 'Time'
                    		},
                        	type: 'datetime',
                        	tickInterval: 3600 * 1000, // one hour
                        	tickWidth: 0,
                        	gridLineWidth: 1,
                        	labels: {
                            	align: 'center',
                            	x: -3,
                            	y: 20,
                            	formatter: function() {
                                	return Highcharts.dateFormat('%l%p', this.value);
                            	}
                        	}
                    	},
                    	yAxis: {
                        	title: {
                            	text: 'WBC'
                        	},
                        	plotLines: [{
                            	value: 0,
                            	width: 1,
                            	color: '#808080'
                        	}]
                    	},
                    	tooltip: {
                        	formatter: function() {
                                return Highcharts.dateFormat('%l%p', this.x-(1000*3600)) +'-'+ Highcharts.dateFormat('%l%p', this.x) +': <b>'+ this.y + '</b>';
                        	}
                    	},
                    	legend: {
                        	layout: 'vertical',
                        	align: 'right',
                        	verticalAlign: 'top',
                        	x: -10,
                        	y: 100,
                        	borderWidth: 0
                    	},
                    	series: [{
                        	name: 'WBC'
                    	}]
                	}
                	// Load data asynchronously using jQuery. On success, add the data
                	// to the options and initiate the chart.
                	// This data is obtained by exporting a GA custom report to TSV.
                	// http://api.jquery.com/jQuery.get/
                	var id = <?php echo $_GET["id"];?>;
					var page = 'getWbcData.php?id=' + id;
                	jQuery.get(page, null, function(tsv) {
                    	var lines = [];
                    	traffic = [];
                    	try {
                        	// split the data return into lines and parse them
                        	tsv = tsv.split(/\n/g);
                        	jQuery.each(tsv, function(i, line) {
                            	line = line.split(/\t/);
                            	date = Date.parse(line[0] +' UTC');
                            	traffic.push([
                                	date,
                                	parseInt(line[1].replace(',', ''), 10)
                            	]);
                        	});
                    	} catch (e) {  }
                    	options.series[0].data = traffic;
                    	chart = new Highcharts.Chart(options);
                	});
            	});
            	}//end of getWbcChart
		// ]]></script>

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
    
    	<!--Patient Information-->
    	<div class="container">
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
			$pid = $_GET["id"];
    		
			$rows_json = mysql_query("SELECT * FROM Patients WHERE id = '".$pid."'");

			if (mysql_num_rows($rows_json) == 0) {
				echo "Error: unable to get patient " + $pid + "'s info.";
			} 
			else if (mysql_num_rows($rows_json) > 1) {
				echo "Error: more than 1 patient with this id? Bad DB error";
			}
			else {
				while($row = mysql_fetch_array($rows_json)) 
				{
					echo "<h1>Patient Information</h1>";
					echo "<p><strong>Patient ID:</strong> " .$row['id']. "</h1>";
					echo "<p><strong>Age:</strong> " . $row['age']. "</p>";
					echo "<p><strong>Hospital:</strong> " . $row['hosp']. "</p>";
					if (is_null($row['emergency_room'])) {
						echo "<p>No Emergency Room info</p>";
					}
					else {
						echo "<p><b>Emergency Room:</b> " . $row['emergency_room']. "</p>";
					}
					echo "<p><strong>Arrival Time:</strong> " . $row['arrival']. "</p>"; 
					echo "<p><strong>Admission Time:</strong> " . $row['admission']. "</p>";
					if (is_null($row['first_icu'])) {
						echo "<p>No First ICU listed info</p>";
					}
					else {
						echo "<p><strong>First ICU:</strong> " . $row['first_icu']. "</p>";
					}
					echo "<p><strong>Final Location:</strong> " . $row['final_loc']. "</p>";
					echo "<p><strong>Discharged:</strong> " . $row['discharged']. "</p>";

					if (is_null($row['hours_to_icu'])) {
						echo "<p>No Hours to ICU info</p>";
					}
					else {
						echo "<p><strong>Hours to ICU:</strong> " . $row['hrs_to_icu']. "</p>";
					}	
									
					if (is_null($row['deceased'])) {
						echo "<p>No Deceased info</p>";
					}
					else {
						echo "<p><strong>Deceased:</strong> " . $row['deceased']. "</p>";
					}	
					
					if (is_null($row['rrt'])) {
						echo "<p>No RRT info</p>";
					}
					else {
						echo "<p><strong>RRT:</strong> " . $row['rrt']. "</p>";
					}	
				}
			}
			mysql_close($link);
    	?>        	
    	<p><a class="btn btn-primary btn-large" onclick="load('search.php')">Search Again &raquo;</a></p>
     </div></div>
    	
    	<div class="container">
    		<!--Graphs-->
    		<center><h1>Heart Rate</h1></center>
			<div id="heart" style="width: 100%; height: 350px; margin: 0 auto"></div>
		
			<center><h1>Temperature</h1></center>	
			<div id="temp" style="width: 100%; height: 350px; margin: 0 auto"></div>
		
			<center><h1>Blood Pressure</h1></center>
			<div id="bp" style="width: 100%; height: 350px; margin: 0 auto"></div>

			<center><h1>Lactate</h1></center>
			<div id="lactate" style="width: 100%; height: 350px; margin: 0 auto"></div>

			<center><h1>Respiration Rate</h1></center>
			<div id="resp" style="width: 100%; height: 350px; margin: 0 auto"></div>
		
			<center><h1>White Blood Count</h1></center>
			<div id="wbc" style="width: 100%; height: 350px; margin: 0 auto"></div>
    	</div>
	</body>
</html>
