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