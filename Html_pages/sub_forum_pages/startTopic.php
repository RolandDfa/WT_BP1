<?php
require('../../functions.php');
require('../../dbConnection.php');
checkSession();
if(isset($_GET['cat']) && $_GET['cat'] != '' && isset($_GET['token']) && $_GET['token'] != '') {
	$cat = $_GET['cat'];
	$key = $_GET['token'];
	$salt = $_SESSION['TOKENSALT'];
	
	$checkKey = CreateForumAccessToken($cat, $_SESSION['name'], $salt);
	//echo "check key is ".$checkKey."<br><br>Sent key is ".$key;
	if(isset($_POST['send'] {
		$title = isset($_POST['title']) ? $_POST['title'] : '';
		$text = isset($_POST['postText']) ? $_POST['postText'] : '';
		//hier een functie die filtert op verboden karakters/code
		
		//hier een functie die het topic opslaat
	}
?>
<!DOCTYPE html>

<html lang="nl" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title>Algemeen Forum</title>
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body>
<?php require("../../header.php");?>
<div class="forum-content">
    <div class="content-block">
		<form method="POST" action="">
			<div class="forum-block forum-topic-title">
				<div class="forum-block-inner-top">
					<h4>Categorie: <?php echo $cat;?></h4>
					<h2>Titel:</h2>
					<input class="fullfield" type="text" placeholder="Titel van je topic..." name="title" />
					<br>
					<hr>
					<h2>Tekst:
					<textarea rows="15" class="fullfield" name="postText" placeholder="Typ hier je reactie..."></textarea>
					<input type="submit" value="Verstuur" name="send" />
				</div>
			</div>
		</form>
	</div>
</div>
</body>
</html>
<?php
} else {
	header('Location: ../../');
}