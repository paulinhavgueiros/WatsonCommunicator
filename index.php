<?php include 'db.php';?>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") { //new feedback being inserted
	$cleaned_name = preg_replace('/[^a-zA-Z0-9.\s]/', '', $_POST["name"]);
    $cleaned_feedback = preg_replace('/[^a-zA-Z0-9.\s]/', '', $_POST["feedback"]);
    $strsq0 = "INSERT INTO FEEDBACK_TABLE (NAME, FEEDBACK) VALUES ('" . $cleaned_name . "', '" . $cleaned_feedback . "');"; //new feedback
    if ($mysqli->query($strsq0)) {
        //echo "Insert success!";
    } else {
        echo "Cannot insert into the data table; check whether the table is created, or the database is active. "  . mysqli_error();
    }
}

//Query the DB for feedbacks
$strsql = "select * from FEEDBACK_TABLE ORDER BY ID DESC limit 100";
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
	<title>WatsonHelper Application</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <link rel='stylesheet'  href='http://fonts.googleapis.com/css?family=Open+Sans:400,600,300' type='text/css'>
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css" />

    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
    <script src="js/jquery.stellar.js"></script>
    <script src="js/script.js"></script>
    <script src="js/jquery.nicescroll.js"></script>
    <script src="index.js"></script>
    
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
		<h1>Welcome to the <span class="blue">PHP MySQL Sample</span> on Bluemix!</h1>
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
                <input type = "text" style = "width:100%" name = "name" autofocus onchange="saveChange(this)" onkeydown="onKey(event)"></input>
                </td>
                
                <td colspan = "2">
                <textarea name="feedback" rows="10" cols="30"></textarea>
                </td>
                
                <td>
                    <button class = "mybutton" type = "submit">Submit Feedback</button></td></tr>
                </td> 
            </form>
        </tr>
        </tbody>
    </table>
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