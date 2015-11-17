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
		<p>Input your name, source language, target language, and text for translation.</p>
		
		<form method="post" id="translationForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
		
			<table id="translationTable"><form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
				<tr>
					<td style="width: 10%">
						Name:
					</td>
					<td style="width: 20%">
						<input type = "text" style = "width: 80%" name = "name"></input>
					</td>
					<td style="width: 10%">
						Text:
					</td>
					<td style="width: 20%" rowspan="2">
						<textarea name="textLID" rows="5" cols="40"><?php echo $textLID;?></textarea>
					</td>
					<td style="width: 10%" rowspan="2">
						<input type="submit" name="translate" value="Translate" />
					</td>
				</tr>
				<tr>
					<td style="width: 10%">
						Source:
					</td>
					<td style="width: 20%">
						<select name="srcLang" form="translationForm">
							<option value="en">English</option>
							<option value="fr">French</option>
							<option value="ptbr">Portuguese</option>
							<option value="es">Spanish</option>
						</select>
					</td>
				</tr>
				<tr>
					<td style="width: 10%">
						Target:
					</td>
					<td style="width: 20%">
						<select name="tgtLang" form="translationForm">
							<option value="en">English</option>
							<option value="fr">French</option>
							<option value="ptbr">Portuguese</option>
							<option value="es">Spanish</option>
						</select>
					</td>
					<td style="width: 10%">
						Translation:
					</td>
					<td style="width: 20%" rowspan="2">
						<textarea name="translatedText" rows="5" cols="40"><?php echo $translation; ?></textarea>
					</td>
					<td style="width: 10%">
						<input type="submit" name="store" value="Store in Table" />
					</td>
				</tr>
			</table>		
		</form>
    </div>
    
    
    <div id="bg3" class="backgroundImage" data-stellar-background-ratio="0.5"></div>
    
    <div class="section">
    
        <h2>Título da tabela</h2>
        
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
				</form>
			</tr>
		</tbody></table>

    </div>
    
    <div id="bg4" class="backgroundImage" data-stellar-background-ratio="0.5"></div>
    
    <div id="footer" class="section">
        <h2>Footer -> arrumar</h2>
        <p>Insert content.</p>
    </div>
    

</body>
</html>