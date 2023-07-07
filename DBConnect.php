<?php

//helper function for connecting to the database
//**REQUIRES variable changes to connect to database being used**
function DBConnect(){
    $hostname = 'localhost';
    $username = 'root';
    $password = 'password';
    $database = 'github_repos';
    $port = 3305;

    $mysqli = new mysqli($hostname, $username, $password, $database, $port);

    if ($mysqli->connect_error) {
        die('DB Connection failed: ' . $mysqli->connect_error);
    }

    return $mysqli;
}

?>