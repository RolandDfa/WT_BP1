<?php
require_once("functions.php");
require_once('dbConnection.php');
if(!empty($_GET['q'])) {
	$q = $_GET['q'];
} else {
	header('Location: ../');
	exit;
}
$Results = ZoekWebsite($dbh, $q);
$Continue = false;
$ErrMsg = "";
if($Results["PDORetCode"] == 1) {
	$Results = $Results['data'];
	$Continue = true;
} else {
	$Continue = false;
	$ErrMsg = "<h2>Er ging iets fout met zoeken. Probeer het later opnieuw.</h2>";
}


ControleerLogin();
?>
<!DOCTYPE html>

<html lang="nl" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title>Rubriek <?php echo $cat; ?></title>
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body>
<?php require_once('header.php');?>
<div class="forum-content">


		<?php 
		echo $ErrMsg;
		?>
		<h2>Zoekresultaten forum:</h2>
			<?php foreach($Results['ForumData'] as $Result) {?>
			<div class="forum-block forum-topic-title">
				<div class="forum-block-inner-top">
					<h2><?php echo $Result['kopje'];?></h2>
					<div class="forumpost-meta">
						<h4 class="inline-forum-title"><?php echo $Result['bezoeker'].'</h4><br><p class="forum-small forum-time">'.gmdate(	
						"Y-m-d\ H:i:s", $Result['unixtijd']);?>
					</div>
					<hr />
					<p><?php echo $Result['tekst']; ?></p>
					<br>
				</div>
			</div>
			<?php } ?>
			<h2>Zoekresultaten video's:</h2>
			<?php foreach($Results['VideoData'] as $Result) {?>
				<div class="forum-block forum-topic-title">
				<div class="forum-block-inner-top">
					<h2><?php echo $Result['titel'];?></h2>
					<div class="forumpost-meta">
						<iframe width="300" height="300" src="https://www.youtube.com/embed/<?php echo $Result['link'];?>"
                    allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen>
                    </iframe>
					<p><?php echo $Result['samenvatting']; ?></p>
					<hr>
					<p class="forum-small forum-time"><?php echo gmdate("Y-m-d\ H:i:s", $Result['gepubliceerd']);?></p>
				</div>
			</div>
			</div>
			<?php } ?>
			
			

        <?php require_once("footer.php"); ?>

</div>

</body>
</html>