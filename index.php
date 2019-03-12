<!--
Team: Roland Huijskes en Thijs-Jan Guelen
Auteurs: Roland Huijskes en Thijs-Jan Guelen
-->

<?php
require_once('dbConnection.php');
require_once('functions.php');
$posts = RecentePosts($dbh);

$continue = false;
$GeneralErr = "";
if($posts['PDORetCode'] == 1) {
	$posts = $posts['data'];
	$continue = true;
} else {
	$userErr = '<h2 style="color:red">Er ging iets fout bij het ophalen van recente forum posts. Sorry voor het ongemak.</h2>';
}

ControleerLogin();
?>

<!DOCTYPE html>

<html lang="nl" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <!-- include style sheet -->
    <link rel="stylesheet" type="text/css" href="./css/style.css">
    <!-- set charset to UTF 8 -->
    <meta charset="utf-8" />
    <!-- set title to home -->
    <title>Home</title>
</head>
    <body>
    <?php require_once('header.php');?>
    <div class="content">
        <div class="content-block">
            <div class="block">
                <h2>Welkom op onze site!</h2>
                <p>Welkom op de website van Füssball inside Nijmegen!<br /><br />
                    Op deze site vind je verschillende video's over bijvoorbeeld tactieken en spelregels, maar ook leuke bloopers!<br /><br />
                    Ook hebben we een community forum. Dit zijn de meest recente berichten;</p>
				<?php
				echo $GeneralErr; 
				if($continue) {?>
                <table>
                    <thead>
                    <tr class="table-header">
                        <td>Kopje</td>
                        <td>tekst</td>
                        <td>Bezoeker</td>
                        <td>Publicatie datum</td>
                    </tr>
                    </thead>
                    <tbody>

                    <?php
                     
                    // var_dump($posts);
                    foreach ($posts as $post)
                    {?>	
                        <tr class="tr-border">
                        <td><?php echo urldecode($post['kopje']); ?></td>
                        <td><?php echo urldecode($post['tekst']);?></td>
                        <td><?php echo $post['bezoeker'];?></td>
                        <td><?php echo gmdate("d-m-Y\ H:i:s", $post['unixtijd']);?></td>
                        </tr>
                   <?php }

                    ?>
                    </tbody>
                </table>
				<?php 
				} 
				require_once("footer.php"); ?>
        </div>
    </div>
    </div>
    </body>	
</html>