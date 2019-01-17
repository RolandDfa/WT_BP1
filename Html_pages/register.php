<?php
require_once ('../functions.php');
require_once ('../dbConnection.php');

CheckSession();
$FirstName = $LastName = $Username = $Password = $RetypePassword = NULL;

$FnameErr = $LnameErr = $UserErr = $PassErr = $RePassErr = NULL;
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

//controleer het voornaam veld
    if(empty($FirstName))
    {
        $FnameErr = "Voornaam veld is vereist";
        $CheckOnErrors = true;
    }
    elseif(!is_Char_Only($FirstName) || !is_minlength($FirstName, 2))
    {
        $FnameErr = "Mag alleen uit karakters bestaan en is minimaal 2 karakters lang";
        $CheckOnErrors = true;
    }
    if(empty($LastName))
    {
        $LnameErr = "Voornaam veld is vereist";
        $CheckOnErrors = true;
    }
    elseif(!is_Char_Only($LastName) || !is_minlength($LastName, 2))
    {
        $LnameErr = "Mag alleen uit karakters bestaan en is minimaal 2 karakters lang";
        $CheckOnErrors = true;
    }
    if(empty($Username))
    {
        $UserErr = "Username veld is vereist";
        $CheckOnErrors = true;
    }
    elseif(!is_Char_Only($Username) || !is_minlength($Username, 2))
    {
        $UserErr = "Mag alleen uit karakters bestaan en is minimaal 2 karakters lang";
        $CheckOnErrors = true;
    }
    elseif(!is_Username_Unique($Username, $dbh))
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
	$Password = HashPassword($Password, $Username);

    }
}

?>


<!DOCTYPE html>

<html lang="nl-NL" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <!-- include style sheet -->
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <!-- set charset to UTF 8 -->
    <meta charset="utf-8" />
    <!-- set title to home -->
    <title>Bezoeker</title>
</head>
<body>
<?php require_once( '../header.php') ?>
    <!-- block containing the main content of the page -->
    <div class="content small-content round-edge">
        <div class="content-block">
            <!-- the content itself -->
            <div class="block">
                <h1>Registreren</h1>
                <p>Vul dit formulier in om een account aan te maken</p>
            </div>
            <div class="block round-edge">
                <div class="register">
                    <form method="POST" action="#">

                        <div class="container">

                            <span style="color:red"><?php echo $UserErr; ?></span>
                            <p><b>Gebruikersnaam</b></p>
                            <input type="text" placeholder="Voer gebruikersnaam in" name="username" required><br/>
                            <span style="color:red"><?php echo $Password; ?></span>
                           <p><b>Wachtwoord</b></p>
                            <input type="password" placeholder="Voer wachtwoord in" name="psw" required><br/>
                            <span style="color:red"><?php echo $RePassErr; ?></span>
                            <p><b>Herhaal wachtwoord</b></p>
                            <input type="password" placeholder="Herhaal wachtwoord" name="psw-repeat" required>
                            <hr>
                            <span style="color:red"><?php echo $FnameErr; ?></span>
                            <p><b>Voornaam</b></p>
                            <input type="text" placeholder="Voornaam" name="firstname" required>
                            <hr>
                            <span style="color:red"><?php echo $LnameErr; ?></span>
                            <p><b>Achternaam</b></p>
                            <input type="text" placeholder="Achternaam" name="lastname" required>
                            <hr>
                            <p>Met het aanmaken van een account, gaat u akkoord met onze voorwaarden <a href="#">Terms & Privacy</a>.</p>

                            <button type="submit" name="registerbtn" class="registerbtn">Register</button>
                        </div>

                        <div class="container signin">
                            <p>Al in het bezit van een account? <a href="Bezoeker.php">Login</a>.</p>
                        </div>
                    </form>
                </div>

                <div class="login-help">
                    <p>Wachtwoord vergeten? <a href="../index.php">Klik hier om te resetten</a>.</p>
                    <p>Bijdrage leveren? <a href="bijdrage.html">Klik hier om een bijdrage te leveren</a> </p>
                </div>
            </div>
            <footer>
                <p><strong>&#169; 2018 - Roland Huijskes, Thijs-Jan Guelen</strong></p>
                <p>Thema: voetbal</p>
                <p><strong>Contact information: <a href="mailto:someone@example.com">
                    someone@example.com</a>.</strong></p>
            </footer>
        </div>
    </div>

</body>
</html>
<?php

?>