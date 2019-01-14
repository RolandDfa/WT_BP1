<?php
require('dbConnection.php');
require('functions.php');

CheckSession();
?>

<!DOCTYPE html>

<html lang="nl" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <!-- include style sheet -->
    <link rel="stylesheet" type="text/css" href="./css/style.css">
    <!-- set charset to UTF 8 -->
    <meta charset="utf-8" />
    <!-- set title to home -->
    <title>Home</title>
</head>
    <body>
        <!-- all the content on the top of the page -->
        <?php require('header.php'); ?>
        <!-- block containing the main content of the page -->
        <div class="content">
            <div class="content-block">
                <!-- the content itself -->
                <div class="block">
                    <h2>Welkom op onze site!</h2>
                    <p>Welkom op de website van Füssball inside Nijmegen!<br /><br />
                    Op deze site vind je verschillende video's over bijvoorbeeld tactieken en spelregels, maar ook leuke bloopers!<br /><br />
                        Ook hebben we een community forum. Momenteel hebben we drie categorieën:</p>
                    <ul>
                        <li>Algemeen - Alle algemene voetbalzaken kunnen hier besproken worden</li>
                        <li>Wedstrijden - Hier kunnen wedstrijden, zowel lokaal als landelijk als internationaal besproken worden. Houd het wel netjes!</li>
                        <li>Onzin - Hier kunnen alle zaken besproken worden die niet aan voetbal gerelateerd zijn</li>
                    </ul>
                </div>
                <footer>
                    <p><strong>&#169; 2018 - Roland Huijskes, Thijs-Jan Guelen</strong></p>
                    <p><strong>Contact information: <a href="mailto:someone@example.com">
                        someone@example.com</a>.</strong></p>
                </footer>
            </div>

        </div>
    </body>

</html>