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
    playerID VARCHAR(100) NOT NULL,
    UNIQUE(playerID)
    )";

if ($conn->query($sql) === TRUE) {
    echo "Table created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

//tablica z pokojami gier
$sql = "CREATE TABLE gameRoom ( 
    gameID VARCHAR(100) NOT NULL,
    gamePlayerOne VARCHAR(100) NOT NULL,
    gamePlayerTwo VARCHAR(100) NOT NULL,
    UNIQUE(gameID)
    )";

if ($conn->query($sql) === TRUE) {
    echo "Table created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

//tablica z uzytkownikami
$sql = "CREATE TABLE userTable ( 
    userID INT(100) NOT NULL AUTO_INCREMENT,
    email VARCHAR(100) NOT NULL,
    password VARCHAR(100) NOT NULL,
    UNIQUE(userID)
    )";

if ($conn->query($sql) === TRUE) {
    echo "Table created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

//tablica gotowosci
$sql = "CREATE TABLE playerReady ( 
    playerID VARCHAR(100) NOT NULL,
    isReady BOOLEAN NOT NULL,
    UNIQUE(playerID)
    )";

if ($conn->query($sql) === TRUE) {
    echo "Table created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

$sql = "CREATE TABLE lastMove ( 
    gameID VARCHAR(100) NOT NULL,
    x VARCHAR(100) NOT NULL,
    y VARCHAR(100) NOT NULL,
    playerID VARCHAR(100) NOT NULL,
    UNIQUE(gameID)
    )";

if ($conn->query($sql) === TRUE) {
    echo "Table created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

$conn->close();

?>