<?php
require("../../functions.php");
require('../../dbConnection.php');

?>
<!DOCTYPE html>

<html lang="nl" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title>Algemeen Forum</title>
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
				$posts = GetAllForumPosts($dbh, "algemeen");
				echo CreateForumOverview($posts);
				?>
                </tbody>
            </table>
        </div>
        <?php require("../../footer.php"); ?>
    </div>
</div>
</body>
</html>