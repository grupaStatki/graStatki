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
	<script>
	var check = function() {
	  if (document.getElementById('password').value ==
		document.getElementById('confirm_password').value) {
		document.getElementById('message').style.color = 'green';
		document.getElementById('message').innerHTML = 'Hasła zgadzają się';
		document.getElementById('submit').disabled = false;
	  } else {
		document.getElementById('message').style.color = 'red';
		document.getElementById('message').innerHTML = 'Hasła nie zgadzają się';
		document.getElementById('submit').disabled = true;
	  }
	}
	
	var emailExists = function() {
		emailExistsBox.innerHTML = "<h5><font color=\"white\">Email istnieje już w bazie. Spróbuj ponownie z nowym adresem email.</font></h5>";
	}
	</script>
		

    <!-- Custom styles -->
    <link href="css/loginPage.css" rel="stylesheet">
	
  </head>

  <body>

	<div id="fullscreen_bg" class="fullscreen_bg"/>

		<div class="container">

			<form class="form-signin" action="registerPage.php" method="post">
				<h1 class="form-signin-heading">Statki</h1>
				<input type="email" class="form-control" name="email" placeholder="Adres email" required="" autofocus="">
				<input type="password" id="password" class="form-control" name="password" placeholder="Hasło" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Musi zawierać przynajmniej jedną cyfrę, jedną małą literę, jedną dużą literę, łącznie przynajmniej 8 znaków" required="" onkeyup='check();'>
				<input type="password" id="confirm_password" class="form-control" name="confirm_password" placeholder="Powtórz hasło" onkeyup='check();' />
				<span class="badge badge-light" id='message'></span>
				<button class="btn btn-lg btn-success btn-block" type="submit" name="submit" id="submit">
					Zarejestruj sie
				</button>
				<div id="emailExistsBox"></div>
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
			$querymails = 'SELECT email FROM usertable WHERE email=\''.$email.'\'';
			$mails = $conn->query($querymails);
			if($mails->num_rows > 0){
				echo '<script type="text/javascript">','emailExists();','</script>';
			} else {
				$query = 'INSERT INTO usertable (email,password) VALUES (\''.$email.'\',\''.$password.'\')';
				if($conn->query($query) === TRUE){
					header( "refresh:0; url=index.html" ); 
				}
			}
		}
		$conn->close();
		?>
  </body>
</html>
