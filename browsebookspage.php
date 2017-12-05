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

if (isset($_POST['searchtitle'])) {
    add_comment($_POST['searchtitle']);
}

if (isset($_POST['searchauthor'])) {
    add_comment($_POST['searchauthor']);
}

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Browse books</title>
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
				<div id="browsebookscontent">
					<h2>SEARCH FOR A BOOK HERE</h2>

            		<form action="browsebookspage.php" method="POST">
						<h3>TITLE</h3>
						<input type="text" name="searchtitle">
						</br>
						</br>
						<h3>AUTHOR</h3>
						<input type="text" name="searchauthor">
						</br>
						</br>
						<input type="submit" name="submit" value="SEARCH">
					</form>
					<?php

					$searchtitle = "";
					$searchauthor = "";

					if (isset($_POST) && !empty($_POST)) {
					    $searchtitle = trim($_POST['searchtitle']);
					    $searchauthor = trim($_POST['searchauthor']);
					}

					$searchtitle = addslashes($searchtitle);
					$searchauthor = addslashes($searchauthor);

					@ $db = new mysqli($dbserver, $dbuser, $dbpass, $dbname);

					if ($db->connect_error) {
					    echo "could not connect: " . $db->connect_error;
					    printf("<br><a href=index.php>Return to home page </a>");
					    exit();
					}

					$query = " select bookid, title, author, reserved from books where reserved is false";
					if ($searchtitle && !$searchauthor) {
					    $query = $query . " and title like '%" . $searchtitle . "%'";
					}
					if (!$searchtitle && $searchauthor) {
					    $query = $query . " and author like '%" . $searchauthor . "%'";
					}
					if ($searchtitle && $searchauthor) {
					    $query = $query . " and title like '%" . $searchtitle . "%' and author like '%" . $searchauthor . "%'";
					}

				    $stmt = $db->prepare($query);
				    $stmt->bind_result($bookid, $title, $author, $reserved);
				    $stmt->execute();

				    echo '<table bgcolor="#dddddd" cellpadding="6">';
				    echo '<tr><td><b>TITLE</b></td> <td><b>AUTHOR</b></td></tr>';
				    while ($stmt->fetch()) {
				    	if($reserved==1)
	            		$reserved="Yes";
	            		if($reserved==0)
	            		$reserved="No";

				        echo "<tr>";
				        echo "<td> $title </td><td> $author </td>";
				        echo '<td><a href="reservebook.php?bookid=' . urlencode($bookid) . '">Reserve</a></td>';
				        echo "</tr>";
				    }
				    echo "</table>";
				    ?>
				</div>
			</div>

		</main>
	</body>

	<?php include("footer.php"); ?>
</html>
