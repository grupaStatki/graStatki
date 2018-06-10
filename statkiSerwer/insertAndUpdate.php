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
$gameArray = $_POST["gameArray"];

$sql = 'INSERT INTO playersarrays (playerID, gameArray) VALUES ("' . $playerID . '","' . $gameArray . '")';

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    $sql = 'UPDATE playersarrays SET gameArray = "' . $gameArray . '" WHERE playerID = "' . $playerID . '"';
    if ($conn->query($sql) === TRUE) {
        echo "Updated successfully";
    }
    else {
        echo "Error updating record: " . $conn->error;
    }
}

$conn->close();

?>