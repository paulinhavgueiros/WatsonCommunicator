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



/**
* Copyright 2015 IBM Corp. All Rights Reserved.
*
* Licensed under the Apache License, Version 2.0 (the “License”);
* you may not use this file except in compliance with the License.
* You may obtain a copy of the License at
*
* https://www.apache.org/licenses/LICENSE-2.0
*
* Unless required by applicable law or agreed to in writing, software
* distributed under the License is distributed on an “AS IS” BASIS,
* WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
* See the License for the specific language governing permissions and
* limitations under the License.
*/
->

<?php include 'db.php';?>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") { //if new message is being added
    $cleaned_message = preg_replace('/[^a-zA-Z0-9.\s]/', '', $_POST["message"]); //remove invalid chars from input.
    $strsq0 = "INSERT INTO MESSAGES_TABLE ( MESSAGE) VALUES ('" . $cleaned_message . "');"; //query to insert new message
    if ($mysqli->query($strsq0)) {
        //echo "Insert success!";
    } else {
        echo "Cannot insert into the data table; check whether the table is created, or the database is active. "  . mysqli_error();
    }
}

//Query the DB for messages
$strsql = "select * from MESSAGES_TABLE ORDER BY ID DESC limit 100";
if ($result = $mysqli->query($strsql)) {
   // printf("<br>Select returned %d rows.\n", $result->num_rows);
} else {
        //Could be many reasons, but most likely the table isn't created yet. init.php will create the table.
        echo "<b>Can't query the database, did you <a href = init.php>Create the table</a> yet?</b>";
    }
?>


<!DOCTYPE html>
<html>

<head>
    <title>PHP MySQL Sample Application</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,minimum-scale=1,user-scalable=no" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <div class="">
        <img class="newappIcon" src="images/newapp-icon.png" />
        <h1>
					Welcome to the <span class="blue">PHP MySQL Sample</span> on Bluemix!
				</h1>
        <p class="description">This introductory sample allows you to insert messages into a MySQL database. <br>


            <input type="button" class = "mybutton" onclick="window.location = 'init.php';" class="btn" value="(Re-)Create table"></input></p>
            </br>

    
    <table id='notes' class='records'><tbody>
        
        <?php
            echo "<tr>\n";
            while ($property = mysqli_fetch_field($result)) {
                    echo '<th>' .  $property->name . "</th>\n"; //the headings

            }
            echo "</tr>\n";

            mysqli_data_seek ( $result, 0 );
            if($result->num_rows == 0){ //nothing in the table
                        echo '<td>Empty!</td>';
            }
                
            while ( $row = mysqli_fetch_row ( $result ) ) {
                echo "<tr>\n";
                for($i = 0; $i < mysqli_num_fields ( $result ); $i ++) {
                    echo '<td>' . "$row[$i]" . '</td>';
                }
                echo "</tr>\n";
            }

            $result->close();
            mysqli_close();
        ?>
        <tr>
            <form method = "POST"> <!--FORM: will submit to same page (index.php), and if ($_SERVER["REQUEST_METHOD"] == "POST") will catch it --> 
                <td colspan = "2">
                <input type = "text" style = "width:100%" name = "message" autofocus onchange="saveChange(this)" onkeydown="onKey(event)"></input>
                </td>
                <td>
                    <button class = "mybutton" type = "submit">Add New Message</button></td></tr>
                </td> 
            </form>
        </tr>
        </tbody>
    </table>
    </div>
</body>

</html>





