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
      	<script src="http://code.highcharts.com/modules/exporting.js"></script> 
    	
    	<script type="text/javascript">// <![CDATA[
    		getHeartChart();
    		
    		function load(url) {
				location.href = url;
			}
	
    		function getHeartChart() {
    			var chart;
            	$(document).ready(function() {
                	var options = {
                    	chart: {
                        	renderTo: 'heart',
                        	defaultSeriesType: 'line',
                        	//marginRight: 130,
                        //	marginBottom: 25
                    	},
                    	title: {
                        	text: 'Vital Signs vs. Time',
                        	x: -20 //center
                    	},
                    	subtitle: {
                        	text: '',
                        	x: -20
                   	 	},
                    	xAxis: {
                    		title: {
                    			text: 'Time',
                    		},
                        	type: 'datetime',
                        	tickWidth: 0,
                        	gridLineWidth: 1,
                        	labels: {
                            	align: 'center',
                            	x: -3,
                            	y: 20,
                            	formatter: function() {
                                	return Highcharts.dateFormat('%b%e %l%p', this.value);
                            	}
                        	},
                        	data: 3
                    	},
                    	yAxis: [{ //Heart Rate axis
                        	title: {
                            	text: 'Heart Rate (bpm)',
                            	style: {
                            		color: '#F83298'
                            	}
                        	},
                        	labels: {
                    			formatter: function() {
                        		return this.value;
                    			},
                    			style: {
                        			color: '#F83298'
                    			}
                			}
                    	},
                    	{ //Body Temperature Axis
                    		title: {
                            	text: 'Body Temperature (C)',
                            	style: {
                            		color: '#89A54E'
                            	}
                        	},
                        	labels: {
                    			formatter: function() {
                        		return this.value;
                    			},
                    			style: {
                        			color: '#89A54E'
                    			}
                			},
                        	opposite: true
                    	}, { //Blood Pressure
                    		title: {
                    			text: 'Blood Pressure (mb)',
                    			style: {
                    				color: '#9CBFCD'
                    			}
                    		},
                    		labels: {
                    			formattter: function() {
                    				return this.value;
                    			},
                    			style: {
                    				color: '#9CBFCD'
                    			}
                    		},
                    		opposite: true
                    	}, { //Lactate
                    		title: {
                    			text: 'Lactate',
                    			style: {
                    				color: '#FFFFFF'
                    			}
                    		},
                    		labels: {
                    			formattter: function() {
                    				return this.value;
                    			},
                    			style: {
                    				color: '#FFFFFF'
                    			}
                    		}, 
                    		opposite: true
                    	}, { //Respiration Rate
                    		title: {
                    			text: 'Respiration Rate',
                    			style: {
                    				color: '#F5CC0E'
                    			}
                    		},
                    		labels: {
                    			formatter: function() {
                    				return this.value;
                    			},
                    			style: {
                    				color: '#F5CC0E'
                    			}
                    		},
                    	}, {
                    		title: {
                    			text: 'White Blood Cell Count',
                    			style: {
                    				color: '#A60EF5'
                    			}
                    		},
                    		labels: {
                    			formatter: function() {
                    				return this.value;
                    			},
                    			style: {
                    				color: '#A60EF5'
                    			}
                    		},
                    		opposite: true
                    	}],
                    	tooltip: {
                			formatter: function() {
                    			var unit = {
                        			'Heart Rate': 'bpm',
                        			'Body Temperature': 'C',
                        			'Blood Pressure': 'mb',
                        			'Lactate': 'lact',
                       	 			'Respiration Rate': 'b',
                        			'WBC': 'c'
                    			}[this.series.name];
                    			return Highcharts.dateFormat('%b %e %l:%M%p', this.x) +': '+ this.y +' '+ unit;
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
                        	name: 'Heart Rate',
                        	color: '#F83298',
               				yAxis: 0,
                    	}, {
                    		name: 'Body Temperature',
                    		color: '#89A54E',
                    		yAxis: 1
                    	}, {
                    		name: 'Blood Pressure',
                    		color: '#9CBFCD',
                    		yAxis: 2
                    	}, {
                    		name: 'Lactate',
                    		color: '#FFFFFF',
                    		yAxis: 3
                    	}, {
                    		name: 'Respiration Rate',
                    		color: '#F5CC0E',
                    		yAxis: 4
                    	}, {
                    		name: 'White Blood Cell Count',
                    		color: '#A60EF5',
                    		yAxis: 5
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
                	
					var page2 = 'getTemperatureData.php?id=' + id;
					jQuery.get(page2, null, function(tsv) {
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
                    	options.series[1].data = traffic;
                    	chart = new Highcharts.Chart(options);
                	});
                	
					var page3 = 'getBloodPressureData.php?id=' + id;
					jQuery.get(page3, null, function(tsv) {
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
                    	options.series[2].data = traffic;
                    	chart = new Highcharts.Chart(options);
                	});
                	
                	var page4 = 'getLactateData.php?id=' + id;
					//alert(page);
                	jQuery.get(page4, null, function(tsv) {
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
                    	options.series[3].data = traffic;
                    	chart = new Highcharts.Chart(options);
                	});
					
					var page5 = 'getRespirationData.php?id=' + id;
					//alert(page);
                	jQuery.get(page5, null, function(tsv) {
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
                    	options.series[4].data = traffic;
                    	chart = new Highcharts.Chart(options);
                	});
                	
                	var page6 = 'getWbcData.php?id=' + id;
                	jQuery.get(page6, null, function(tsv) {
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
                    	options.series[5].data = traffic;
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
              <!--<li><a href="search.php">Search</a></li>-->
              <li><a href="editThresholds.php">Edit Thresholds</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div><!--container-fluid-->
      </div><!--navbar-inner-->
    </div><!--navbar navbar-fixed-top-->
    	
    	<!--Graphs-->
    	<h1>Everything</h1>
		<div id="heart" style="min-width: 400px; min-height: 500px; margin: 0 auto"></div>

</body>
</html>
