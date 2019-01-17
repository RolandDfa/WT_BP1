<?php
require_once('../dbConnection.php');
require_once('../functions.php');
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
        <div class="flex-container content">
            <div class="content-block">
                <!-- the content itself -->
                <div class="block">
                    <div class="login">
                        <h1>Login</h1>
                        <!-- login form -->
                        <form method="POST" action="">
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