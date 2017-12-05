<!DOCTYPE html>
<html>
	<head>
		<title>My books</title>
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
				<div id="mybookscontent">
					<h2>RESERVED BOOKS</h2>
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

                    $query = " select title, author, reserved, bookid from books where reserved is true";
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
                    $stmt->bind_result($title, $author, $reserved, $bookid);
                    $stmt->execute();

                    echo '<table bgcolor="dddddd" cellpadding="6">';
                    echo '<tr><td><b>TITLE</b></td> <td><b>AUTHOR</b></td></tr>';
                    while ($stmt->fetch()) {
                        if($reserved==1)
                            $reserved="Yes";
                       
                        echo "<tr>";
                        echo "<td> $title </td><td> $author </td>";
                        echo '<td><a href="returnbooks.php?bookid=' . urlencode($bookid) . '">Return</a></td>';
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