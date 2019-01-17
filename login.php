<?php
require_once('dbConnection.php');
require_once('functions.php');
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

<html lang="Nl">
	<body>
    <div class="flex-container ">
		<form method="POST" action="">
			<span style="color:red"><?php echo $loginErr;?></span>
			<table>
				<tr>
					<td class="item">gebruikersnaam:</td>
                    <td class="item"><input type="text" name="username" placeholder="username" /></td>
				</tr>
				<tr>
                    <td class="item">wachtwoord:</td>
                    <td class="item"><label><input type="password" name="passwd" /></label></td>
				</tr>
				<tr>
                    <td class="item"><input type="submit" name="login" value="inloggen" /></td>
                    <td class="item"></td>
				</tr>
			</table>
		</form>
    </div>
	</body>
</html>	