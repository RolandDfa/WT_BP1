<!--
Team: Roland Huijskes en Thijs-Jan Guelen
Auteurs: Roland Huijskes en Thijs-Jan Guelen
-->

<!DOCTYPE html>
<html lang="nl-NL" xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<!-- include style sheet -->
		<link rel="stylesheet" type="text/css" href="../../css/style.css">
		<!-- set charset to UTF 8 -->
		<meta charset="utf-8" />
		<!-- set title to home -->
		<title>Bezoeker</title>
	</head>
	<body>
	<!-- all the content on the top of the page -->
		<!-- block containing the main content of the page -->
		<?php require_once("../../header.php");?>
		<div class="flex-container content">
			<div class="content-block">
				<!-- the content itself -->
				<div class="block">
					<div class="login">
						<h1>Posts op het forum</h1>
						<!-- login form -->
							<?php
								$GebruikerPosts = PostsPerGebruiker($dbh, $_SESSION['LoginName']);

								if($GebruikerPosts['PDORetCode'] == 1) {
									$tabel = '<table><thead><tr><th>Titel</th><th>Rubriek</th><th>Bewerk</th><th>Verwijder</th></thead><tbody>';
									foreach($GebruikerPosts['data'] as $val) {
										$tabel = $tabel.'<tr><td>'.urldecode($val['kopje']).'</td><td>'.$val['rubriek'].'</td><td><a href="../sub_forum_pages/startTopic/bewerk.php?cat='.$val['rubriek'].'&id='.$val['id'].'">bewerk</a></td><td><a href="./delete.php?id='.$val['id'].'">verwijder</a></td></tr>';
									}
									echo $tabel;
								} else {
									echo "<h2>Er ging iets fout</h2>";
								}
							?>
					</div>
					<div class="login-help">
						<p>Wachtwoord vergeten? <a href="../../index.php">Klik hier om te resetten</a>.</p>
						<p>Bijdrage leveren? <a href="bijdrage.html">Klik hier om een bijdrage te leveren</a> </p>
					</div>
				</div>
				<?php require_once("../../footer.php");?>
			</div>
		</div>
	</body>
</html>