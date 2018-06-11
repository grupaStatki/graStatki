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
$sql = 'DELETE FROM waitingroom WHERE playerID = ' . $playerID ;

if ($conn->query($sql) === TRUE) {
    echo "Deleted successfully";
} else {
    echo "Error deleting record: " . $conn->error;
}

$conn->close();

?>