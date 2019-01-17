<?php
function CheckSession() {
	if(!isset($_SESSION)) {
		session_start();
	}
}
function ExecQueryParam($dbh, $q, $fetch, $param) {
	$Ret = array('PDORetCode'=>0);
	try {
		$stmt = $dbh->prepare($q);
		$stmt->execute($param);
		if($fetch == "all") {
			$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
		} else {
			$data = $stmt->fetch($PDO::FETCH_ASSOC);
		}
		$Ret = array('PDORetCode'=>1, $data);
	} catch(PDOException $e) {
		$Ret = array('PDORetCode'=>0);
	}
	return $Ret;
}	

function ExecQuery($dbh, $q, $param) {
	$Ret = "Er ging iets fout. Probeer het later opnieuw.";
	try {
		$stmt = $dbh->prepare($q);
		$stmt->execute($param);
		$Ret = 'Opslaan gelukt';
	} catch(PDOException $e) {
		$Ret = "Er ging iets fout. Probeer het later opnieuw.";
	}
	return $Ret;
}	
		

//bezoeker gerelateerde functies
function RegisterUser($dbh, $user, $passwd, $fname, $lname) {
    $prm = array(':Name'=>$fname. ' ' . $lname,
        ':Username'=>$user,
        ':Password'=>$passwd);
	$query = 'INSERT INTO bezoekers(login, naam, wachtwoord) VALUES (:Username, :Name, :Password)';
	$Ret = "Er ging iets fout. Probeer het later opnieuw.";
	
	try {
		$stmt = $dbh->prepare($query);
		$stmt->execute($prm);
		$Ret = 'Opslaan gelukt';
	} catch(PDOException $e) {
		$Ret = "Er ging iets fout. Probeer het later opnieuw.";
	}
	return $Ret;
}

function CheckLogin($dbh, $user, $passwd) {
	$LoginData['code'] = 0;
	try {
		$stmt = $dbh->prepare("SELECT * FROM bezoekers WHERE login = :username");
		$prm = ([':username'=>$user]);
		$stmt->execute($param);
		$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
		if($data['wachtwoord'] == $passwd) {
			$LoginData['code'] = 1;
			$LoginData['name'] = $data['naam'];
		}
	} catch(PDOException $e) {
		$LoginData['code'] = 0;
	}
	return $LoginData;
}

//!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
function GetAllForumPosts($dbh, $category) {
	$Ret = array("PDORetCode"=>0);
	try {
		$stmt = $dbh->prepare("SELECT * FROM posts WHERE rubriek = :cat ORDER BY unixtijd DESC");
		$param = [':cat'=>$category];
		$stmt->execute($param);
		$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$Ret = array('PDORetCode'=>1, 'data'=>$data);
	} catch(PDOException $e) {
		$Ret = array("PDORetCode"=>0);
	}
	return $Ret;
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
	$ret = array('PDORetCode'=>0);
	try {
		$Query = 'SELECT * FROM posts WHERE id = :id';
		$param = [':id'=>$id];
		$stmt = $dbh->prepare($Query);
		$stmt->execute($param);
		$data = $stmt->fetch(PDO::FETCH_ASSOC);
		$Ret = array('PDORetCode'=>1, 'data'=>$data);
	} catch(PDOException $e) {
		$Ret = array('PDORetCode'=>0);
	}
	return $Ret;
}

function GetPostReplies($dbh, $postID) {
	$Ret = array('PDORetCode'=>0);
	try {
		$Query = "SELECT * FROM posts_replies WHERE post_id = :pid ORDER BY unixtijd asc";
		$param = [':pid'=>$postID];
		$stmt = $dbh->prepare($Query);
		$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$Ret = array('PDORetCode'=>1, 'data'=>$data);
	} catch(PDOException $e) {
		$Ret = array('PDORetCode'=>0);
	}
	return $Ret;
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
    $data = $stmt->fetch(PDO::FETCH_ASSOC);

    // controleren of de username voorkomt in de DB
    if ($data['COUNT(login)'] > 0)
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

function GetRecentPost($dbh)
{
    $Ret = "";
    try
    {
        $stmt = $dbh->prepare("SELECT top 3  * from posts ORDER BY unixtijd desc");
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    }
    catch(PDOException $e) {
        $Ret = "<h2>Er ging iets mis. Probeer het later opnieuw</h2>";
    }
    return $data;

}

function GetVideos($dbh, $cat) {
	$Ret = array('PDORetCode'=>0);
	try {
		$stmt = $dbh->prepare("SELECT * FROM videos WHERE rubriek = :cat");
		$stmt->execute([':cat'=>$cat]);
		$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$Ret = array('PDORetCode'=>1, 'data'=>$data);
	} catch(PDOException $e) {
		$Ret = array('PDORetCode'=>0);
	}
	return $Ret;
}

function SearchWebsite($dbh, $q) {
	$Ret = array('RetCode'=>0);
	try {
		$stmt = $dbh->prepare("SELECT * FROM posts WHERE kopje LIKE %:q% OR tekst LIKE %:q%");
		$stmt->execute([':q'=>$q]);
		$ForumData = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$stmt = $dbh->prepare("SELECT * FROM videos WHERE titel LIKE %:q% OR samenvatting LIKE %:q%");
		$stmt->execute([':q'=>$q]);
		$VideoData = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$Ret = array('RetCode'=>1, 'VideoData'=>$VideoData, 'ForumData'=>$ForumData);
	} catch(PDOException $e) {
		$Ret = array('RetCode'=>0);
	}
	return $Ret;
}
