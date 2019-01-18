<!DOCTYPE html>
<html lang="nl-NL" xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<!-- include style sheet -->
		<link rel="stylesheet" type="text/css" href="../../css/style.css">
		<!-- set charset to UTF 8 -->
		<meta charset="utf-8" />
		<!-- set title to home -->
		<title>Bezoeker</title>
	</head>
	<body>
	<?php require_once( '../../header.php') ?>
		<!-- block containing the main content of the page -->
		<div class="content small-content round-edge">
			<div class="content-block">
				<!-- the content itself -->
				<div class="block">
					<h1>Registreren</h1>
					<p>Vul dit formulier in om een account aan te maken</p>
					<span style="color:red"><?php echo $GeneralErr; ?></span>
					<span style="color:green"><?php echo $Success; ?></span>
				</div>
				<div class="block round-edge">
					<div class="register">
						<form method="POST" action="./register.php">
							<div class="container">
								<span style="color:red"><?php echo $UserErr; ?></span>
								<p><b>Gebruikersnaam</b></p>
								<input type="text" placeholder="Voer gebruikersnaam in" name="username" value="<?php echo $Username;?>" required><br/>
								<span style="color:red"><?php echo $PassErr; ?></span>
							   <p><b>Wachtwoord</b></p>
								<input type="password" placeholder="Voer wachtwoord in" name="psw" required><br/>
								<span style="color:red"><?php echo $RePassErr; ?></span>
								<p><b>Herhaal wachtwoord</b></p>
								<input type="password" placeholder="Herhaal wachtwoord" name="psw-repeat" required>
								<hr>
								<span style="color:red"><?php echo $FnameErr; ?></span>
								<p><b>Voornaam</b></p>
								<input type="text" placeholder="Voornaam" name="firstname" value="<?php echo$FirstName;?>" required>
								<hr>
								<span style="color:red"><?php echo $LnameErr; ?></span>
								<p><b>Achternaam</b></p>
								<input type="text" placeholder="Achternaam" name="lastname" value="<?php echo $LastName;?>" required>
								<hr>
								<p>Met het aanmaken van een account, gaat u akkoord met onze voorwaarden <a href="#">Terms & Privacy</a>.</p>

								<button type="submit" name="registerbtn" class="registerbtn">Register</button>
							</div>

							<div class="container signin">
								<p>Al in het bezit van een account? <a href="../Bezoeker">Login</a>.</p>
							</div>
						</form>
					</div>

					<div class="login-help">
						<p>Wachtwoord vergeten? <a href="../../index.php">Klik hier om te resetten</a>.</p>
						<p>Bijdrage leveren? <a href="../bijdrage.html">Klik hier om een bijdrage te leveren</a> </p>
					</div>
				</div>
				<?php require_once("../../footer.php"); ?>
			</div>
		</div>
	</body>
</html>