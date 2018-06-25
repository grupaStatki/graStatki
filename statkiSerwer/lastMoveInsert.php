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
$gameID = $_POST["gameID"];
$x = $_POST["x"];
$y = $_POST["y"];

$sql = 'INSERT INTO lastmove (gameID, x, y, playerID) VALUES (' . $gameID . ',' . $x . ',' . $y . ',' . $playerID . ')';

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    $sql = 'UPDATE lastmove SET x=' . $x . ', y=' . $y . ', playerID=' . $playerID .' WHERE gameID = ' . $gameID ;
    if ($conn->query($sql) === TRUE) {
        echo "Updated successfully";
    }
    else {
        echo "Error updating record: " . $conn->error;
    }
}

$conn->close();

?>