<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "statki";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

if(isset($_POST['submit']))
{
	$email = $_POST['email'];
	$password = $_POST['password'];
	$querymails = 'SELECT email FROM usertable WHERE email=\''.$email.'\'';
	$mails = $conn->query($querymails);
	if($mails->num_rows > 0){
		echo "Błąd! Email już w bazie!";
	} else {
		$query = 'INSERT INTO usertable (email,password) VALUES (\''.$email.'\',\''.$password.'\')';
		if($conn->query($query) === TRUE){
			echo "Rejestracja udana!";
		}
	}
}
$conn->close();
?>