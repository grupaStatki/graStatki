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
	$loginquery = 'SELECT email,password FROM usertable WHERE email=\''.$email.'\' AND password=\''.$password.'\'';
	$logindetails = $conn->query($loginquery);
	if($logindetails->num_rows > 0) {
		header( "refresh:0; url=../index.html" ); 
	} else {
		echo "<h3>Zły login lub hasło.</h3>";
		header( "refresh:2; url=../loginPage.html" ); 
	}
}

$conn->close();
?>