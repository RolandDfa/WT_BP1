<?php
require_once("../../functions.php");
require_once('../../dbConnection.php');
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
<?php require_once("../../header.php"); 
$Videos = GetVideos($dbh, "bloopers");
?>
<div class="forum-content">
    
    <div class="content-block">
	<?php foreach($Videos as $Video) {?>
        <div class="forum-block forum-topic-title">
            <div class="forum-block-inner-top">

                <h2><?php echo $Video['titel'];?></h2>
                <div class="forumpost-meta">
                    <iframe width="300" height="300" src="https://www.youtube.com/embed/<?php echo $Video['link'];?>"
                    allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen>
                    </iframe>
                </div>
                <p><?php echo $Video['samenvatting']; ?></p>
				<hr>
				<p class="forum-small forum-time"><?php echo gmdate("Y-m-d\ H:i:s", $Video['gepubliceerd']);?></p>
                <br>
            </div>
        </div>
		<?php } 
		require_once("../../footer.php"); ?>
	</div>
</div>
</body>
</html>