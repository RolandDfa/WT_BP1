<!--
Team: Roland Huijskes en Thijs-Jan Guelen
Auteurs: Roland Huijskes en Thijs-Jan Guelen
-->

<?php
require_once('../../dbConnection.php');
require_once('../../functions.php');
ControleerLogin();

$PostID = $value = isset($_GET['id']) ? $_GET['id'] : '';
$PostVerwijderd = VerwijderPost($dbh, $_SESSION['LoginName'], $PostID);

if($PostVerwijderd['PDORetCode'] == 1) {
	$VerwijderReturn = "Post succesvol verwijderd.";
} else {
	$VerwijderReturn = "Er ging iets fout. Probeer het later opnieuw.";
}

?>
<!DOCTYPE html>
<html lang="nl-NL" xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<!-- include style sheet -->
		<link rel="stylesheet" type="text/css" href="../../css/style.css">
		<!-- set charset to UTF 8 -->
		<meta charset="utf-8" />
		<!-- set title to home -->
		<title>Bezoeker</title>
	</head>
	<body>
	<!-- all the content on the top of the page -->
		<!-- block containing the main content of the page -->
		<?php require_once("../../header.php");?>
		<div class="flex-container content">
			<div class="content-block">
				<!-- the content itself -->
				<div class="block">
					<div class="login">
						<h1><?php echo $VerwijderReturn;?></h1>
						<a href="../bezoeker">terug</a>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>