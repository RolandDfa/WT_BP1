<?php
require ('../functions.php');
require ('../dbConnection.php');

CheckSession();
$UserErr = "";

if(isset($_POST['registerbtn']))
{
    $CheckOnErrors = false;
    $FirstName = $_POST["firstname"];
    $LastName = $_POST["lastname"];
    $username = $_POST["username"];
    $Password = $_POST["psw"];
    $RetypePassword = $_POST["psw-repeat"];

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
    if(empty($username))
    {
        $UserErr = "Username veld is vereist";
        $CheckOnErrors = true;
    }
    elseif(!is_Char_Only($username) || !is_minlength($username, 2))
    {
        $UserErr = "Mag alleen uit karakters bestaan en is minimaal 2 karakters lang";
        $CheckOnErrors = true;
    }
    elseif(!is_Username_Unique($username, $dbh))
    {
        $UserErr = "deze Username bestaat al, kies een andere";
        $CheckOnErrors = true;
    }
    $Password = hash('sha384', $Password);
    $parameters = array(':Name'=>$FirstName. ' ' . $LastName,
        ':Username'=>$username,
        ':Password'=>$Password);


    $sth = $dbh->prepare('INSERT INTO bezoekers(login, naam, wachtwoord) VALUES
(:Username, :Name, :Password)');

    $sth->execute($parameters);

    echo "U heeft zich succesvol geregistreerd.";
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
<!-- all the content on the top of the page -->
<div class="header">
    <!-- blocks containing the title and logo -->
    <div class="menu-block">
        <div class="site-header">
            <a href="../index.php">
                <img class="header-img" src="../images/Soccerball.svg" alt="voetbal_logo" /></a>
            <div class="site-header-block">
                <h1 class="site-title">Füssball Inside Nimma</h1>
            </div>
        </div>
        <!-- block containing the menu -->
        <div class="navbar">
            <a class="menu-item" href="../index.php">Home</a>
            <div class="dropdown">
                <button class="dropbtn">Video's
                    <i class="fa fa-caret-down"></i>
                </button>
                <div class="dropdown-content">
                    <a class="menu-item" href="sub_video_pages/spelregels.php">Spelregels</a>
                    <a class="menu-item" href="sub_video_pages/tactiek.php">Tactiek</a>
                    <a class="menu-item" href="sub_video_pages/Bloopers.php">Bloopers</a>
                </div>
            </div>
            <div class="dropdown">
                <button class="dropbtn">Forum
                    <i class="fa fa-caret-down"></i>
                </button>
                <div class="dropdown-content">
                    <a class="menu-item" href="sub_forum_pages/algemeen.php">Algemeen</a>
                    <a class="menu-item" href="sub_forum_pages/wedstrijden.php">Wedstrijden</a>
                    <a class="menu-item" href="sub_forum_pages/onzin_forum.php">Onzin</a>
                </div>
            </div>
            <a class="menu-item" href="over_ons.php">Over ons</a>
            <a class="menu-item menu-right" href="register.php">Bezoeker</a>
        </div>
    </div>
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
                    <form method="POST" action="">
                        <span style="color:red"><?php echo $UserErr;?></span>
                        <div class="container">
                            <p><b>Gebruikersnaam</b></p>
                            <input type="text" placeholder="Voer gebruikersnaam in" name="username" required><br/>

                           <p><b>Wachtwoord</b></p>
                            <input type="password" placeholder="Voer wachtwoord in" name="psw" required><br/>

                            <p><b>Herhaal wachtwoord</b></p>
                            <input type="password" placeholder="Herhaal wachtwoord" name="psw-repeat" required>
                            <hr>
                            <p><b>Voornaam</b></p>
                            <input type="text" placeholder="Voornaam" name="firstname" required>
                            <hr>
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
</div>
</body>
</html>
<?php

?>