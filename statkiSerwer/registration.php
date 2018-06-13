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

if(isset($_POST['submit']))
{
	$email = $_POST['email'];
	$password = $_POST['password'];
	echo $query = 'INSERT INTO usertable (email,password) VALUES (\''.$email.'\',\''.$password.'\')';
	if($conn->query($query) === FALSE){
		echo $conn->error;
	}
}
$conn->close();
?>