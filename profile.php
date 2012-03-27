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
                	jQuery.get('getHeartData.php', null, function(tsv) {
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
    
    	<!--Graphs-->
    	<center><h1>Heart Rate</h1></center>
		<div id="heart" style="width: 70%; height: 350px; margin: 0 auto"></div>
		
		<center><h1>Temperature</h1></center>	
		<div id="temp" style="width: 70%; height: 350px; margin: 0 auto"></div>
		
			
	</body>
</html>
