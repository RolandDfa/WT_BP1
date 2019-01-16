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

//haal alle titels op van forum posts en maak er een tabel van
function CreateForumOverview($posts) {
	$ret = "";
	foreach($posts as $post) {
		$ret = $ret.'<tr class="forum-even">';
		$ret = $ret.'<td class="topic-title"><a href="./forumpost.php?id='.$post['id'].'">'.$post['kopje'].'</a></td>';
		$ret = $ret.'<td class="topic-user">'.$post['bezoeker'].'</td>';
		$ret = $ret.'<td class="topic-date">'.gmdate("Y-m-d\ H:i:s", $post['unixtijd']).'</td>';
		$ret = $ret.'</tr>';
	}
	
	return $ret;
}

function GetForumPost($dbh, $id) {
	$stmt = $dbh->prepare('SELECT * FROM posts WHERE id = :id');
	$stmt->execute([':id'=>$id]);
	$data = $stmt->fetch(PDO::FETCH_ASSOC);
	
	return $data;
}

function GetPostReplies($dbh, $postID) {
	$stmt = $dbh->prepare("SELECT * FROM posts_replies WHERE post_id = :pid ORDER BY unixtijd asc");
	$stmt->execute([':pid'=>$postID]);
	$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
	
	return $data;
}

function is_minlength($Invoer, $MinLengte)
{
    return (strlen($Invoer) >= (int)$MinLengte);
}
function is_Char_Only($Invoer)
{
    return (bool)(preg_match("/^[a-zA-Z ]*$/", $Invoer)) ;
}
function is_Username_Unique($Invoer,$pdo)
{
    $parameters = array(':login'=>$Invoer);
    $sth = $pdo->prepare('SELECT COUNT(login) FROM bezoekers WHERE login = :login');

    $sth->execute($parameters);
    $data = $sth->fetch(PDO::FETCH_NUM);

    // controleren of de username voorkomt in de DB
    if ($data[0] > 0)
        return false;//username komt voor
    else
        return true;//username komt niet voor
}

function CreateForumAccessToken($cat, $user, $salt) {
	$StageOneKey = hash('ripemd160', $user);
	$StageTwoKey = hash('sha256', $StageOneKey.$cat);
	$StageThreeKey = hash('crc32b', $StageTwoKey.$salt);
	$key = $StageThreeKey;
	return $key;
}