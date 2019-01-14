<!DOCTYPE html>
<?phprequire("../../functions.php");
require('../../dbConnection.php');
?>
<html lang="nl" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <meta charset="utf-8" />
    <title>Over ons</title>
</head>
<body>
<?php require('../header.php'); ?>
<div class="content">
    <div class="content-block">
        <div class="block">
            <h1>Over ons</h1>
            <h2>Wie zijn wij?</h2>
            <div class="over_ons">
                <h3>Thijs-Jan</h3>
                <img class="about-img" src="../images/thijs.jpg" alt="Thijs" />
                <p>Vlotte ADHD'er die ook van programmeren houd</p>
                <p>ik heb aan de volgende projecten gewerkt:</p>
                <ol>
                    <li>VR Schietspel</li>
                    <li>2D racegame</li>
                    <li>App voor lokale omroep</li>
                </ol>
            </div>
            <div class="over_ons">
               <h3>Roland</h3>
                <img class="about-img" src="../images/about_us_images/image_roland.jpeg" alt="rland"/>
                <p>Wielrennende programmeur, gericht op C# en C++.</p>
                <p>Heeft aan verscheidende projecten gewerkt</p>
                <ol>
                    <li>ChessGame</li>
                    <li>ConcremoteDeviceManagment</li>
                    <li>Tools4Ever</li>
                    <li>2D racegame</li>
                    <li>VR Schietspel</li>
                </ol>
                <br />
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