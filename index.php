<?php include 'db.php';?>
<?php include 'feed.php';?>

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
    	<h2>Watson Communicator</h2>
        <p>Insert description here.</p>
    </div>
    
    <div id="bg2" class="backgroundImage" data-stellar-background-ratio="0.5"></div>
    
    <div class="section">

		<h2>Communicator Translation Service</h2>
        <p>
        	Description<br/>
			<input type="button" class = "button" onclick="window.location = 'init.php';" value="Reset table"></input></br>
		</p>

		<table id='feedbackTable'><tbody>
		
			<?php
				echo "<tr>\n";
				while ($property = mysqli_fetch_field($result)) {
					if ($property->name != "ID") {
						echo '<th>' .  $property->name . "</th>\n"; //the headings
					}
				}
				echo "</tr>\n";

				mysqli_data_seek ( $result, 0 );
				if($result->num_rows == 0){ //nothing in the table
							echo '<td>Empty!</td>';
				}
				
				while ( $row = mysqli_fetch_row ( $result ) ) {
					echo "<tr>\n";
					for($i = 1; $i < mysqli_num_fields ( $result ); $i ++) {
						echo '<td>' . "$row[$i]" . '</td>';
					}
					echo "</tr>\n";
				}

				$result->close();
				mysqli_close();
			?>
			<tr>
				<form method = "POST">
					<td colspan = "2">
					<input type = "text" style = "width:100%" name = "name"></input>
					</td>
				
					<td>
					<textarea name="feedback" rows="5" cols="40"></textarea>
					</td>
				
					<td>
						<input type="submit" name="insert" value="Insert" />
					</td> 
				</form>
			</tr>
		</tbody></table>
    </div>
    
    <div id="bg3" class="backgroundImage" data-stellar-background-ratio="0.5"></div>
    
    <div class="section">
    
        <h2>Título da tabela</h2>
        <p>Tabela aqui.</p>
        
		<table>
			<tr>
				<td style='width: 30%;'><img class = 'newappIcon' src='images/newapp-icon.png'>
				</td>
				<td>
					<h2>Watson Language Identification</h2>
					<p><span class="error">* required field.</span></p>
					<form method = "POST">
						Enter text to identify language: <textarea name="textLID" rows="5" cols="40"><?php echo $textLID;?></textarea>
	                       
						<span class="error">* <?php echo $textLIDErr;?></span>
	                       
						<input type="submit" name="translate" value="Translate">
					</form>
	             
					<?php
					echo "<h2>Translation: </h2>";
					echo $translation;
					?>
				</td>
			</tr>
		</table>

    </div>
    
    <div id="bg4" class="backgroundImage" data-stellar-background-ratio="0.5"></div>
    
    <div id="footer" class="section">
        <h2>Footer -> arrumar</h2>
        <p>Insert content.</p>
    </div>
    

</body>
</html>