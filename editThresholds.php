<html>
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

	    <script type="text/javascript">
			function formsubmit() {
				var hr = document.getElementById("heart_rate").value;
				var temp = document.getElementById("temp").value;
				var wbc_high = document.getElementById("wbc_high").value;
				var wbc_low = document.getElementById("wbc_low").value;
				var sys_bp = document.getElementById("sys_bp").value;
				var lactate = document.getElementById("lactate").value;
				var resp = document.getElementById("resp").value;
				var limit = document.getElementById("limit").value;
				var date = document.getElementById("date").value;
		
				
				
				if(hr.length == 0 || temp.length == 0 || wbc_high.length == 0 || wbc_low.length == 0 || sys_bp.length == 0 || lactate.length == 0 || resp.length == 0 || limit.length == 0 || date.length==0) {
					alert("Please fill in all thresholds");
					return;
				}
				
				document.getElementById("message").innerHTML = "Updating databases...";
				xmlhttp = new XMLHttpRequest();
				xmlhttp.onreadystatechange = function() {
					if(xmlhttp.readyState == 4) {
 						//document.getElementById("user").innerHTML = xmlhttp.responseText;
 						var response = xmlhttp.responseText;
 						//alert(response);
 						if(response.trim().substring(0,1) == "1"){
 							alert("Update successful");
 							load('home.php');
 						}
 						else{
 							alert("Not successful. Please try again");
 						}
					}
				}
				
				var query = "hr=" + hr + "&temp=" + temp + "&wbc_high=" + wbc_high + "&wbc_low=" + wbc_low + 
				"&sys_bp=" + sys_bp + "&lactate=" + lactate + "&resp=" + resp + "&limit=" + limit + "&date="+date;    
				xmlhttp.open("GET", "editThresholds_process.php?" + query, true);
				xmlhttp.send(null);
			}
			
			function load(url) {
				location.href = url;
			}
			
		</script>
		
	</head>
	
	<title>Edit Thresholds</title>
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
              <li><a href="home.php">Home</a></li>
              <!--<li><a href="search.php">Search</a></li>-->
              <li class="active"><a href="editThresholds.php">Edit Thresholds</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>
		<div id="edit_threshold" >
			<form name="thresholds">
				<table>
					<tr>
						<td><label><p><strong>Heart Rate: </strong></p></label></td>
						<td><input type="text" id="heart_rate"/></td>
					</tr>
					<tr>
						<td><label><p><strong>Temperature: </strong></p></label></td>
						<td><input type="text" id="temp"/></td>
					</tr>
					<tr>
						<td><label><p><strong>WBC - High: </strong></p></label></td>
						<td><input type="text" id="wbc_high"/></td>
					</tr>
					<tr>
						<td><label><p><strong>WBC - Low: </strong></p></label></td>
						<td><input type="text" id="wbc_low"/></td>
					</tr>
					<tr>
						<td><label><p><strong>Systolic Blood Pressure: </strong></p></label></td>
						<td><input type="text" id="sys_bp"/></td>
					</tr>
					<tr>
						<td><label><p><strong>Lactate: </strong></p></label></td>
						<td><input type="text" id="lactate"/></td>
					</tr>
					<tr>
						<td><label><p><strong>Respiratory Rate: </strong></p></label></td>
						<td><input type="text" id="resp"/></td>
					</tr>
					<tr>
						<td><label><p><strong>Number of Thresholds: </strong></p></label></td>
						<td><input type="text" id="limit"/></td>
					</tr>
					<tr>
						<td><label><p><strong>Reference Date:</strong> (YYYY-MM-DD HH:MM:SS): </p></label></td>
						<td><input type="text" id="date"/></td>
					</tr>
			
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
						
						$thresholds = mysql_query("SELECT value FROM current_thresholds WHERE threshold_name = 'limit'");
						$row = mysql_fetch_array($thresholds);
						$limit = $row['value'];
						
						$thresholds = mysql_query("SELECT curr_date FROM date WHERE id = 1");
						$row = mysql_fetch_array($thresholds);
						$date = $row['curr_date'];
						
						echo "<script type=\"text/javascript\">document.getElementById(\"heart_rate\").value='".$hr."';document.getElementById(\"temp\").value='".$tempC."';document.getElementById(\"wbc_high\").value='".$wbc_high."';document.getElementById(\"wbc_low\").value='".$wbc_low."';document.getElementById(\"sys_bp\").value='".$sys_bp."';document.getElementById(\"lactate\").value='".$lactate."';document.getElementById(\"resp\").value='".$resp."';document.getElementById(\"limit\").value='".$limit."';document.getElementById(\"date\").value='".$date."';</script>";
					?>
					<tr>
						<td><input type="button" onclick="formsubmit()" value="Update Thresholds" /></td>
						<td><input type="button" onclick="load('home.php')" value="Cancel" /></td>
					</tr>
					<tr><td><div id="message"></div></td></tr>
				</table>
			</form>
		</div>
	</body>
		
</html>