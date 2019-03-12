<!--
Team: Roland Huijskes en Thijs-Jan Guelen
Auteurs: Roland Huijskes en Thijs-Jan Guelen
-->

<?php
require_once('../../dbConnection.php');
require_once('../../functions.php');
ControleerLogin();
if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true) {
	
	//Haal Posts op die bij de gebruikersnaam horen
	$Posts = PostsPerGebruiker($dbh, $_SESSION['LoginName']);
	//$PostsVanGebruiker = count($Posts);
	
	if($Posts['PDORetCode'] == 1) {
		$PostsData = $Posts['data'];
		
		//GenereerForumOverzicht die ook wordt gebruikt op de forum overzicht pagina
		$PostsVanGebruiker = '<table><thead><tr class="table-header"><td>Naam</td><td>Datum</td><td>Post bewerken</td><td>Post verwijderen</td></tr></thead><tbody>';
		$PostsVanGebruiker = $PostsVanGebruiker.GenereerForumOverzicht($PostsData, true)."</tbody></table>";
	} else {
		$PostsVanGebruiker = '<h2 style="color: red">Er ging iets fout met het ophalen van uw posts. Probeer het later opnieuw.</h2>';
	}
	
	require_once("bezoekerIngelogd.php");
} else {
	//echo "kk";

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
}
?>