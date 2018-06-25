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
$sql = "SELECT gameID FROM gameroom WHERE gamePlayerOne = " . $playerID . " OR gamePlayerTwo = " . $playerID;
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc(); 
    echo $row["gameID"];
}
else {

    $sql = "SELECT playerID FROM waitingroom";
    $result = $conn->query($sql);

    if ($result->num_rows > 1) {
        // output data of each row
        $row = $result->fetch_assoc();
        $playerOne = $row["playerID"];
        $row = $result->fetch_assoc();
        $playerTwo = $row["playerID"];

        $gameID = $playerOne . "#And#" . $playerTwo;

        $sql = 'INSERT INTO gameroom (gameID, gamePlayerOne, gamePlayerTwo) VALUES ("' . $gameID . '","' . $playerOne . '","' . $playerTwo . '")';

        if ($conn->query($sql) === TRUE) {
            echo "OK";
        } else {
            echo "Error updating record: " . $conn->error;
        }

        $sql = 'INSERT INTO whosemove (gameID, playerID) VALUES ("' . $gameID . '","' . $playerOne . '")';

        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            $sql = 'UPDATE whosemove SET playerID = "' . $playerOne . '" WHERE gameID = "' . $gameID . "'";
            if ($conn->query($sql) === TRUE) {
                echo "Updated successfully";
            }
            else {
                echo "Error updating record: " . $conn->error;
            }
        }
        
        
    } else {
        echo "NOT";
    }
}
$conn->close();

?>