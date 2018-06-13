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
		echo "<h3>Błąd! Email już w bazie! Powracam do ekranu rejestracji.</h3>";
		header( "refresh:2; url=../registerPage.html" ); 
	} else {
		$query = 'INSERT INTO usertable (email,password) VALUES (\''.$email.'\',\''.$password.'\')';
		if($conn->query($query) === TRUE){
			header( "refresh:0; url=../index.html" ); 
		}
	}
}
$conn->close();
?>