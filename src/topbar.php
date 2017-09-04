<?php 

require 'session.php'; 
require 'login.php';

//Build some scripts to handle being logged in and not being logged in.

function loggedIn($name, $avatar){

	$loggedInHTML="<image src=$avatar></image>Welcome, $name!<br><a href='logout.php'>Log out</a>";
	return $loggedInHTML;
	
}

function loggedOut(){
	
	$loggedOutHTML='<a href="login.php">Log in</a>';
	return $loggedOutHTML;

}

//TODO: Build AJAX login script


?>
<tr>
	<td id="logo">
		<image src="img/logo.jpg" />
	</td>
	
	<td id="searchbar">
		<?php
		
			//Handle searchbar code around here.
			echo "Insert searchbar here.";
		
		?>
	</td>
	
	<td id="account">
		<?php
		
			if(isset($_SESSION["token"])){
				//Run session check here
				$loggedIn=checkSession();
				if($loggedIn[0]!=0){
					//User not logged in
					//Handle it
					echo loggedOut();
				}else{
					//User is logged in
					//Handle it
					echo loggedIn($_SESSION["user"], $_SESSION["avatar"]);
				}
				
			}else{
				//Put in login stuff
				echo loggedOut();
			}
			
			
		?>
	</td>

</tr>

<div id="login">

	<table>
		<form method="Post" action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>">
	
			<tr>
				<td>Username:</td>
				<td><input type="text" name="user"/></td>
			</tr>
			
			<tr>
				<td>Password:</td>
				<td><input type="password" name="pass" /></td>
			</tr>
			
			<tr>
			
				<td colspan="2" align="center"><input type="checkbox" name="remember" /> Remember me?</td>
			
			</tr>
			
			<tr>
				<td colspan="2" align="center"><input type="submit" name="submit" value="Submit" /></td>
			</tr>
			
		</form>
		
		<tr>
			<td colspan="2" align="center"><a href="forgotpass.php">Forgot Password?</a> | <a href="register.php">Register</a></td>
		</tr>
	
	</table>

</div>