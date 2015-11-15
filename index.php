<!--<!DOCTYPE html>
<html>
<head>
	<title>WatsonHelper Application</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <link rel='stylesheet'  href='http://fonts.googleapis.com/css?family=Open+Sans:400,600,300' type='text/css'>
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css" />
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
    <script src="js/jquery.stellar.js"></script>
    <script src="js/script.js"></script>
    <script src="js/jquery.nicescroll.js"></script>
</head>
<body>
<!-- 
	<table>
		<tr>
			<td style='width: 30%;'><img class = 'newappIcon' src='images/newapp-icon.png'>
			</td>
			<td>
				<h1 id = "message"><?php echo "Paulinha's Hello world!"; ?>
</h1>
				<p class='description'></p> Thanks for creating a <span class="blue">PHP Starter Application</span>. Get started by reading our <a
				href="https://www.ng.bluemix.net/docs/#starters/php/index.html#php">documentation</a>
				or use the Start Coding guide under your app in your dashboard.
			</td>
			<td>
				<p id="demo">A Paragraph.</p>
				<button type="button" onclick="myFunction()">Try it</button>
			</td>
		</tr>
	</table>
-->



<!--
	<div id="navigationBar">
		 <div class="navigationItem"><img src="images/newapp-icon.png"></div>
		 <div class="navigationItem"><h1 id="navigationTitle">WatsonHelper</h1></div>
	</div>
	
	<div id="bg1" data-stellar-background-ratio="0.5">
		<div class="centerBlock">
        	<h2>Scroll for services</h2>
    	</div>
	</div>
    
    <div class="section">
  		Informacoes
	</div>
    
    <div id="bg2" class="backgroundImage" data-stellar-background-ratio="0.5"></div>
    
    <div class="section" >
        <h2>Second Service</h2>
        <p>Insert service here.</p>
    </div>
    
    <div id="bg3" class="backgroundImage" data-stellar-background-ratio="0.5"></div>
    
    <div class="section">
        <h2>Third Service</h2>
        <p>Insert service here.</p>
    </div>
    
    <div id="bg4" class="backgroundImage" data-stellar-background-ratio="0.5"></div>
    
    <div id="footer" class="section">
        <h2>Footer -> arrumar</h2>
        <p>Insert content.</p>
    </div>
    

</body>
</html>
-->


<!DOCTYPE html>
<html>
<head>
  <title>CF PHP MySQL Demo</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Bootstrap -->
  <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
</head>
<body>
	<h1>CF PHP MySQL Demo</h1>
	<input type="button" onclick="window.open('init.php');" class="btn" value="Create table"></input>
	<input type="button" onclick="window.open('info.php');" class="btn" value="View PHP info"></input>
	</br>

<?php	
echo '<h2>VCAP_SERVICE Environment variable</h2>';
echo "----------------------------------" . "</br>";
$key = "VCAP_SERVICES";
$value = getenv ( $key );
echo $key . ":" . $value . "</br>";
echo "----------------------------------" . "</br>";
$vcap_services = json_decode($_ENV["VCAP_SERVICES" ]);
$db = $vcap_services->{'mysql-5.5'}[0]->credentials;
$mysql_database = $db->name;
$mysql_port=$db->port;
$mysql_server_name =$db->host . ':' . $db->port;
$mysql_username = $db->username; 
$mysql_password = $db->password; 

$con = mysql_connect($mysql_server_name, $mysql_username, $mysql_password);
if (!$con){
    die ('connection failed' . mysql_error());
}
mysql_select_db($mysql_database,$con);   

$strsq0 = "INSERT INTO ACCESS_HISTORY ( BROWSER, IP_ADDRESS) VALUES
('" . $_SERVER['HTTP_USER_AGENT'] . "', '" . $_SERVER['REMOTE_ADDR'] . "');";
$result0 = mysql_query ( $strsq0 );
if ($result0) {
	//echo "insert success!";
} else {
	echo "Cannot insert into the data table; check whether the table is created, or the database is active.";
}
$strsql = "select * from ACCESS_HISTORY ORDER BY ID DESC limit 100";

$result = mysql_db_query ( $mysql_database, $strsql, $con );

$row = mysql_fetch_row ( $result );

echo '<h2>Access history</h2>';
echo '<table class="table">';
echo "\n<tr>\n";
for($i = 0; $i < mysql_num_fields ( $result ); $i ++) {
	echo '<th>' . mysql_field_name ( $result, $i );
	echo "</th>\n";
}
echo "</tr>\n";

mysql_data_seek ( $result, 0 );

while ( $row = mysql_fetch_row ( $result ) ) {
	echo "<tr>\n";
	for($i = 0; $i < mysql_num_fields ( $result ); $i ++) {
		echo '<td>';
		echo "$row[$i]";
		echo '</td>';
		
	}
	echo "</tr>\n";
}
echo "</table>\n";

mysql_free_result ( $result );
mysql_close();
?>
 <script src="http://code.jquery.com/jquery.js"></script>
  <script src="js/bootstrap.min.js"></script>
</body>
</html>
