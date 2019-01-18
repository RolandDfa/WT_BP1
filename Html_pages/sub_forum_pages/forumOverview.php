<?php
require_once("../../functions.php");
require_once('../../dbConnection.php');
if(!empty($_GET['cat'])) {
	$cat = $_GET['cat'];
} else {
	header('Location: ../');
	exit;
}
$Posts = AlleForumBerichten($dbh, $cat);
$Continue = $LockForm = false;
$ErrMsg = "";
if($Posts["PDORetCode"] == 1) {
	$Posts = $Posts['data'];
	$Continue = true;
} else {
	$Continue = false;
	$LockForm = true;
	$ErrMsg = "<h2>Er ging iets fout. Probeer het later opnieuw.</h2>";
}


ControleerLogin();
?>
<!DOCTYPE html>

<html lang="nl" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title>Rubriek <?php echo $cat; ?></title>
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body>
<?php require_once('../../header.php');?>
<div class="content">
    <div class="content-block">
		<?php echo $ErrMsg; ?>
		<div class="forum-block-inner">
		<a href="./startTopic.php?cat=<?php echo $cat.'&token='.$key;?>">Start een nieuw topic</a>
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
				if($Continue) {
					echo GenereerForumOverzicht($Posts);
				}
				?>
                </tbody>
            </table>
        </div>
        <?php require_once("../../footer.php"); ?>
    </div>
</div>
</body>
</html>