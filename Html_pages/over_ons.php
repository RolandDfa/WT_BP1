<!--
Team: Roland Huijskes en Thijs-Jan Guelen
Auteurs: Roland Huijskes en Thijs-Jan Guelen
-->

<?php require_once("../functions.php");
require_once('../dbConnection.php');
ControleerLogin();
?>

<!DOCTYPE html>
<html lang="nl" xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<link rel="stylesheet" type="text/css" href="../css/style.css">
		<meta charset="utf-8" />
		<title>Over ons</title>
	</head>
	<body>
		<?php require_once('../header.php'); ?>
		<div class="content">
			<div class="content-block">
				<div class="block">
					<h1>Over ons</h1>
					<h2>Wie zijn wij?</h2>
					<div class="over_ons">
						<h3>Thijs-Jan</h3>
						<img class="about-img" src="../images/thijs.jpg" alt="Thijs" />
						<p>Vlotte ADHD'er die ook van programmeren houd</p>
						<p>ik heb aan de volgende projecten gewerkt:</p>
						<ol>
							<li>VR Schietspel</li>
							<li>2D racegame</li>
							<li>App voor lokale omroep</li>
						</ol>
					</div>
					<div class="over_ons">
					   <h3>Roland</h3>
						<img class="about-img" src="../images/about_us_images/image_roland.jpeg" alt="rland"/>
						<p>Wielrennende programmeur, gericht op C# en C++.</p>
						<p>Heeft aan verscheidende projecten gewerkt</p>
						<ol>
							<li>ChessGame</li>
							<li>ConcremoteDeviceManagment</li>
							<li>Tools4Ever</li>
							<li>2D racegame</li>
							<li>VR Schietspel</li>
							<li>Dutch Hitmen (coc) Member managment</li>
						</ol>
						<br />
					</div>
					<?php require_once("../footer.php");?>
				</div>
			</div>
		</div>
	</body>
</html>