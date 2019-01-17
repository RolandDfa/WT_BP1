<?php
function CheckSession() {
	if(!isset($_SESSION)) {
		session_start();
	}
}
//bezoeker gerelateerde functies
function RegisterUser($dbh, $user, $passwd, $fname, $lname) {
    $prm = array(':Name'=>$fname. ' ' . $lname,
        ':Username'=>$user,
        ':Password'=>$passwd);

    $stmt = $dbh->prepare('INSERT INTO bezoekers(login, naam, wachtwoord) VALUES (:Username, :Name, :Password)');
    $stmt->execute($prm);
}

function CheckLogin($dbh, $user, $passwd) {
	$stmt = $dbh->prepare("SELECT * FROM bezoekers WHERE login = :username");
	$prm = ([':username'=>$user]);
	$stmt->execute($prm);
	$data = $stmt->fetch(PDO::FETCH_ASSOC);
	
	$LoginData['code'] = 0;
	if($data['wachtwoord'] == $passwd) {
		$LoginData['code'] = 1;
		$LoginData['name'] = $data['naam'];
	}	
	return $LoginData;
}

function GetAllForumPosts($dbh, $category) {
	$stmt = $dbh->prepare("SELECT * FROM posts WHERE rubriek = :cat ORDER BY unixtijd DESC");
	$stmt->execute([':cat'=>$category]);
	$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
	
	return $data;
}

//haal alle titels op van forum posts en maak er een tabel van
function CreateForumOverview($posts) {
	$Ret = "";
	foreach($posts as $post) {
		$Ret = $Ret.'<tr class="forum-even">';
		$Ret = $Ret.'<td class="topic-title"><a href="./forumpost.php?id='.$post['id'].'">'.$post['kopje'].'</a></td>';
		$Ret = $Ret.'<td class="topic-user">'.$post['bezoeker'].'</td>';
		$Ret = $Ret.'<td class="topic-date">'.gmdate("Y-m-d\ H:i:s", $post['unixtijd']).'</td>';
		$Ret = $Ret.'</tr>';
	}
	
	return $Ret;
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

function SavePostReply($dbh, $postID, $text, $user, $time) {
	$Ret = "";
	try {
		$stmt = $dbh->prepare("INSERT INTO posts_replies (post_id, tekst, bezoeker, unixtijd) VALUES (:pid, :text, :user, :time)");
		$stmt->execute([
				':pid'=>$postID,
				':text'=>$text,
				':user'=>$user,
				':time'=>$time
			]);
		$Ret = "<h2>Reactie succesvol opgeslagen!</h2>";
	} catch(PDOException $e) {
		$Ret = "<h2>Er ging iets mis. Probeer het later opnieuw</h2>";
	}
}

function is_minlength($invoer, $minLengte)
{
    return (strlen($invoer) >= (int)$minLengte);
}
function is_Char_Only($invoer)
{
    return (bool)(preg_match("/^[a-zA-Z ]*$/", $invoer)) ;
}
function is_Username_Unique($invoer, $dbh)
{
    $stmt = $dbh->prepare('SELECT COUNT(login) FROM bezoekers WHERE login = :login');
	$prm = array(':login'=>$invoer);
    $stmt->execute($prm);
    $data = $stmt->fetch(PDO::FETCH_NUM);

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
	$Key = $StageThreeKey;
	return $Key;
}

function HashPassword($passwd, $user) {
	$StageOneKey = hash('ripemd160', $passwd);
	$StageTwoKey = hash('sha384', $StageOneKey.$user);
	return $StageTwoKey;
}

function CreateForumPost($dbh, $title, $text, $user, $cat, $time) {
	$Ret = "";
	try {
		$stmt = $dbh->prepare("INSERT INTO posts (kopje, tekst, bezoeker, rubriek, unixtijd) VALUES (:title, :text, :user, :cat, :time)");
		$stmt->execute([
				':title'=>$title,
				':text'=>$text,
				':user'=>$user,
				':cat'=>$cat,
				':time'=>$time
			]);
		$Ret = "<h2>Post succesvol opgeslagen!</h2>";
	} catch(PDOException $e) {
		$Ret = "<h2>Er ging iets mis. Probeer het later opnieuw</h2>";
	}
	return $Ret;
}

function GetVideos($dbh, $cat) {
	$stmt = $dbh->prepare("SELECT * FROM videos WHERE rubriek = :cat");
	$stmt->execute([':cat'=>$cat]);
	$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
	
	return $data;
}