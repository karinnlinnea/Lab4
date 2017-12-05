<?php

$url = $_SERVER['REQUEST_URI'];

$strings = explode('/', $url);

$current_page = end($strings);

$dbname = 'thebookclub';
$dbuser = 'root';
$dbpass = 'root';
$dbserver = 'localhost';

#the following three will get you the current page, how?
#first you assign the URI (which is the end of the URL as we talked on the Lecture 2)
#You get that by using the superglobal $_SERVER['REQUEST_URI']
#then you create a new variable $strings which contains every string seperated by a "/" from the $url - hard to follow, ha?
#now that you have all strings 

//$url = $_SERVER['REQUEST_URI'];
//print_r($url);
//echo "</br>";
//$strings = explode('/', $url);
//print_r($strings);
//echo "</br>";
//$current_page = end($strings);
//print_r($current_page);
//echo "</br>";
//$dbname = 'library';
//$dbuser = 'root';
//$dbpass = '';
//$dbserver = 'localhost';
?>