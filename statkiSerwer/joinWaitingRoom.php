<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "statki";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$playerID = $_POST["playerID"];

$sql = 'INSERT INTO waitingroom (playerID) VALUES (' . $playerID . ')';

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error updating record: " . $conn->error;
}

$conn->close();

?>