<?php
	
	//require 'mysql.php';
	require 'randhash.php';

	if(isset($_POST["user"])){
		$result=myConnect(0,0);
		if($result[1]!=0){
			echo "ERROR: could not connect to MySQL. " . $result[2];
		}
		
		$myCon=$result[0];
		
		$username=$_POST["user"];
		
		$query="SELECT * FROM `Users` WHERE `Username`='$username'";
		
		//Debug
		echo $query . "<br>";
		
		$queryResult=mysqli_query($myCon, $query);
		
		//TODO: modify the above to check for either username or email address.
		
		while($row=mysqli_fetch_array($queryResult)){
		
			$dataUser=htmlspecialchars_decode($row["Username"]);
			$dataPass=htmlspecialchars_decode($row["Passhash"]);
		
		}
		
		//Debug
		//echo $username . ", " . $dataUser . "<br>";
		//echo $dataPass . "<br>";
		
		if(crypt($_POST["pass"], $dataPass)==$dataPass){
			//Handle user logged in
			
			//Data to get:
			//Username (already gotten above
			//Avatar
			//Email
			
			//Create and store session token
				
			//Store username and token in cookies
			while($row=mysqli_fetch_array($queryResult)){
				
				$dataAvatar=htmlspecialchars_decode($row["Avatar"]);
				$dataEmail=htmlspecialchars_decode($row["Email"]);
				
			}
				
			$dataToken=lolzRandom(25); //Create a 25 digit token code for user to use for cookies and session
				
			$query="UPDATE Users SET Token=$dataToken WHERE Username=$dataUser";
				
			mysqli_query($myCon, $query);
				
			if($_POST["remember"]==true){
				$cookieTime=Time()+(60*60*24*30); //Expire cookie in a month
			}else{
				$cookieTime=Time()+3600; //Expire cookie in an hour, maybe make longer?
			}
				
			//Set cookies up
			setcookie("token", $dataToken, $cookieTime);
			setcookie("user", $dataUser, $cookieTime);
			//Set sessions up
			session_start();
			$_SESSION["user"]=$dataUser;
			$_SESSION["avatar"]=$dataAvatar;
			$_SESSION["email"]=$dataEmail;
			$_SESSION["token"]=$dataToken;
				
			Echo "Successfully logged in!";
				
		}else{
			//echo "Incorrect login or password!<br>";
			//echo crypt($_POST["pass"],$dataPass) . "<br>";
			//echo $dataPass . "<br>";
		}
			
		mysqli_close($myCon);
	}else{
		
	}

?>