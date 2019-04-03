<?php
 
$servername = "lrgs.ftsm.ukm.my";
$username = "a161032";
$password = "largeblackdonkey";
$dbname = "a161032";

$db = mysqli_connect($servername, $username, $password, $dbname);

if ($db->connect_error) {

	die("Connection Error Message: ".$db->connect_error);
}

?>