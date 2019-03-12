<!--
Team: Roland Huijskes en Thijs-Jan Guelen
Auteurs: Roland Huijskes en Thijs-Jan Guelen
-->

<?php
require_once("../../../functions.php");
require_once('../../../dbConnection.php');
$userErr = "";
ControleerLogin();
$id = isset($_GET['id']) ? $_GET['id'] : '';
$postData = HaalForumPostOp($dbh, $id);
if($postData['PDORetCode'] == 1) {
	$postData = $postData['data'];
} else {
	$userErr = "<h2>Er ging iets fout</h2>";
}

$CompareArr = array();

if(isset($_POST['opslaan'])) {
	if(empty($_POST['reply'])) {
		$userErr = '<h2 style="color: red">Reactie kan niet leeg zijn</h2>';
	} else {
		$text = isset($_POST['reply']) ? $_POST['reply'] : '';
		$text = urlencode(nl2br(htmlentities($text)));
		$scheldwoorden = array("kanker", "tyfus", "tering", "kut", "lul");
		$text = str_replace($scheldwoorden, 'bobba', $text);
		
		$text = str_replace('kringspier', 'bobbaspier', $text);
		$drommels = array('verdomme', 'godver', 'godverdomme');
		$text = str_replace($drommels, 'drommels, drommels en nog eens drommels!', $text);
		//$text = strtr($text, $scheldwoorden, 'bobba');
		$time = time();
		
		$userErr = ReactieOpslaan($dbh, $id, $text, $_SESSION['LoginName'], $time);
		$postReplies = HaalBerichtReactiesOp($dbh, $id);

		header('Location: ./index.php?id='.$id);
	}
}

$postReplies = HaalBerichtReactiesOp($dbh, $id);
if($postReplies['PDORetCode'] == 1) {
	$postReplies = $postReplies['data'];
} else {
	$userErr = $userErr."<h2>Er ging iets fout met het ophalen van reacties</h2>";
}

require_once("forumPostMarkup.php");
?>
