<?php

if (!$_ENV["VCAP_SERVICES"]) {
	
    $mysql_servername = "127.0.0.1:3306";
    $mysql_username = "root";
    $mysql_password = "";
    $mysql_database = "test";
    
} else { //running in Bluemix

    $vcap_services = json_decode($_ENV["VCAP_SERVICES" ]);
    
    if ($vcap_services->{'mysql-5.5'}) {
        $db = $vcap_services->{'mysql-5.5'}[0]->credentials;
    } else if ($vcap_services->{'cleardb'}) { // if cleardb mysql db
        $db = $vcap_services->{'cleardb'}[0]->credentials;
    } else { 
        echo "MySQL database not found <br/>";
        die();
    }
    
    $mysql_database = $db->name;
    $mysql_port = $db->port;
    $mysql_servername = $db->hostname . ':' . $db->port;
    $mysql_username = $db->username; 
    $mysql_password = $db->password;
}


$mysqli = new mysqli($mysql_servername, $mysql_username, $mysql_password, $mysql_database);
if ($mysqli->connect_errno) {
    echo "Cannot connect to MySQL: (" . $mysqli->connect_errno . ") -> " . $mysqli->connect_error;
    die();
}

?>