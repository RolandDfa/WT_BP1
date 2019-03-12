<?php
/*
Team: Roland Huijskes en Thijs-Jan Guelen
Auteurs: Roland Huijskes en Thijs-Jan Guelen
*/
require_once('../../../functions.php');
require_once('../../../dbConnection.php');
ControleerLogin();
$title = $text = "";

$PostID = $value = isset($_GET['id']) ? $_GET['id'] : '';
$Post = HaalForumPostOp($dbh, $PostID);


if($Post['data']['bezoeker'] != $_SESSION['LoginName']) {
	header('Location: ../../../');
	exit;
}

$title = $Post['data']['kopje'];
$text = $Post['data']['tekst'];

if(isset($_GET['cat']) && $_GET['cat'] != '') {
	$cat = $_GET['cat'];
	
	$errMsg = "";
	
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
			$text = urlencode(nl2br(htmlentities($text)));
			
			$user = $_SESSION['LoginName'];
			$time = time();
			//hier een functie die filtert op verboden karakters/code
		
			$reply = SlaPostOp($dbh, $title, $text, $user, $cat, $time);
			$errMsg = $reply;
			$_POST = array();
			header('Location: ../forumOverview.php?cat='.$cat);
		}
	}
	
	require_once("startTopicForm.php");
} else {
	header('Location: ../../../');
}