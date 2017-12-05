<?php

function add_comment($comment) {

	@ $db = new mysqli('localhost', 'root', 'root', 'thebookclub');

	$comment= htmlentities($comment);
	$comment = mysqli_real_escape_string($db, $comment);

	$query = ("INSERT INTO comments(comment) VALUES ('{$comment}')");
	$stmt = $db->prepare($query);
	$stmt->execute();
}

function get_comment() {

	@ $db = new mysqli('localhost', 'root', 'root', 'thebookclub');

	$query = ("SELECT comment FROM comments");
	$stmt = $db->prepare($query);
	$stmt->bind_result($result);
	$stmt->execute();

    while ($stmt->fetch()) {
        echo $result;
        echo "<hr/>";
    }
}

if (isset($_POST['username'])) {
    add_comment($_POST['username']);
}

if (isset($_POST['password'])) {
    add_comment($_POST['password']);
}
?>

<?php

@ $db = new mysqli('localhost', 'root', 'root', 'thebookclub');

if(isset($_POST['username'], $_POST['password'])) {
    $uname = mysqli_real_escape_string($db, $_POST['username']);
    $upass = sha1($_POST['password']);

    $query = ("SELECT * FROM user WHERE username ='{$uname}' "." AND password ='{$upass}'");

    $stmt = $db->prepare($query);
    $stmt->execute();
    $stmt->store_result();

    $totalcount = $stmt->num_rows();
}

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Gallery/login</title>
		<?php include("config.php"); ?>
		<link rel="stylesheet" href="main.css">
		<meta charset="utf-8">
		<link href="https://fonts.googleapis.com/css?family=Quicksand:300,400,500,700" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:300,400,700" rel="stylesheet">
	</head>

	<body>
		<main>
			<?php include("header.php"); ?>

			<div id="maincontent">
				<div id="gallerycontent">

					<form action="" method="POST">
						<h2>LOG IN TO UPLOAD IMAGES</h2>
						<h3>USERNAME:</h3>
						<input type="text" name="username">
						<h3>PASSWORD:</h3>
						<input type="password" name="password">
						<input type="submit" value="LOG IN">

						<?php
	       				if(isset($totalcount)) {
	            		if($totalcount == 0) {
		                	echo "</br>";
		                	echo "</br>";
		                	echo "<h3 id=\"wrongtext\">WRONG USERNAME OR PASSWORD!</h3>";
	            		} else {
		            		echo "</br>";
		            		echo "</br>";
		                	echo "<h3 id=\"welcometext\">WELCOME!</h3>";
		                	echo "</br>";
		                	echo "</br>";
		                	echo "</br>";
		                	echo "<h3 id=\"uploadtext\"><a href=\"fileupload.php\" id=\"uploadlink\">CLICK HERE</a> TO UPLOAD A NEW IMAGE</h3>";
	            		}
	       				}
	        			?>
					</form>
				</div>
        <div class="grid">
          <?php
          $dirname = "uploadedfiles";
          $images = glob($dirname."/*.{jpeg,gif,png,jpg}",GLOB_BRACE);

          foreach($images as $image) {
            echo '<div class="grid-item">';
            echo '<img src="'.$image.'" /><br />';
            echo '</div>';
          }
           ?>
        </div>

			</div>

		</main>

    <script src="/Lab4/masonry.pkgd.min.js"></script>
    <script src="/Lab4/imagesloaded.pkgd.min.js">

    </script>
    <script>
    var elem = document.querySelector('.grid');
    var msnry = new Masonry( elem, {
      itemSelector: '.grid-item',
      columnWidth: 260
    });

    imagesLoaded( elem ).on( 'progress', function() {
      // layout Masonry after each image loads
      msnry.layout();
    });
    </script>
	</body>

	<?php include("footer.php"); ?>
</html>
