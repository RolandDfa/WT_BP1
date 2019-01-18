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
	<!-- all the content on the top of the page -->
		<!-- block containing the main content of the page -->
		<?php require_once("../../header.php");?>
		<div class="flex-container content">
			<div class="content-block">
				<!-- the content itself -->
				<div class="block">
					<div class="login">
						<h1>Login</h1>
						<!-- login form -->
						<form method="POST" action="#">
							<span style="color:red"><?php echo $loginErr;?></span>
							<table>
								<tr>
									<td>gebruikersnaam:</td>
									<td><input type="text" name="username" placeholder="username" /></td>
								</tr>
								<tr>
									<td>wachtwoord:</td>
									<td><label><input type="password" name="passwd" /></label></td>
								</tr>
								<tr>
									<td><input type="submit" name="login" value="inloggen" /></td>
									<td></td>
								</tr>
							</table>
						</form>
					</div>
					<div class="login-help">
						<p>Wachtwoord vergeten? <a href="../../index.php">Klik hier om te resetten</a>.</p>
						<p>Bijdrage leveren? <a href="bijdrage.html">Klik hier om een bijdrage te leveren</a> </p>
					</div>
				</div>
				<?php require_once("../../footer.php");?>
			</div>
		</div>
	</body>
</html>