<!DOCTYPE html>
<html lang="nl" xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta charset="utf-8" />
		<title><?php echo "Forum ".$postData['rubriek']." - ".$postData['kopje'];?></title>
		<link rel="stylesheet" href="../../../css/style.css">
	</head>
	<body>
		<?php require_once("../../../header.php");?>
		<div class="forum-content">
			<div class="content-block">
				<div class="forum-block forum-topic-title">
					<?php echo $userErr;?>
					<div class="forum-block-inner-top">
						<h2><?php echo urldecode($postData['kopje']);?></h2>
						<div class="forumpost-meta">
							<h4 class="inline-forum-title"><?php echo $postData['bezoeker'].'</h4><br><p class="forum-small forum-time">'.gmdate("Y-m-d\ H:i:s", $postData['unixtijd']);?>
						</div>
						<hr />
						<p><?php echo urldecode($postData['tekst']); ?></p>
						<br>
					</div>
				</div>
				
				<?php
				foreach($postReplies as $reply) {
				?>
				<div class="forum-block round-edge">
					<div class="forum-block-inner">
						<h4 class="topic-user"><?php echo $reply['bezoeker'];?></h4>
						<hr />
						<p><?php echo urldecode($reply['tekst']).'</p><p class="forum-small forum-time">'.gmdate("Y-m-d\ H:i:s", $reply['unixtijd']);?></p>
						<br>
					</div>
				</div>
				<?php 
				}
				if(isset($_SESSION['loggedIn'])) {
				?>
				<div class="forum-reply">
					<div class="forum-block round-edge">
						<div class="forum-block-inner">
							<h4>Laat een reactie achter:</h4>
							<form method="POST" action="./index.php?id=<?php echo $id;?>">
								<textarea rows=5 style="width: 100%;" class="reply-field" name="reply" placeholder="Typ hier je reactie..."></textarea>
								<br>
								<input type="submit" name="opslaan" value="verstuur reactie" onclick="" />

							</form>
						</div>
					</div>
				</div>
				<?php
				}
				require_once("../../../footer.php");
				?>
			</div>
		</div>
	</body>
</html>