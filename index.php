<?php include 'mysql.php';?>
<?php include 'feed.php';?>

<!DOCTYPE html>
<html>
<head>
	<title>WatsonCommunicator Application</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <link rel='stylesheet'  href='http://fonts.googleapis.com/css?family=Open+Sans:400,600,300' type='text/css'>
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css" />

    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
    <script src="js/jquery.stellar.js"></script>
    <script src="js/script.js"></script>
    <script src="js/jquery.nicescroll.js"></script>
    <script src="js/jquery.cookie.js"></script>
    <script src="index.js"></script>
    
    <script type="text/javascript">
		$(document).ready(function() {
			if ( $.cookie("scroll") !== null ) { // scroll back to position
		        $(document).scrollTop($.cookie("scroll"));
		    }
		
		    $('.submit').on("click", function() { // called when a button is clicked
		        $.cookie("scroll", $(document).scrollTop()); // update scroll position
		    });
		});
		
    	$(window).on("hashchange", function () {
    		window.scrollTo(window.scrollX, window.scrollY - 140);
		});
    </script>
    
</head>
<body>

	<div id="navigationBar">
		 <div class="navigationItem"><img src="images/newapp-icon.png"></div>
		 <div class="navigationItem"><h1 id="navigationTitle">WatsonCommunicator</h1></div>
		 
		 <div class="navigationRight">
		 	<ul>
		 		<li class="navigationRightItem"><a href="#sectionAbout">About</a></li>
		 		<li class="navigationRightItem"><a href="#sectionTranslation">Translation Service</a></li>
		 		<li class="navigationRightItem"><a href="#sectionHistory">History</a></li>
		 	</ul>
		 </div>
	</div>
	
	<div id="bg1" data-stellar-background-ratio="0.5">
		<div class="centerBlock">
        	<h2>Scroll for services</h2>
    	</div>
	</div>
    
    <div class="section" id="sectionAbout">
<h2>About Watson Communicator</h2>
    	
        <p>Watson Communicator is a service that allows you to translate text from predefined languages and store your 
        translation searches.  You may use words or even small paragraphs, up to 250 characters.</p>
        
        <p>The Communicator uses the <a href="https://www.ibm.com/smarterplanet/us/en/ibmwatson/developercloud/language-translation/api/v2/#introduction" target="_blank">Watson Language Translation API</a>.</p>
        
        <p>The current version of the service allows you to choose from English, French, Spanish and Portuguese in your translation schemes.</p>
        
        <p>After translating, you may chose to store your search into the database for future appreciation.</p>
        
        <p>Start by scrolling down to the Communicator Translation Service!  Good luck!</p>
    </div>
    
    <div id="bg2" class="backgroundImage" data-stellar-background-ratio="0.5"></div>
    
    <div class="section" id="sectionTranslation">

		<h2>Communicator Translation Service</h2>
		<p>Input your name, source language, target language, and text for translation.</p>
		
		<form method="post" id="translationForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
		
			<table id="translationTable" class="table"><form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
				<tr>
					<td style="width: 10%">
						Name:
					</td>
					<td style="width: 20%">
						<input type = "text" style = "width: 80%" name = "name" value="<?php echo $name;?>"></input>
					</td>
					<td style="width: 10%" rowspan="2">
						Text:
					</td>
					<td style="width: 20%" rowspan="2">
						<textarea name="originalText" rows="5" cols="40" maxlength="250"><?php echo $originalText;?></textarea>
					</td>
					<td style="width: 10%" rowspan="2">
						<input type="submit" class="submit" name="translate" value="Translate" />
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
					<td style="width: 10%" rowspan="2">
						Translation:
					</td>
					<td style="width: 20%" rowspan="2">
						<textarea name="translatedText" rows="5" cols="40" maxlength="250"><?php echo $translation; ?></textarea>
					</td>
					<td style="width: 10%" rowspan="2">
						<input type="submit" class="submit" name="store" value="Store in Table" />
					</td>
				</tr>
				<tr><td></td><td></td></tr>
				<tr><td colspan="5"><span class="error"><?php echo $originalTextErr;?></span></td></tr>
			</table>		
		</form>
    </div>
    
    
    <div id="bg3" class="backgroundImage" data-stellar-background-ratio="0.5"></div>
    
    <div class="section" id="sectionHistory">
    
        <h2>Translated History</h2>
        
        <p>
        	Description<br/>
			<input type="button" class = "submit" onclick="window.location = 'init.php';" value="Reset table"></input></br>
		</p>

		<table id="feedbackTable" class="table"><tbody>
		
			<?php
				echo "<tr>\n";
				while ($property = mysqli_fetch_field($queryRes)) {
					if ($property->name != "ID") {
						$size = '0';
						if ($property->name == "NAME" || $property->name == "TIME") $size = '10';
						else $size = '20';
						
						echo '<th style="width: ' . $size . '%">' .  $property->name . "</th>\n"; //the headings
					}
				}
				echo "</tr>\n";

				mysqli_data_seek ($queryRes, 0);
				if ($queryRes->num_rows == 0) { //nothing in the table
					echo '<td>Empty!</td>';
				}
				
				while ($row = mysqli_fetch_row ($queryRes)) {
					echo "<tr>\n";
					for ($i = 1; $i < mysqli_num_fields ($queryRes); $i ++) {
						echo '<td>' . "$row[$i]" . '</td>';
					}
					echo "</tr>\n";
				}

				$queryRes->close();
				mysqli_close();
			?>
		</tbody></table>

    </div>
    
    <div id="bg4" class="backgroundImage" data-stellar-background-ratio="0.5"></div>

    <div id="footer" class="section">

        <div class="footerLeft">
			<p><a href="#bg1">Back to Top</a></p>
       </div>
        
        <div class="footerRight">
        	<p>All Rights Reserved.</p>
        </div>

		<div style="float: clear;"></div>
    </div>
    

</body>
</html>