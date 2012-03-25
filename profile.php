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
    	
    	<!-- Chart -->
   	 	<script type="text/javascript" src="https://www.google.com/jsapi"></script>
   		<script type="text/javascript">
      		google.load("visualization", "1", {packages:["corechart"]});
      		
      		google.setOnLoadCallback(drawHeartRateChart);
      		google.setOnLoadCallback(drawLowWBCChart);
      		google.setOnLoadCallback(drawHighWBCChart);
      		google.setOnLoadCallback(drawLactateChart);
      		google.setOnLoadCallback(drawBloodPressureChart);

      		function drawRespiratoryChart() {
      			var data = new google.visualization.DataTable();
        		data.addColumn('string', 'Year');
        		data.addColumn('number', 'Sales');
        		data.addColumn('number', 'Expenses');
        		data.addRows([
          			['2001', 1000, 400],
          			['2005', 1170, 460],
          			['2006',  860, 580],
          			['2012', 1030, 540]
        		]);

        		var options = {
          			title: 'Heart Rate vs. Time'
        		};

        		var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
        		chart.draw(data, options);
      		}
      		
      		function drawTemperatureChart() {
      			var data = new google.visualization.DataTable();
        		data.addColumn('string', 'Year');
        		data.addColumn('number', 'Sales');
        		data.addColumn('number', 'Expenses');
        		data.addRows([
          			['2001', 1000, 400],
          			['2005', 1170, 460],
          			['2006',  860, 580],
          			['2012', 1030, 540]
        		]);

        		var options = {
          			title: 'Heart Rate vs. Time'
        		};

        		var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
        		chart.draw(data, options);
      		}
      		
      		function drawBloodPressureChart() {
      			var data = new google.visualization.DataTable();
        		data.addColumn('string', 'Year');
        		data.addColumn('number', 'Sales');
        		data.addColumn('number', 'Expenses');
        		data.addRows([
          			['2001', 1000, 400],
          			['2005', 1170, 460],
          			['2006',  860, 580],
          			['2012', 1030, 540]
        		]);

        		var options = {
          			title: 'Heart Rate vs. Time'
        		};

        		var chart = new google.visualization.LineChart(document.getElementById('bp_chart'));
        		chart.draw(data, options);
      		}
      		
      		function drawLactateChart() {
      			var data = new google.visualization.DataTable();
        		data.addColumn('string', 'Year');
        		data.addColumn('number', 'Sales');
        		data.addColumn('number', 'Expenses');
        		data.addRows([
          			['2001', 1000, 400],
          			['2005', 1170, 460],
          			['2006',  860, 580],
          			['2012', 1030, 540]
        		]);

        		var options = {
          			title: 'Lactate vs. Time'
        		};

        		var chart = new google.visualization.LineChart(document.getElementById('lactate_chart'));
        		chart.draw(data, options);
      		}
      		
      		function drawHighWBCChart() {
      			var data = new google.visualization.DataTable();
        		data.addColumn('string', 'Year');
        		data.addColumn('number', 'Sales');
        		data.addColumn('number', 'Expenses');
        		data.addRows([
          			['2001', 1000, 400],
          			['2005', 1170, 460],
          			['2006',  860, 580],
          			['2012', 1030, 540]
        		]);

        		var options = {
          			title: 'WBC-High vs. Time'
        		};

        		var chart = new google.visualization.LineChart(document.getElementById('wbc_high_chart'));
        		chart.draw(data, options);
      		}
      		
      		function drawLowWBCChart() {
      			var data = new google.visualization.DataTable();
        		data.addColumn('string', 'Year');
        		data.addColumn('number', 'Sales');
        		data.addColumn('number', 'Expenses');
        		data.addRows([
          			['2001', 1000, 400],
          			['2005', 1170, 460],
          			['2006',  860, 580],
          			['2012', 1030, 540]
        		]);

        		var options = {
          			title: 'WBC-Low vs. Time'
        		};

        		var chart = new google.visualization.LineChart(document.getElementById('wbc_low_chart'));
        		chart.draw(data, options);
      		} 
      		
      		function drawHeartRateChart() {
        		var data = new google.visualization.DataTable();
        		data.addColumn('string', 'Year');
        		data.addColumn('number', 'Sales');
        		data.addColumn('number', 'Expenses');
        		data.addRows([
          			['2001', 1000, 400],
          			['2005', 1170, 460],
          			['2006',  860, 580],
          			['2012', 1030, 540]
        		]);

        		var options = {
          			title: 'Heart Rate vs. Time'
        		};

        		var chart = new google.visualization.LineChart(document.getElementById('heart_chart'));
        		chart.draw(data, options);
      		}
      		
    	</script>
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
    
    	<!--Heart Rate-->
    	<h1>Heart Rate</h1>
    	<div id="heart_chart" style="width: 700px; height: 300px;"></div>
    	
    	<!--wbc_low_chart-->
    	<h1>WBC Low</h1>
    	<div id="wbc_low_chart" style="width: 700px; height: 300px;"></div>

		<!--wbc_high_chart-->
	    <h1>WBC High</h1>
    	<div id="wbc_high_chart" style="width: 700px; height: 300px;"></div>
    	
    	<!--lactate_chart-->
	    <h1>Lactate</h1>
    	<div id="lactate_chart" style="width: 700px; height: 300px;"></div>
    	
    	<!--bp_chart-->
	    <h1>Blood Pressure</h1>
    	<div id="bp_chart" style="width: 700px; height: 300px;"></div>
    </body>
</html>