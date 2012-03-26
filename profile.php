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
   		 <script type="text/javascript" src="http://code.jquery.com/jquery-1.6.2.min.js"></script>
    	 <script type="text/javascript">
      		google.load("visualization", "1", {packages:["corechart"]});
      		
      		google.setOnLoadCallback(drawHeartRateChart);

      		function drawHeartRateChart() {
        		var jsonData = $.ajax({
          		url: "getHeartData.php",
          		dataType:"json",
          		async: false
          		}).responseText;
        		
        		var data = new google.visualization.DataTable(jsonData);
        		
        		var chart = new google.visualization.LineChart(document.getElementById('heart_chart'));
        		chart.draw(data);
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
    
    	<h1>Heart Rate</h1>
    	<div id="heart_chart" style="width: 700px; height: 300px;"></div>
    	
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