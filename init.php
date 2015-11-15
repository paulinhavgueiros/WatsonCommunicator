<?php
$vcap_services = json_decode($_ENV["VCAP_SERVICES" ]);
$db = $vcap_services->{'mysql-5.5'}[0]->credentials;
$mysql_database = $db->name;
$mysql_port=$db->port;
//$mysql_server_name ='${db->host}:${db->port}';
$mysql_server_name =$db->host . ':' . $db->port;
$mysql_username = $db->username; 
$mysql_password = $db->password; 

$con = mysql_connect($mysql_server_name, $mysql_username, $mysql_password);
if (!$con){
    die ('connection failed' . mysql_error());
}
mysql_select_db($mysql_database,$con);   

$sqlTable="
CREATE TABLE ACCESS_HISTORY (
 ID bigint(20) NOT NULL AUTO_INCREMENT,
 TIME TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
 BROWSER varchar(64) DEFAULT NULL,
 IP_ADDRESS varchar(32) DEFAULT NULL,
 PRIMARY KEY (ID)
) ENGINE=NDB DEFAULT CHARSET=utf8
";

if(mysql_query($sqlTable))
{
echo "table created successfully!";
}
else
{
echo " ".mysql_errno()." ".mysql_error();
} 
mysql_close();
?>
