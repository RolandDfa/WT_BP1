<?php
function ControleerLogin() {
	if(!isset($_SESSION)) {
		session_start();
	}

}	

//bezoeker gerelateerde functies
function RegistreerGebruiker($dbh, $user, $passwd, $fname, $lname) {
    $prm = array(':Name'=>$fname. ' ' . $lname,
        ':Username'=>$user,
        ':Password'=>$passwd);
	$query = 'INSERT INTO bezoekers(login, naam, wachtwoord) VALUES (:Username, :Name, :Password)';
	$Ret = 0;
	
	try {
		$stmt = $dbh->prepare($query);
		$stmt->execute($prm);
		$Ret = 1;
	} catch(PDOException $e) {
		$Ret = 0;
	}
	return $Ret;
}

function ControleerLoginData($dbh, $user, $passwd) {
	$LoginData['code'] = 0;
	try {
		$stmt = $dbh->prepare("SELECT * FROM bezoekers WHERE login = :username");
		$prm = ([':username'=>$user]);
		$stmt->execute($prm);
		$data = $stmt->fetch(PDO::FETCH_ASSOC);
	} catch(PDOException $e) {
		$LoginData['code'] = 0;
	}
	if($data['wachtwoord'] == $passwd) {
			$LoginData['code'] = 1;
			$LoginData['name'] = $data['naam'];
	}
	return $LoginData;
}

function BestaatRubriek($dbh, $category) {
	$Ret = array("PDORetCode"=>0);
	try {
		$stmt = $dbh->prepare("SELECT count(*) FROM rubrieken WHERE rubriek = :rubriek");
		$stmt->execute([':rubriek'=>$category]);
		$data = $stmt->fetch(PDO::FETCH_NUM);
		$Ret = array('PDORetCode'=>1, 'data'=>$data);
	} catch(PDOException $e) {
		$Ret = array("PDORetCode"=>0);
	}
		

function AlleForumBerichten($dbh, $category) {
	$Ret = array("PDORetCode"=>0);
	try {
		$stmt = $dbh->prepare("SELECT count(*) FROM rubrieken WHERE rubriek = :rubriek");
		$stmt->execute([':rubriek'=>$category]);
		$data = $stmt->fetch(PDO::FETCH_NUM);
		if($data[0] > 0) {
			$stmt = $dbh->prepare("SELECT * FROM posts WHERE rubriek = :cat ORDER BY unixtijd DESC");
			$param = [':cat'=>$category];
			$stmt->execute($param);
			$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
			$Ret = array('PDORetCode'=>1, 'data'=>$data);
		} else {
			$Ret = array("PDORetCode"=>0);
		}
	} catch(PDOException $e) {
		$Ret = array("PDORetCode"=>0);
	}
	return $Ret;
}

//haal alle titels op van forum posts en maak er een tabel van
function GenereerForumOverzicht($posts) {
	$Ret = "";
	foreach($posts as $post) {
		$Ret = $Ret.'<tr class="forum-even">';
		$Ret = $Ret.'<td class="topic-title"><a href="./forumpost/?id='.$post['id'].'">'.urldecode($post['kopje']).'</a></td>';
		$Ret = $Ret.'<td class="topic-user">'.$post['bezoeker'].'</td>';
		$Ret = $Ret.'<td class="topic-date">'.gmdate("Y-m-d\ H:i:s", $post['unixtijd']).'</td>';
		$Ret = $Ret.'</tr>';
	}
	return $Ret;
}

function HaalForumBerichtOp($dbh, $id) {
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

function HaalBerichtReactiesOp($dbh, $postID) {
	$Ret = array('PDORetCode'=>0);
	try {
		$Query = "SELECT * FROM posts_replies WHERE post_id = :pid ORDER BY unixtijd asc";
		$param = [':pid'=>$postID];
		
		$stmt = $dbh->prepare($Query);
		$stmt->execute($param);
		$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$Ret = array('PDORetCode'=>1, 'data'=>$data);
	} catch(PDOException $e) {
		$Ret = array('PDORetCode'=>0);
	}
	return $Ret;
}

function ReactieOpslaan($dbh, $postID, $text, $user, $time) {
	$Ret = "";
	try {
		$stmt = $dbh->prepare("INSERT INTO posts_replies (post_id, tekst, bezoeker, unixtijd) VALUES (:pid, :text, :user, :time)");
		$stmt->execute([
				':pid'=>$postID,
				':text'=>$text,
				':user'=>$user,
				':time'=>$time
			]);
		$Ret = '<h2 style="color: green">Reactie succesvol opgeslagen!</h2>';
	} catch(PDOException $e) {
		$Ret = '<h2 style="color: red">Er ging iets mis. Probeer het later opnieuw</h2>';
	}
	return $Ret;
}

function IsMinimumLengte($invoer, $minLengte)
{
    return (strlen($invoer) >= (int)$minLengte);
}
function IsAlleenKarakters($invoer)
{
    return (bool)(preg_match("/^[a-zA-Z ]*$/", $invoer)) ;
}
function IsGebruikersnaamUniek($invoer, $dbh)
{
	$Ret = array('PDORetCode'=>0);
	try	{
		$stmt = $dbh->prepare('SELECT COUNT(login) FROM bezoekers WHERE login = :login');
		$prm = array(':login'=>$invoer);
		$stmt->execute($prm);
		$data = $stmt->fetch(PDO::FETCH_NUM);
		$Ret = array('PDORetCode'=>1);
		if ($data[0] > 0) {
			$Ret['unused'] = false;
		} else {
			$Ret['unused'] = true;
		}
	} catch(PDOException $e) {
		$Ret = array('PDORetCode'=>0);
	}
	return $Ret;
}

function GenereerForumAccessToken($cat, $user, $salt) {
	$StageOneKey = hash('ripemd160', $user);
	$StageTwoKey = hash('sha256', $StageOneKey.$cat);
	$StageThreeKey = hash('crc32b', $StageTwoKey.$salt);
	$Key = $StageThreeKey;
	return $Key;
}

function GenereerWachtwoord($passwd, $user) {
	$StageOneKey = hash('ripemd160', $passwd);
	$StageTwoKey = hash('sha384', $StageOneKey.$user);
	return $StageTwoKey;
}

function SlaPostOp($dbh, $title, $text, $user, $cat, $time) {
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

function RecentePosts($dbh)
{
    $Ret = array('PDORetCode'=>0);
    try
    {
        $stmt = $dbh->prepare("SELECT top 3  * from posts ORDER BY unixtijd desc");
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$Ret = array('PDORetCode'=>1, 'data'=>$data);
    }
    catch(PDOException $e) {
        $Ret = array('PDORetCode'=>0);
    }
    return $Ret;

}

function HaalVideosOp($dbh, $cat) {
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

function ZoekWebsite($dbh, $q) {
	$Ret = array('PDORetCode'=>0);
	try {
		$prm = array([':qe'=>$q, ':qf'=>$q]);
		$stmt = $dbh->prepare("SELECT * FROM posts WHERE kopje LIKE CONCAT('%', :q1, '%') OR tekst LIKE CONCAT('%', :q2, '%')");
		$stmt->execute([':q1'=>$q, ':q2'=>$q]);
		$ForumData = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$stmt2 = $dbh->prepare("SELECT * FROM videos WHERE titel LIKE CONCAT('%', :q1, '%') OR samenvatting LIKE CONCAT('%', :q2, '%')");
		$stmt2->execute([':q1'=>$q, ':q2'=>$q]);
		$VideoData = $stmt2->fetchAll(PDO::FETCH_ASSOC);
		$Ret = array('PDORetCode'=>1, 'data'=>array('VideoData'=>$VideoData, 'ForumData'=>$ForumData));
	} catch(PDOException $e) {
		$Ret = array('PDORetCode'=>0);
	}
	return $Ret;
}

function ControleerVideoCategorie($dbh, $cat) {
	$Ret = 0;
	try {
		$stmt = $dbh->prepare('SELECT COUNT(rubriek) FROM videos WHERE rubriek = :rubriek');
		$stmt->execute([':rubriek'=>$cat]);
		$data = $stmt->fetch(PDO::FETCH_NUM);
		if($data[0] > 0) {
			$Ret = 1;
		} else {
			$Ret = 0;
		}
	} catch(PDOException $e) {
		$Ret = 0;
	}
	return $Ret;
}