<?php
require_once("../../functions.php");
require_once('../../dbConnection.php');

CheckSession();
?>
<!DOCTYPE html>

<html lang="nl" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title>Algemeen Forum</title>
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body>
<?php require_once('../../header.php');?>
<div class="content">
    <div class="content-block">
		<?php if(isset($_SESSION['loggedIn'])) { 
			$cat = "algemeen";
			$salt = $_SESSION['TOKENSALT'] = time();
			$key = CreateForumAccessToken($cat, $_SESSION['name'], $salt);
		?>
		<div class="forum-block-inner">
			<a href="./startTopic.php?cat=<?php echo $cat.'&token='.$key;?>"><button>Start een nieuw topic</button></a>
		</div>
		<?php } ?>
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
        <?php require_once("../../footer.php"); ?>
    </div>
</div>
</body>
</html>