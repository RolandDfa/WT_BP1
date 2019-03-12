<!--
Team: Roland Huijskes en Thijs-Jan Guelen
Auteurs: Roland Huijskes en Thijs-Jan Guelen
-->

<!DOCTYPE html>
<html lang="nl" xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta charset="utf-8" />
		<title>Algemeen Forum</title>
		<link rel="stylesheet" href="../../../css/style.css">
	</head>
	<body>
	<?php require_once("../../../header.php");?>
		<div class="forum-content">
			<div class="content-block">
				<form method="POST" action="">
					<div class="forum-block forum-topic-title">
						<div class="forum-block-inner-top">
							<?php echo $errMsg;?>
							<h4>Categorie: <?php echo $cat;?></h4>
							<h2>Titel:</h2>
							<input class="fullfield" type="text" value="<?php echo $title;?>" placeholder="Titel van je topic..." name="title" />
							<br>
							<hr>
							<h2>Tekst:
							<textarea rows="15" class="fullfield" name="postText" placeholder="Typ hier je Bericht..."><?php echo $text; ?></textarea>
							<input type="submit" value="Verstuur" name="send" />
						</div>
					</div>
				</form>
			</div>
		</div>
	</body>
</html>
