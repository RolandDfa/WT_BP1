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