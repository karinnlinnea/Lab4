<link rel="stylesheet" href="main.css">
<meta charset="utf-8">
<link href="https://fonts.googleapis.com/css?family=Quicksand:300,400,500,700" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:300,400,700" rel="stylesheet">

<?php

if(isset($_FILES['upload'])){

    $allowedextensions = array('jpeg', 'gif', 'png', 'jpg');
    $extension = strtolower(substr($_FILES['upload']['name'], strpos($_FILES['upload']['name'], '.') +1));

    $error = array();

    if(in_array($extension, $allowedextensions) === false) {
        $error[] = "<p id=errortextone>This file does not have an allowed extension</p>";
    }

    if($_FILES['upload']['size']>10000000) {
        $error[] = "<p id=errortexttwo>Your file is too big</p>";
    }

    if(empty($error)) {
        move_uploaded_file($_FILES['upload']['tmp_name'], "uploadedfiles/{$_FILES['upload']['name']}");
    } else {

    }
    }
?>

<html>
    <head>
        <title>Upload a file</title>
    </head>
    <body>
    <a href="gallerypage.php" id="backbutton">❮ BACK TO GALLERY</a>
        <div id="uploadcontent">
            <h2>CHOOSE A FILE TO UPLOAD</h2>
            <h3>REMEMBER:</h3>
            <p>- Maximum file size is 10mb</p>
            <p id="bottomp">- We only accept JPEG, JPG, PNG and GIF</p>
            <form action="" method="POST" enctype="multipart/form-data">
                <input type="file" name="upload">
                </br>
                <input id="submitbutton" type="submit" value="Upload">
            </form>
            <?php

    if(isset($error)) {
        if(empty($error)) {
            echo '<a id="uploadlinkone" href="uploadedfiles/'.$_FILES['upload']['name'].'">YOUR UPLOADED FILE';
            echo "</br>";
            echo '<a id="uploadlinktwo" href="gallerypage.php">Go to gallery</a>';
        } else {
            foreach ($error as $err) {
            echo $err;
            echo '</br>';
            }
        }
    }

    ?>
        </div>


    </body>
</html>
