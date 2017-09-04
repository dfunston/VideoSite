<?php
session_start();

//require 'session.php';

require 'mysql.php';

if(isset($_POST["sub"])){
	//All of this only runs if the user has posted information from the login form
	
	$result = myConnect(0,0);
	if($result[1]!=0){
		$response = "Error: Could not connect to mysql! " . $result[2];
		$loggedIn=false;
	}else{
		$myCon=$result[0];
		$username=$_POST["user"];
		$rawPass=$_POST["pass"];
		$query="SELECT `Passhash` FROM `Users` WHERE `Username`='$username'";
		$result=null;
		$result=mysqli_query($myCon, $query);
		if(mysqli_num_rows($result)==0){
			//The following is for debug purposes ONLY
			$response="No such username found!";
			//Use the following for production
			//$response="Incorrect username or password!";
			$loggedIn=false;
		}else{
			while($row=mysqli_fetch_array($result)){
				$passHash=$row["Passhash"];
			}
			if($passHash!=crypt($rawPass, $passHash)){
				//The following is for debug purposes ONLY
				$response="Incorrect password!";
				//Use the following for production
				//$response="Incorrect username or password!";
				$loggedIn=false;
			}else{
				//TODO: start session
				require 'randhash.php';
				//Session constructor
				$_SESSION['user'] = $user;
				$_SESSION['token']= lolzRandom(25);
				$query="UPDATE `Users` SET `Token`='$token' WHERE `Username`='$username'";
				if(mysqli_query($myCon, $query)==false){
					$response="Error: Unable to update token.  Login failed!";
					$loggedIn=false;
				}else{
					$loggedIn=true;
				}
			}
		}
	}
	mysqli_close($myCon);
}else if(isset($_POST["logout"])){
	$result = myConnect(0,0);
	if($result[1]!=0){
		$response = "Error: Could not connect to mysql! " . $result[2];
		$loggedIn=false;
	}else{
		$myCon=$result[0];
		$username=$_SESSION["user"];
		$query="UPDATE `Users` SET `Token`='' WHERE `Username`='$username'";
		if(mysqli_query($myCon, $query)==false){
			echo "Error logging out! Token did not update!";
		}
		mysqli_close($myCon);
		session_destroy();
	}
}else if(isset($_SESSION['token'])){
	$username = $_SESSION['user'];
	$loggedIn=true;
}else{
	$loggedIn=false;
}

?>

<!DOCTYPE html>
<html>
<head>
<title><?php echo $title; ?></title>

<link rel="stylesheet" type="text/css" href="stylesheet.css">

</head>
<body>

<div id="logo"><a href="home.php"><image src="logo.jpg" /></a></div>

<div id="search">
	<form id="search" method="get" action="search.php">
		<input type="text" name="search" />
		<input type="submit" name="submit" value="Search" />
	</form>
</div>

<div id="account">
<?php
$self = htmlspecialchars($_SERVER["PHP_SELF"]);
if($loggedIn==true){
?>

	<p id="loggedIn">Logged in as <?php echo $username; ?>.</p>
	<form id="logout" method="post" action="<?php echo $self; ?>">
		<input type="hidden" name="logout" value="true" />
		<input type="submit" name="submit" value="Logout" />
	</form>
<?php
}else{
?>
	<table id="login">
		<tr>
			<td colspan="2" align="center">
				<p id="response"><?php echo $response; ?></p>
			</td>
		</tr>
		<form method="Post" action="<? echo $self; ?>">
	
		<tr>
			<td>Username:</td><td><input type="text" name="user" /></td>
		</tr>
		<tr>
			<td>Password:</td><td><input type="password" name="pass" /></td>
		</tr>
		<tr>
			<td colspan="2" align="center">
				<input type="hidden" name="sub" value="true" />
				<input type="submit" name="submit" value="Submit." />
			</td>
		</tr>
		
		</form>
	</table>
<?php
}
?>
</div>
