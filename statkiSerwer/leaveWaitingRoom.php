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
$sql = 'DELETE FROM waitingroom WHERE playerID = ' . $playerID ;

if ($conn->query($sql) === TRUE) {
    echo "Deleted successfully";
} else {
    echo "Error deleting record: " . $conn->error;
}

$sql = 'DELETE FROM gameroom WHERE gamePlayerOne = ' . $playerID . ' OR gamePlayerTwo = ' . $playerID;

if ($conn->query($sql) === TRUE) {
    echo "Deleted successfully";
} else {
    echo "Error deleting record: " . $conn->error;
}

$sql = 'DELETE FROM whosemove WHERE gameID = ' . $gameID;

if ($conn->query($sql) === TRUE) {
    echo "Deleted successfully";
} else {
    echo "Error deleting record: " . $conn->error;
}

$sql = 'DELETE FROM lastmove WHERE gameID = ' . $gameID;

if ($conn->query($sql) === TRUE) {
    echo "Deleted successfully";
} else {
    echo "Error deleting record: " . $conn->error;
}

$conn->close();

?>