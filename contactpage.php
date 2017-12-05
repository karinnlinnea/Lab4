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

if (isset($_POST['name'])) {
    add_comment($_POST['name']);
}

if (isset($_POST['email'])) {
    add_comment($_POST['email']);
}

if (isset($_POST['message'])) {
    add_comment($_POST['message']);
}

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Contact</title>
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
				<div id="contactcontent">
					<h2>CONTACT US</h2>
					<form method="POST" action="">
						<h3>FULL NAME</h3>
						<input type="text" name="name">
						</br>
						</br>
						<h3>E-MAIL</h3>
						<input type="text" name="email">
						</br>
						</br>
						<textarea name="message" rows="10" cols="50"></textarea>
						</br>
						</br>
						<input type="submit" name="submit" value="SEND">
					</form>
				</div>
			</div>

		</main>
	</body>

	<?php include("footer.php"); ?>
</html>
