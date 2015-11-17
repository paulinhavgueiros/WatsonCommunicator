<!--
/**
* Copyright 2015 IBM Corp. All Rights Reserved.
*
* Licensed under the Apache License, Version 2.0 (the “License”);
* you may not use this file except in compliance with the License.
* You may obtain a copy of the License at
*
* https://www.apache.org/licenses/LICENSE-2.0
*
* Unless required by applicable law or agreed to in writing, software
* distributed under the License is distributed on an “AS IS” BASIS,
* WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
* See the License for the specific language governing permissions and
* limitations under the License.
*/
-->

<?php include 'db.php';?>
<!DOCTYPE html>
<html>
<head>
    <title>Creating new Table</title>
    <link rel="stylesheet" href="style.css" />
</head>

<?php

$sqlTable="DROP TABLE IF EXISTS TEXT_TABLE";
if ($mysqli->query($sqlTable)) {
    echo "Table deleted! <br>";
} else {
	//echo "Cannot drop table. "  . mysqli_error();
}


echo "Creating table...<br />";
$sqlTable="
CREATE TABLE TEXT_TABLE (
 ID bigint(20) NOT NULL AUTO_INCREMENT,
 NAME varchar(255) DEFAULT NULL,
 ORIGINAL_TEXT varchar(255) DEFAULT NULL,
 TRANSLATED_TEXT varchar(255) DEFAULT NULL,
 TIME TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
 PRIMARY KEY (ID)
) DEFAULT CHARSET=utf8
";

if ($mysqli->query($sqlTable)) {
    echo "Table created successfully!<br>";
} else {
	echo "ERROR: Cannot create table. "  . mysqli_error();
	die();
}


?>


<button class = "mybutton" onclick="window.location = 'index.php';">Back</button>

</html>