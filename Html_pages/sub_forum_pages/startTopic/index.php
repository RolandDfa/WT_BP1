<?php
require_once('../../../functions.php');
require_once('../../../dbConnection.php');
ControleerLogin();
$title = $text = "";
if(isset($_GET['cat']) && $_GET['cat'] != '' && isset($_GET['token']) && $_GET['token'] != '') {
	$cat = $_GET['cat'];
	
	$errMsg = "";
	$continue = false;
	$CatExists = BestaatRubriek($dbh, $cat);
	if($CatExists["PDORetCode"] == 1) {
		$CatExists = $CatExists['data'];
		$continue = true;
	} else {
		$continue = false;
		$errMsg = "<h2>Er ging iets fout. Probeer het later opnieuw.</h2>";
	}
	
	if($CatExists[0] < 1) {
		header('Location: ../../../');
		exit;
	}
	
	//echo "check key is ".$checkKey."<br><br>Sent key is ".$key;
	if(isset($_POST['send']) && $continue == true) {
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