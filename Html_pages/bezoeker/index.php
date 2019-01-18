<?php
require_once('../../dbConnection.php');
require_once('../../functions.php');
ControleerLogin();
if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true) {
	header('Location: ../../');
}

$loginErr = "";

if(isset($_POST['login'])) {
	$username = isset($_POST['username']) ? $_POST['username'] : '';
	$passwd = isset($_POST['passwd']) ? $_POST['passwd'] : '';

	//hash het wachtwoord
	$passwd = GenereerWachtwoord($passwd, $username);

	$loginReturn = ControleerLoginData($dbh, $username, $passwd);
	if($loginReturn['code'] == 0) {
		$loginErr = "Foutieve inloggegevens";
	} else if($loginReturn['code'] == 1) {
		$_SESSION['loggedIn'] = true;
		$_SESSION['LoginName'] = $username;
		$_SESSION['name'] = $loginReturn['name'];
		header('Location: ../../');
	} else {
		$loginErr = "Onbekende fout";
	}
}

require_once("bezoekerForm.php");
?>