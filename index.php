 <!DOCTYPE html>
 <html>
 <head>
     <title>PHP Starter Application</title>
     <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
     <link rel="stylesheet" href="style.css" />
 </head>
 <body>
 
 <?php
 function testLangID($data) {
 	echo 'Entrei <br/>';
 	 
	$newcurl = curl_init();
	curl_setopt($newcurl, CURLOPT_URL, "https://gateway.watsonplatform.net/language-translation/api/v2/translate?source=en&target=es&text=hello");
	curl_setopt($newcurl, CURLOPT_USERPWD, "33f4756c-d320-4b45-9c1d-21fb52d56c15:p5UqhEj7gvcG");
	$finalstr = curl_exec($newcurl);
	echo 'final string is ' . $finalstr . '<br/>';
	curl_close($newcurl);
 	
     /*$curl = curl_init();
     
     echo 'Curl:' . $curl . '<br/>';
     
     $post_args = array(
         'txt' => $data,
         'sid' => 'lid-generic',
         'rt' => 'json' 
     );
     
     echo 'post args:' . $post_args['txt'] . '<br/>';
     
     curl_setopt($curl, CURLOPT_POST, true);
     curl_setopt($curl, CURLOPT_POSTFIELDS, $post_args);
     curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
     curl_setopt($curl, CURLOPT_USERPWD, "33f4756c-d320-4b45-9c1d-21fb52d56c15":"p5UqhEj7gvcG");
     curl_setopt($curl, CURLOPT_URL, "https://gateway.watsonplatform.net/language-translation/api");
     curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
 */
     /*$result = curl_exec($curl);*/
     /*
     if( ! $result = curl_exec($curl)) 
    { 
        trigger_error(curl_error($curl)); 
    } 
    
    
     echo "resultado:" . $result . '<br/>';
     
     curl_close($curl);
     
     $decoded = json_decode($result, true);
     echo "decoded:" . $decoded . '<br/>';
     
     return $decoded; */
    
    return $finalstr;
 }
 // define variables and set to empty values
 $textLID = "";
 $textLIDErr = "";
 $textLang = "";
 
 if ($_SERVER["REQUEST_METHOD"] == "POST") {  
    if (empty($_POST["textLID"])) {
      $textLIDErr = "Text is required (at least 3 words)";
    } else {
      	$textLID = test_input($_POST["textLID"]);
      	echo "Meu texto eh" . $textLID;
       	$textLang = testLangID($textLID);
 		echo "Minha lingua eh" . $textLang;
    }
 } else {
 	echo 'no request method post <br/>';
 }
 

 function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
 }
 ?>
 
     <table>
         <tr>
             <td style='width: 30%;'><img class = 'newappIcon' src='images/newapp-icon.png'>
             </td>
             <td>
                 <h2>Watson Language Identification</h2>
                 <p><span class="error">* required field.</span></p>
                 <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                     Enter text to identify language: <textarea name="textLID" rows="5" cols="40"><?php echo $textLID;?></textarea>
                       
                     <span class="error">* <?php echo $textLIDErr;?></span>
                       
  
                     <input type="submit" name="submit" value="Submit">
                 </form>
             
                 <?php
                 echo "<h2>Text language: </h2>";
                 echo $textLang["lang"];
                 echo 'Hello';
                 ?>
             </td>
         </tr>
     </table>
 </body>
 </html>