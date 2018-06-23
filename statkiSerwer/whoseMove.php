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
$sql = "SELECT playerID FROM whosemove where gameID = " . $gameID . " AND playerID = " . $playerID;
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "YES";
} else {
    echo "NO";
}
$conn->close();

?>