<?php

/*

Ok, going to try to make some sense of my login system and page structure here.

Each loaded page will be using a header, which will contain the opening HTML and require most of the files I should need, such as mysql.php

They will also have a footer for closing the HTML

The content of the page outside of the header and footer will be contained in it's own div ID'd as pagecontent

With some finangling, I should be able to make it so that if I want to in the future, I can call jQuery's AJAX functions and load just the portion of code
inside of pagecontent, and have the PHP ignore topbar and such if it isn't needed.  Can potentially have AJAX place a hidden form and input with a POST method
somewhere in the body, and have PHP check for that hidden POST input and ignore the headers, instead opting to skip straight to the libraries and content

Structure will go something like this:

$title='Whatever the page title is';

if(!isset($_POST["ajax"])){
	require 'header.php';
}else{
	Whatever needs to be done here
}

*BODY CONTENT HERE*

if(!isset($_POST["ajax"])){
	require 'footer.php';
}

*/

?>