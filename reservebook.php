<link rel="stylesheet" href="main.css">
<meta charset="utf-8">
<link href="https://fonts.googleapis.com/css?family=Quicksand:300,400,500,700" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:300,400,700" rel="stylesheet">

<?php

include("config.php");

$bookid = trim($_GET['bookid']);
echo '<INPUT type="hidden" name="bookid" value=' . $bookid . '>';

$bookid = trim($_GET['bookid']);
$bookid = addslashes($bookid);

@ $db = new mysqli($dbserver, $dbuser, $dbpass, $dbname);

    if ($db->connect_error) {
        echo "could not connect: " . $db->connect_error;
        printf("<br><a href=index.php>Return to home page </a>");
        exit();
    }

    $stmt = $db->prepare("UPDATE books SET reserved=1 WHERE bookid = ?");
    $stmt->bind_param('i', $bookid);
    $stmt->execute();
    printf("<img class=bookimg src=booklogo.png></img>");
    printf("<h2 class=returnReserve>BOOK RESERVED!</h2>");
    printf("<br><br><a class=reservelinks href=browsebookspage.php>Search/reserve more books</a>");
    printf("<br><a class=reservelinks href=mybookspage.php>My reserved books</a>");
    printf("<br><a class=reservelinks href=index.php>Return to home page</a>");
    exit;
    
?>