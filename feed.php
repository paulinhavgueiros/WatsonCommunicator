<?php

// global variables
$originalText = "";
$originalTextErr = "";
$translation = "";
$name = "";


function testLangID($data, $srcLang, $tgtLang) {
	$post_args = array(
		'text' => $data,
		'source' => $srcLang,
		'target' => $tgtLang
	);
     
	//var_dump($post_args);
 	 
	$newcurl = curl_init();
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
		if (empty($_POST["name"]) || empty($_POST["originalText"]) || empty($_POST["translatedText"])) {
			$originalTextErr = "Please fill in Name and Translate text.";
	    } else {
	    	$cleaned_name = preg_replace('/[^a-zA-Z0-9.\s]/', '', $_POST["name"]);
	    	$cleaned_text = preg_replace('/[^a-zA-Z0-9.\s]/', '', $_POST["originalText"]);
		    $cleaned_translation = preg_replace('/[^a-zA-Z0-9.\s]/', '', $_POST["translatedText"]);
		    $strsq0 = "INSERT INTO TEXT_TABLE (NAME, ORIGINAL_TEXT, TRANSLATED_TEXT) VALUES ('" . $cleaned_name . "', '" . $cleaned_text . "', '" . $cleaned_translation . "');"; //new feedback
		    if ($mysqli->query($strsq0)) {
		        //echo "Insert success!";
		    } else {
		        echo "Cannot insert into the data table; check whether the table is created, or the database is active. "  . mysqli_error();
		    }
    	}

	} else if (isset($_POST["translate"])) {
		
		//echo '<body> to traduzindo <br/></body>'
		// translating text
		if (empty($_POST["originalText"])) {
			//echo '<body> ta vazio <br/></body>'
			$originalTextErr = "Text is required (at least 3 words)";
	    } else {
	    	//echo '<body> tem coisa <br/></body>'
	      	$originalText = test_input($_POST["originalText"]);
	      	$name = test_input($_POST["name"]);
	      	$srcLang = $_POST['srcLang'];
	      	$tgtLang = $_POST['tgtLang'];
	       	$translation = testLangID($originalText, $srcLang, $tgtLang);
	 		//echo "Traducao: " . $translation;
    	}
    	
	} else {
		echo 'No button origin <br/>';
	}
}


//Query the DB for feedbacks
$strsql = "select * from TEXT_TABLE ORDER BY ID DESC limit 100";
if ($queryRes = $mysqli->query($strsql)) {
   // There are results
} else {
	// No results found
	echo "<b>Please <a href = init.php>Create table</a> first.</b>";
}

    
?>


