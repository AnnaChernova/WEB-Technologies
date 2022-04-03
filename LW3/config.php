<?php

const DB_SERVER = 'localhost';
const DB_USERNAME = 'root';
const DB_PASSWORD = '';
const DB_NAME = 'thehotel';

// Attempt to connect to MySQL database.
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Check connection.
if($link === false){
    echo "Connection error.";
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

//echo "Connected.";
?>