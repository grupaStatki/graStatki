<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Game</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
	
    <!-- Bootstrap core JavaScript -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
		

    <!-- Custom styles -->
    <link href="css/loginPage.css" rel="stylesheet">
	
	<script>
	var wrongCombination = function() {
		wrongCombinationBox.innerHTML = "<h5><font color=\"white\">Niepoprawna kombinacja loginu i hasła. Spróbuj ponownie!</font></h5>";
	}
	</script>
  </head>

  <body>

	<div id="fullscreen_bg" class="fullscreen_bg"/>

		<div class="container">

			<form class="form-signin" action="loginPage.php" method="post">
				<h1 class="form-signin-heading">Statki</h1>
				<input type="email" class="form-control" placeholder="Adres email" required="" autofocus="" name="email">
				<input type="password" class="form-control" placeholder="Hasło" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Musi zawierać przynajmniej jedną cyfrę, jedną małą literę, jedną dużą literę, łącznie przynajmniej 8 znaków" required="">
				<button class="btn btn-lg btn-success btn-block" type="submit" name="submit" id="submit">
					Zaloguj się
				</button>
				<button class="btn btn-basic btn-block" type="button" onclick="window.location.href='registerPage.php'">
					Zarejestruj się
				</button>
				<div class="form-wrong-combination-message" id="wrongCombinationBox"> </div>
			</form>
			

		</div>
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
				header( "refresh:0; url=index.html" ); 
			} else {
				echo '<script type="text/javascript">','wrongCombination();','</script>';
			}
		}

		$conn->close();
		?>
  </body>
</html>
