<?php

function startSession($user){
	
	//return token
	return $_SESSION['token'];
}

function validateSession(){
	//Session validation
	
	//Until built, will return false
	return false;
}

?>