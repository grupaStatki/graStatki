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
$isReady = $_POST["isReady"];

$sql = 'INSERT INTO playerready (playerID, isReady) VALUES ('. $playerID . ',' . $isReady . ')';

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    $sql = 'UPDATE playerready SET isReady = ' . $isReady . ' WHERE playerID = ' . $playerID ;
    if ($conn->query($sql) === TRUE) {
        echo "Updated successfully";
    }
    else {
        echo "Error updating record: " . $conn->error;
    }
}

$conn->close();

?>