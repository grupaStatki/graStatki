<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "statki";
// Create connection
$conn = new mysqli($servername, $username, $password);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

// Create database
$sql = "CREATE DATABASE statki";
if ($conn->query($sql) === TRUE) {
    echo "Database created successfully";
} else {
    echo "Error creating database: " . $conn->error;
}
$conn->close();

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

//tabela z tablicą statków danego gracza
$sql = "CREATE TABLE playersArrays ( 
PlayerID VARCHAR(100) NOT NULL,
gameArray VARCHAR(500) NOT NULL,
UNIQUE(PlayerID)
)";

if ($conn->query($sql) === TRUE) {
    echo "Table created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

//tablica przechowywująca czyj ruch
$sql = "CREATE TABLE whoseMove ( 
    gameID VARCHAR(100) NOT NULL,
    playerID VARCHAR(100) NOT NULL,
    UNIQUE(gameID)
    )";

if ($conn->query($sql) === TRUE) {
    echo "Table created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

//tablica oczekiwania na przeciwnika
$sql = "CREATE TABLE waitingRoom ( 
    player VARCHAR(100) NOT NULL,
    playerID VARCHAR(100) NOT NULL,
    PRIMARY KEY (playerID),
    )";

if ($conn->query($sql) === TRUE) {
    echo "Table created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

$conn->close();

?>