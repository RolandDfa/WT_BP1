<?php
require("../../functions.php");
require('../../dbConnection.php');
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <link rel="stylesheet" type="text/css" href="../../css/style.css">
    <meta charset="utf-8" />
    <title>Video's Spelregels</title>
</head>
<body>
<?php require("../../header.php"); 
$Videos = GetVideos($dbh, "spelregels");
?>
<div class="content">
    <div class="content-block">
        <div class="block">
			<?php foreach($Videos as $Video) {?>
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