<?php
require_once('../../functions.php');
require_once('../../dbConnection.php');
ControleerLogin();
$title = $text = "";
if(isset($_GET['cat']) && $_GET['cat'] != '' && isset($_GET['token']) && $_GET['token'] != '') {
	$cat = $_GET['cat'];
	$key = $_GET['token'];
	$salt = $_SESSION['TOKENSALT'];
	
	$errMsg = "";
	
	$checkKey = GenereerForumAccessToken($cat, $_SESSION['name'], $salt);
	//echo "check key is ".$checkKey."<br><br>Sent key is ".$key;
	if(isset($_POST['send'])) {
		if(empty($_POST['title']) || empty($_POST['postText'])) {
			$errMsg = '<h4 style="color:red">Titel en/of bericht kan niet leeg zijn';
			$title = isset($_POST['title']) ? $_POST['title'] : '';
			$text = isset($_POST['postText']) ? $_POST['postText'] : '';
		} else {
			$title = isset($_POST['title']) ? $_POST['title'] : '';
			$text = isset($_POST['postText']) ? $_POST['postText'] : '';
			
			$title = urlencode(htmlentities($title));
			$text = nl2br(urlencode(htmlentities($text)));
			
			$user = $_SESSION['LoginName'];
			$time = time();
			//hier een functie die filtert op verboden karakters/code
		
			$reply = SlaPostOp($dbh, $title, $text, $user, $cat, $time);
			$errMsg = $reply;
			$_POST = array();
			header('Location: ./forumOverview.php?cat='.$cat);
		}
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
<?php require_once("../../header.php");?>
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
					<textarea rows="15" class="fullfield" name="postText" value="<?php echo $text; ?>" placeholder="Typ hier je Bericht..."></textarea>
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