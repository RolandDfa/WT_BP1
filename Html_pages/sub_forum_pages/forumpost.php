<?php
require("../../functions.php");
require('../../dbConnection.php');

$id = isset($_GET['id']) ? $_GET['id'] : '';

$postData = GetForumPost($dbh, $id);
$postReplies = GetPostReplies($dbh, $id);

?>

<!DOCTYPE html>

<html lang="nl" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title><?php echo "Forum ".$postData['rubriek']." - ".$postData['kopje'];?></title>
    <link rel="stylesheet" href="../../../css/style.css">
</head>
<body>
<?php require("../../header.php");?>
<div class="forum-content">
    <div class="content-block">
        <div class="forum-block forum-topic-title">
            <h2><?php echo $postData['kopje'];?></h2>
            <div class="forumpost-meta">
				<h4 class="inline-forum-title"><?php echo $postData['bezoeker'].'</h4><p class="forum-small forum-time">'.gmdate("Y-m-d\ H:i:s", $postData['unixtijd']);?></p>
			</div>
			<hr />
			<p><?php echo $postData['tekst']; ?></p>
        </div>
		
		<?php
		foreach($postReplies as $reply) {
		?>
        <div class="forum-block round-edge">
            <div class="forum-block-inner">
                <h4 class="topic-user"><?php echo $reply['bezoeker'];?></h4>
                <hr />
                <p><?php echo $reply['tekst'].' - '.gmdate("Y-m-d\ H:i:s", $reply['unixtijd']);?></p>
            </div>
        </div>
		<?php }
		require("../../footer.php");
		?>
    </div>
</div>
</body>
</html>