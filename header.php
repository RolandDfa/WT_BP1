<div class="header">
	<!-- blocks containing the title and logo -->
	<div class="menu-block">
	    <div class="site-header">
	        <a href="index.html">
	        <img class="header-img" src="<?php $_SERVER['SERVER_NAME'];?>/images/Soccerball.svg" alt="voetbal_logo" /></a>
	        <div class="site-header-block">
				<h1 class="site-title">Füssball Inside Nimma</h1>
	        </div>
	    </div>
	</div>
	<!-- block containing the menu -->
	<div class="navbar">
	    <a class="menu-item" href="<?php $_SERVER['SERVER_NAME'];?>/index.php">Home</a>
	    <div class="dropdown">
	        <button class="dropbtn">Video's
				<i class="fa fa-caret-down"></i>
	        </button>
	        <div class="dropdown-content">
				<a class="menu-item" href="<?php $_SERVER['SERVER_NAME'];?>/Html_pages/sub_video_pages/spelregels.php">Spelregels</a>
				<a class="menu-item" href="<?php $_SERVER['SERVER_NAME'];?>/Html_pages/sub_video_pages/tactiek.php">Tactiek</a>
				<a class="menu-item" href="<?php $_SERVER['SERVER_NAME'];?>/Html_pages/sub_video_pages/Bloopers.php">Bloopers</a>
	        </div>
	    </div>
	    <div class="dropdown">
	        <button class="dropbtn">Forum
				<i class="fa fa-caret-down"></i>
	        </button>
	        <div class="dropdown-content">
				<a class="menu-item" href="<?php $_SERVER['SERVER_NAME'];?>/Html_pages/sub_forum_pages/algemeen.php">Algemeen</a>
				<a class="menu-item" href="<?php $_SERVER['SERVER_NAME'];?>/Html_pages/sub_forum_pages/wedstrijden.php">Wedstrijden</a>
				<a class="menu-item" href="<?php $_SERVER['SERVER_NAME'];?>/Html_pages/sub_forum_pages/onzin_forum.php">Onzin</a>
	        </div>
	    </div>
	    <a class="menu-item" href="<?php $_SERVER['SERVER_NAME'];?>/Html_pages/over_ons.php">Over ons</a>
	    <a class="menu-item menu-right" href="<?php $_SERVER['SERVER_NAME'];?>/Html_pages/register.html">Bezoeker</a>
	    <div class="menu-item menu-right">
	        <form action="#">
				<?php if(isset($_SESSION['name'])) { echo '<span style="color:white">'.$_SESSION['name']."</span>";} ?>
				<input type="text" placeholder="Zoeken..." name="Zoeken">
				<button type="submit"><i class="fa fa-search"></i></button>
	        </form>
	    </div>
	</div>
</div>