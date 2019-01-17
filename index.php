<?php
require('dbConnection.php');
require('functions.php');

CheckSession();
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
    <?php require('header.php');?>
    <div class="content">
        <div class="content-block">
            <?php if(isset($_SESSION['loggedIn'])) {
                $cat = "algemeen";
                $salt = $_SESSION['TOKENSALT'] = time();
                $key = CreateForumAccessToken($cat, $_SESSION['name'], $salt);
                ?>

            <?php } ?>
            <div class="block">
                <h2>Welkom op onze site!</h2>
                <p>Welkom op de website van Füssball inside Nijmegen!<br /><br />
                    Op deze site vind je verschillende video's over bijvoorbeeld tactieken en spelregels, maar ook leuke bloopers!<br /><br />
                    Ook hebben we een community forum. Momenteel hebben we drie categorieën:</p>
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
                     $posts = GetRecentPost($dbh);
                    // var_dump($posts);
                    foreach ($posts as $post)
                    {?>
                        <tr>
                        <td><?php echo $post['kopje'] ?></td>
                        <td><?php echo $post['tekst']?></td>
                        <td><?php echo $post['bezoeker']?></td>
                        <td><?php echo gmdate("d-m-Y\ H:i:s", $post['unixtijd']);?></td>
                        </tr>
                   <?php }

                    ?>
                    </tbody>
                </table>
            <?php require("footer.php"); ?>
        </div>
    </div>

    </body>	
</html>