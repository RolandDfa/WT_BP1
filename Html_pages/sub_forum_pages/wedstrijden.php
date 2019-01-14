<?php
require("../../functions.php");
require('../../dbConnection.php');

?>
<!DOCTYPE html>

<html lang="nl" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title>Wedstrijden Forum</title>
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body>
<?php require('../../header.php');?>
<div class="content">
    <div class="content-block">
        <div class="block">
            <h2>Forum</h2>
            <table>
                <thead>
                <tr class="table-header">
                    <td>Naam</td>
                    <td>Gebruiker</td>
                    <td>Datum</td>
                </tr>
                </thead>
                <tbody>
				<?php
				$posts = GetAllForumPosts($dbh, "wedstrijden");
				echo CreateForumOverview($posts);
				?>
                </tbody>
            </table>
        </div>
        <footer>
            <p><strong>&#169; 2018 - Roland Huijskes, Thijs-Jan Guelen</strong></p>
            <p>Thema: voetbal</p>
            <p><strong>Contact information: <a href="mailto:someone@example.com">
                someone@example.com</a>.</strong></p>
        </footer>
    </div>
</div>
</body>
</html>