<?php
    $dbhost = "localhost";
    $dbuser = "root";
    $dbpass = "";
    $dbname = "bdm_system";

$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

if(!$conn){
    echo "Connected";
}

?>