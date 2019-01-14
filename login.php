<?php
require('dbConnection.php');
require('functions.php');
CheckSession();

if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true) {
	header('Location: ../');
}

$loginErr = "";

if(isset($_POST['login'])) {
	$username = isset($_POST['username']) ? $_POST['username'] : '';
	$passwd = isset($_POST['passwd']) ? $_POST['passwd'] : '';
	
	//hash het wachtwoord
	$passwd = hash('sha384', $passwd); 
	
	$loginReturn = CheckLogin($dbh, $username, $passwd);
	if($loginReturn['code'] == 0) {
		$loginErr = "Foutieve inloggegevens";
	} else if($loginReturn['code'] == 1) {
		$_SESSION['loggedIn'] = true;
		$_SESSION['LoginName'] = $username;
		$_SESSION['name'] = $loginReturn['name'];
		header('Location: ../');
	} else {
		$loginErr = "Onbekende fout";
	}
}


?>

<html>
	<body>
		<form method="POST" action="">
			<span style="color:red"><?php echo $loginErr;?></span>
			<table>
				<tr>
					<td>gebruikersnaam:</td>
					<td><input type="text" name="username" placeholder="username" /></td>
				</tr>
				<tr>
					<td>wachtwoord:</td>
					<td><input type="password" name="passwd" /></td>
				</tr>
				<tr>
					<td><input type="submit" name="login" value="inloggen" /></td>
					<td></td>
				</tr>
			</table>
		</form>
	</body>
</html>	