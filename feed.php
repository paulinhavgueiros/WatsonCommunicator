<?php

// global variables
$textLID = "";
$textLIDErr = "";
$textLang = "";
$translation = "";
$srcLang = "";
$tgtLang = "";

function testLangID($data, $srcLang, $tgtLang) {
	$post_args = array(
		'text' => $data,
		'source' => $srcLang,
		'target' => $tgtLang
	);
     
	//var_dump($post_args);
 	 
	$newcurl = curl_init();
	curl_setopt($newcurl, CURLOPT_URL, "https://gateway.watsonplatform.net/language-translation/api/v2/translate?source=en&target=es&text=handbag");
	curl_setopt($newcurl, CURLOPT_POST, true);
    curl_setopt($newcurl, CURLOPT_POSTFIELDS, $post_args);
	curl_setopt($newcurl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
	curl_setopt($newcurl, CURLOPT_URL, "https://gateway.watsonplatform.net/language-translation/api/v2/translate");
	curl_setopt($newcurl, CURLOPT_USERPWD, "33f4756c-d320-4b45-9c1d-21fb52d56c15:p5UqhEj7gvcG");
	curl_setopt($newcurl, CURLOPT_RETURNTRANSFER, true);

	$translation = curl_exec($newcurl);
	curl_close($newcurl);
	
	//echo 'var dump na final string <br/>';
	//var_dump($translation);
    return $translation;
    
 }


 function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
 }
 

if ($_SERVER["REQUEST_METHOD"] == "POST") { //either insert or translate
	if (isset($_POST["store"])) {
		
		// inserting into database
		$cleaned_name = preg_replace('/[^a-zA-Z0-9.\s]/', '', $_POST["name"]);
	    $cleaned_translation = preg_replace('/[^a-zA-Z0-9.\s]/', '', $_POST["translatedText"]);
	    $strsq0 = "INSERT INTO FEEDBACK_TABLE (NAME, FEEDBACK) VALUES ('" . $cleaned_name . "', '" . $cleaned_translation . "');"; //new feedback
	    if ($mysqli->query($strsq0)) {
	        //echo "Insert success!";
	    } else {
	        echo "Cannot insert into the data table; check whether the table is created, or the database is active. "  . mysqli_error();
	    }
		
	} else if (isset($_POST["translate"])) {
		
		//echo '<body> to traduzindo <br/></body>'
		// translating text
		if (empty($_POST["textLID"])) {
			//echo '<body> ta vazio <br/></body>'
			$textLIDErr = "Text is required (at least 3 words)";
	    } else {
	    	//echo '<body> tem coisa <br/></body>'
	      	$textLID = test_input($_POST["textLID"]);
	      	$srcLang = $_POST['srcLang'];
	      	$tgtLang = $_POST['tgtLang'];
	       	$translation = testLangID($textLID, $srcLang, $tgtLang);
	 		//echo "Traducao: " . $translation;
    	}
    	
	} else {
		echo 'No button origin <br/>';
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


