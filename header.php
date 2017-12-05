<header>
	<a href="index.php"><img src="headerlight.png"></a>
	<ul>
		<li>
			<a class="<?php echo ($current_page == 'index.php' || $current_page == '') ? 'active' : NULL ?>" href="index.php">HOME</a>
		</li>
		<li>
			<a class="<?php echo ($current_page == 'aboutuspage.php') ? 'active' : NULL ?>" href="aboutuspage.php">ABOUT US</a>
		</li>
		<li>
			<a class="<?php echo ($current_page == 'browsebookspage.php') ? 'active' : NULL ?>" href="browsebookspage.php">BROWSE BOOKS</a>
		</li>
		<li>
			<a class="<?php echo ($current_page == 'mybookspage.php') ? 'active' : NULL ?>" href="mybookspage.php">MY BOOKS</a>
		</li>
		<li>
			<a class="<?php echo ($current_page == 'contactpage.php') ? 'active' : NULL ?>" href="contactpage.php">CONTACT</a>
		</li>
		<li>
			<a class="<?php echo ($current_page == 'gallerypage.php') ? 'active' : NULL ?>" href="gallerypage.php">GALLERY/LOG IN</a>
		</li>
	</ul>
</header>