<?php
//NEED TO ADD ERROR HANDLING FOR TIMEOUT
$servername = "mystudycards-rds.cynvn0t6wo7y.us-west-1.rds.amazonaws.com";
$username = "mystudycards_rds";
$password = "Xx918e#2";
$dbname = "mystudycards_schema";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
//$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
