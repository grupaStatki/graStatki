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

if(isset($_POST['submit']))
{
	$email = $_POST['email'];
	$password = $_POST['password'];
	$query = "insert into usertable (userID,email,password) values ('','$pass','$emailid')";
	if(mysql_query($query)){
		echo "<h3>You have registered!</h3>";
	}
}
$conn->close();
?>