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
$isReadyOne = 0;
$isReadyTwo = 0;
$sql = "SELECT gamePlayerOne, gamePlayerTwo FROM gameroom";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $gamePlayerOne = $row["gamePlayerOne"];
        $gamePlayerTwo = $row["gamePlayerTwo"];

        $sql = "SELECT isReady FROM playerready where playerID = '" . $gamePlayerOne . "'";
        $result2 = $conn->query($sql);
        if ($result2->num_rows > 0) {
            while($row = $result2->fetch_assoc()) {
                $isReadyOne = $row["isReady"];
            }
        }

        $sql = "SELECT isReady FROM playerready where playerID = '" . $gamePlayerTwo . "'";
        $result2 = $conn->query($sql);
        if ($result2->num_rows > 0) {
            while($row = $result2->fetch_assoc()) {
                $isReadyTwo = $row["isReady"];
            }
        }

        if($isReadyOne == 1 && $isReadyTwo == 1){

            $sql = "SELECT playerID FROM whosemove where gameID = " . $gameID . " AND playerID = " . $playerID;
            $result2 = $conn->query($sql);

            if ($result2->num_rows > 0) {
                echo "YES";
            }
            else {
                echo "NO";
            }

        }
        else {
            echo "NOT";
        }

    }
    
}
$conn->close();

?>