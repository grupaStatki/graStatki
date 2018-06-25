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
$sql = "SELECT x, y FROM lastmove WHERE gameID=" . $gameID . " AND playerID!=" . $playerID;
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $x = $row["x"];
        $y = $row["y"];

        echo $x . "#" . $y;
    }
}
else {
    echo "NOT";
}
$conn->close();
?>