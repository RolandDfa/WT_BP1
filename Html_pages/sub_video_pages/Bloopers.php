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
    <title>Video's Bloopers</title>
</head>
<body>
<?php require("../../header.php");
$Videos = GetVideos($dbh, "bloopers");
?>
<div class="content">
    <div class="content-block">
        <div class="block">
            <?php foreach($Videos as $Video) {?>
                <h3><?php echo $Video['titel'] ?></h3>
                <iframe width="300" height="300" src="https://www.youtube.com/embed/<?php echo $Video['link'];?>"
                        allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen></iframe>
            <?php } ?>
        </div>
        <?php require("../../footer.php"); ?>
    </div>
</div>
</body>
</html>