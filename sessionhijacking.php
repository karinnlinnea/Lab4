<?php

ini_set('session.cookie_httponly', true);

session_start();

if(isset($_SESSION['userip']) === false) {
	$_SESSION['userip'] = $_SERVER['REMOTE_ADDR'];
}

if($_SESSION['userip'] !== $_SERVER['REMOTE_ADDR']) {
	session_unset();
	session_destroy();
}

?>