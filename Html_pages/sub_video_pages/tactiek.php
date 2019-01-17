<?php
require("../../functions.php");
require('../../dbConnection.php');
CheckSession();
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <link rel="stylesheet" type="text/css" href="../../css/style.css">
    <meta charset="utf-8" />
    <title>Video's Tactiek</title>
</head>
<body>
<?php require("../../header.php"); ?>
<div class="content">
    <div class="content-block">
        <div class="block">
                <iframe width="300" height="300" src="https://www.youtube.com/embed/IY2WtBSwwKM"
                    allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            <iframe width="300" height="300" src="https://www.youtube.com/embed/OIjsUVKx7tA"
                    allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            <iframe width="300" height="300" src="https://www.youtube.com/embed/VXpdYD0ZQz0"
                    allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            <iframe width="300" height="300" src="https://www.youtube.com/embed/3t1Q3_GyJtY"
                    allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
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