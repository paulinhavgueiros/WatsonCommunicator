<?php include 'mysql.php';?>

<!DOCTYPE html>
<html>
<head>
    <title>Table Reset Page</title>
</head>

<?php

$textTable="DROP TABLE IF EXISTS TEXT_TABLE";
if ($mysqli->query($textTable)) {
    echo "Table deleted! <br />";
}


echo "Creating table...<br />";

$textTable = "
CREATE TABLE TEXT_TABLE (
	ID bigint(20) NOT NULL AUTO_INCREMENT,
	NAME varchar(255) DEFAULT NULL,
	ORIGINAL_TEXT varchar(255) DEFAULT NULL,
	TRANSLATED_TEXT varchar(255) DEFAULT NULL,
	TIME TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
	PRIMARY KEY (ID)
) DEFAULT CHARSET = utf8
";

if ($mysqli->query($textTable)) {
    echo "New table created! <br />";
} else {
	echo "ERROR: cannot create table. <br />"  . mysqli_error();
	die();
}


?>


<button class = "submit" onclick = "window.location = 'index.php';">Return to Communicator</button>

</html>