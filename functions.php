<?php
function CheckSession() {
	if(!isset($_SESSION)) {
		session_start();
	}
}

function CheckLogin($dbh, $user, $passwd) {
	$stmt = $dbh->prepare("SELECT * FROM bezoekers WHERE login = :username");
	$stmt->execute([':username'=>$user]);
	$data = $stmt->fetch(PDO::FETCH_ASSOC);
	
	$loginData['code'] = 0;
	if($data['wachtwoord'] == $passwd) {
		$loginData['code'] = 1;
		$loginData['name'] = $data['naam'];
	}
	
	return $loginData;
}

function GetAllForumPosts($dbh, $category) {
	$stmt = $dbh->prepare("SELECT * FROM posts WHERE rubriek = :cat");
	$stmt->execute([':cat'=>$category]);
	$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
	
	return $data;
}

function CreateForumOverview($posts) {
	$ret = "";
	foreach($posts as $post) {
		$ret = $ret.'<tr class="forum-even">';
		$ret = $ret.'<td class="topic-title"><a href="./topics_algemeen/johan_derksen.html">'.$post['kopje'].'</a></td>';
		$ret = $ret.'<td class="topic-user">'.$post['bezoeker'].'</td>';
		$ret = $ret.'<td class="topic-date">'.gmdate("Y-m-d\ H:i:s", $post['unixtijd']).'</td>';
		$ret = $ret.'</tr>';
	}
	
	return $ret;
}			