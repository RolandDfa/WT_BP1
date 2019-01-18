<?php
require_once ('../../functions.php');
require_once ('../../dbConnection.php');

ControleerLogin();
$FirstName = $LastName = $Username = $Password = $RetypePassword = $GeneralErr = $Success = "";

$FnameErr = $LnameErr = $UserErr = $PassErr = $RePassErr = "";
$CheckOnErrors = true;
if(isset($_POST['registerbtn']))
{
    $CheckOnErrors = false;
    $FirstName = $_POST["firstname"];
    $LastName = $_POST["lastname"];
    $Username = $_POST["username"];
    $Password = $_POST["psw"];
    $RetypePassword = $_POST["psw-repeat"];
	
	$_POST['psw'] = $_POST['psw-repeat'] = NULL;
	
	$UniqueName = IsGebruikersnaamUniek($Username, $dbh);
	if($UniqueName['PDORetCode'] == 0) {
		$CheckOnErrors = true;
		$GeneralErr = "Er trad een onbekende fout op. Probeer het later opnieuw.";
		$UniqueName = false;
	} else {
		$UniqueName = $UniqueName['unused'];
	}
		

//controleer het voornaam veld
    if(empty($FirstName))
    {
        $FnameErr = "Voornaam veld is vereist";
        $CheckOnErrors = true;
    }
    elseif(!IsAlleenKarakters($FirstName) || !IsMinimumLengte($FirstName, 2))
    {
        $FnameErr = "Mag alleen uit karakters bestaan en is minimaal 2 karakters lang";
        $CheckOnErrors = true;
    }
    if(empty($LastName))
    {
        $LnameErr = "Voornaam veld is vereist";
        $CheckOnErrors = true;
    }
    elseif(!IsAlleenKarakters($LastName) || !IsMinimumLengte($LastName, 2))
    {
        $LnameErr = "Mag alleen uit karakters bestaan en is minimaal 2 karakters lang";
        $CheckOnErrors = true;
    }
    if(empty($Username))
    {
        $UserErr = "Username veld is vereist";
        $CheckOnErrors = true;
    }
    elseif(!IsAlleenKarakters($Username) || !IsMinimumLengte($Username, 2))
    {
        $UserErr = "Mag alleen uit karakters bestaan en is minimaal 2 karakters lang";
        $CheckOnErrors = true;
    }
    elseif(!$UniqueName)
    {
		
        $UserErr = "deze Username bestaat al, kies een andere";
        $CheckOnErrors = true;
    }
    if(empty($Password))
    {
        $PassErr = "het wachtwoord moet minstens uit 6 tekens bestaan";
        $CheckOnErrors = true;
    }

    //controleer het retype paswoord veld
    if(empty($RetypePassword))
    {
        $RePassErr = "Dit veld is vereist";
        $CheckOnErrors = true;
    }
    elseif($Password !=$RetypePassword)
    {
        $RePassErr = "De 2 wachtwoordvelden komen niet met elkaar overeen";
        $CheckOnErrors = true;
    }
    if($CheckOnErrors == false)
    {
		$Password = GenereerWachtwoord($Password, $Username);
		$UserSaved = RegistreerGebruiker($dbh, $Username, $Password, $FirstName, $LastName);
		if($UserSaved == 1) {
			$Success = 'Je account is succesvol aangemaakt. Klik op "login" om in te loggen';
		} else {
			$GeneralErr = "Er trad een onbekende fout op. Probeer het later opnieuw.";
		}
    }
}
require_once("registerForm.php");
?>