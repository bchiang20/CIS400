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
 
 	<!-- Script -->
 	 <script type="text/javascript">
			function search() {
				var pid = document.getElementById("pid").value;
				//var age = document.getElementById("age").value;
				
				if (pid.length == 0)
				{
					alert("Please fill in at least one search criteria");
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
				
				var query = "pid=" + pid;    
				xmlhttp.open("GET", "search.php?" + query, true);
				xmlhttp.send(null);
			
			}
			
			function load(url) {
				location.href = url;
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
              <li><a href="editThresholds.php">Edit Thresholds</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>

	 <div class="container-fluid">
      <div class="row-fluid">
        <div class="span3">
          <div class="well sidebar-nav">
            <ul class="nav nav-list">
            	<h1>Search</h1>      
              <li class="nav-header">Patient ID</li>
              <input class="xxlarge" id="pid" name="patientID" size="30" type="text" placeholder="Type Patient ID Here"/>

              <!--<li class="nav-header">Age</li>
		      <input class="xxlarge" id="age" name="age" size="30" type="text" placeholder="Type Age Here"/>-->

             <!--<li class="nav-header">Time Admitted</li>
              <li><a href="#">Link</a></li>
              <li><a href="#">Link</a></li>
              <li><a href="#">Link</a></li>-->
              
              <br><p><a class="btn btn-primary btn-large" href="search()">Search</a>   
              	<a class="btn btn-primary btn-large" href="#" onclick="load('search.html')">Clear</a>
              	</p><br>
				
            </ul>
          </div><!--/.well -->
        </div><!--/span-->
        
        <!--TABLE OF RESULTS-->
        <div class="span9">
          <div class="hero-unit">
            <h1>Results</h1>
            <p>Below should be a table of the patient ID, Date Admitted</p>
            <!--PHP TO GRAB TABLE CONTENT HERE-->
            <table class="table table-bordered">
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
				
				$pid = '9000862378300270'; //TO DO: Grab VALUE FROM SEARCH BOX
				$result = mysql_query("SELECT * FROM thresholds WHERE id = '".$pid."'") or die(mysql_error());
				
				if (mysql_num_rows($result) == 0) {
					//echo "Error: unable to get patient info.";
					echo "<tbody><tr><td>No results</td></tr></tbody>";
				} else {
					echo "<thead><tr>
						<th>Patient ID</th>
						<th>Triggers that went off</th>
						</tr></thead>";
					echo "<tbody>";
					$count = 0;
					while ($row = mysql_fetch_array($result)){
						echo "<tr>
						<td>".$row['id']."</td>
						<td>".$row['trig']."</td>
						</tr>";
						$count = $count + 1;
					}
					echo "<tr><td><b>Total Results</b>: ".$count."</td></tr>";
					echo "</tbody>";
				}
				mysql_close($link); 
				  ?>
				  </table>
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