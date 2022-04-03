<?php
include 'DB_Connection.php';

$dbuser = "root";
$dbpass = "";

$conn = OpenConnection($dbuser, $dbpass);
CloseConnection($conn);

?>