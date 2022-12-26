<?php
// define('DB_SERVER', 'localhost');
// define('DB_USERNAME', 'root');
// define('DB_PASSWORD', 'root');
// define('DB_NAME', 'db');

/* Attempt to connect to MySQL database */
// $mysqli = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
$mysqli = mysqli_connect("localhost", "root", "root", "db") or die($mysqli_error($mysqli));
// echo $mysqli;
// if ($mysqli) {
//     echo "success";
// }

// Check connection
if($mysqli === false){
    die("ERROR: Could not connect. " . $mysqli->connect_error);
}
?>
