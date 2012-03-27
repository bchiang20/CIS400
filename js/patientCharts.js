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