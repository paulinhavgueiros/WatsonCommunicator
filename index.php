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
 	
     $curl = curl_init();
     
     echo 'Curl init success <br/>';
     
     $post_args = array(
         'txt' => $data,
         'sid' => 'lid-generic',
         'rt' => 'json' 
     );
     
     echo 'Post args array success <br/>';
     
     curl_setopt($curl, CURLOPT_POST, true);
     echo 'Set 1 success <br/>';
     curl_setopt($curl, CURLOPT_POSTFIELDS, $post_args);
     echo 'Set 2 success <br/>';
     curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
     echo 'Set 3 success <br/>';
     curl_setopt($curl, CURLOPT_USERPWD, "33f4756c-d320-4b45-9c1d-21fb52d56c15:p5UqhEj7gvcG");
     echo 'Set 4 success <br/>';
     curl_setopt($curl, CURLOPT_URL, "https://gateway.watsonplatform.net/language-translation/api");
     echo 'Set 5 success <br/>';
     curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
 
 	echo 'Curl sets success <br/>';
 
     $result = curl_exec($curl);
     echo "resultado:" . $result;
     
     curl_close($curl);
     
     echo 'Curl close success <br/>';
     
     $decoded = json_decode($result, true);
     echo "decoded:" . $decoded;
     
     return $decoded;
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