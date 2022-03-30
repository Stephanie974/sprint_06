<?php

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'steph');
define('DB_PASSWORD', 'steph');
define('DB_NAME', 'Vap Factory');
 
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>