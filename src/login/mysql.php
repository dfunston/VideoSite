<?php

$mySQLImported=true;

function myConnect($user, $data){
	
	//Initialize variables.
	
	//User that can delete data and drop tables
	//Use sparingly
	$vidAdmin='AdminUser';
	$admPass='AdminPass';
	
	//User that can search for data
	//Use normally
	$vidUser='UserUser';
	$usrPass='UserPass';
	//Has Create, Insert, Update, and Select
	//on vidComments and vidSite
	
	//Databases
	$dbVids='VidDatabase';
	$dbComm='CommentsDatabase';
	
	//Server location.  Shouldn't need changing generally.
	$host='localhost';

	//Initialize Return variable with ideal data
	$return[0]=NULL;
	$return[1]=0;
	$return[2]='OK';

	//Select which user to use
	if($user==0){
		$dbUser=$vidUser;
		$dbPass=$usrPass;
		//echo 'reguser<br>';
	}else if($user==1){
		$dbUser=$vidAdmin;
		$dbPass=$admPass;
		//echo 'admuser<br>';
	}else{
		$return[0]=NULL;
		$return[1]=-2;
		$return[2]="Error: Incorrect argument passed";
		//return $return;
	}
	
	//Select database to use
	if($data==0){
		$dbData=$dbVids;
		//echo 'viddb<br>';
	}else if($data==1){
		$dbData=$dbComm;
		//echo 'comdb<br>';
	}else{
		$return[0]=NULL;
		$return[1]=-2;
		$return[2]="Error: Incorrect argument passed";
		//return $return;
	}
	
	//Connect or die
	$return[0]=mysqli_connect($host, $dbUser, $dbPass, $dbData);
	
	//echo $dbUser . "<br>" . $dbPass . "<br>" . $dbData . "<br>";
	
	if(mysqli_connect_errno()){
		$return[0]=NULL;
		$return[1]=-1;
		$return[2]='Error:  Failed to connect to MySQL. ' . mysqli_connect_error();
	}
	
	return $return;
	
}


?>