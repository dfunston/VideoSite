 <?php

 //require 'mysql.php';

/*

Ok, going to try to map out what should happen here.

Session should store almost every piece of data from the database for a working memory of logged in users.
Cookie should store a few vital pieces of information, namely the session token, username, and maybe one or two other things.
Session should keep the token, username, user's name, email, and a few extra bits in it's memory.

On page load, if the cookie is set, the system will check the cookie's token against the server's token.  If they match,
the server will continue on like normal.  If they don't match, the user will be logged out (the cookie will be 'deleted').

If the token doesn't exist in session memory (the user is coming back from an old session), the server will check the
token against the database, which has the last used token code saved.  If they match, the session will be restored as if
the user never left at all.  

If they do not match, the cookie will be marked for deletion, the token will be deleted from the database, and the user will need to
log in again.

This PHP file should handle all session validation and be required by the other pages.

When finished building, this will be moved into a folder along with some other files that are needed for various purposes.





Database data:
* Username
* Email
* Password (stored as a hash)


*/



//TODO: Make this script not rely heavily on cookies, as users may have them disabled.
//This works in the interrim.


function checkSession(){
	if(isset($_COOKIE["token"])){
		
		//client Session supposedly exists, go on to validate it.
		
		if(isset($_SESSION["token"])){
			
			//Server session supposedly exists, go on to validate it.
			
			if($_COOKIE["token"]==$_SESSION["token"]){
				$return[0]=0;
			}else{
				$return[0]=-1;
				logOut();
			}
		}else{
			//Check saved user token
			$result=myConnect(0,0);
			if($result[1]!=0){
				echo "Error: Could not connect to MySQL. " . $result[2];
			}
			$myCon=$result[0];
			$token=$_COOKIE["token"];
			$user=$_COOKIE["user"];
			$query="SELECT * FROM Users WHERE Username=$user";
			
			$sqlRun = mysqli_query($myCon, $query);
			while($row=mysqli_fetch_array($sqlRun)){
				$dataUser=$row["Username"];
				$dataToken=$row["Token"];
				$dataEmail=$row["Email"];
				$dataAvatar=$row["Avatar"];
			}
			if($token==$dataToken){
				$_SESSION["token"]=$_COOKIE["token"];
				$_SESSION["user"]=$dataUser;
				$_SESSION["email"]=$dataEmail;
				$_SESSION["avatar"]=$dataAvatar;
				$return[0]=0;
			}else{
				$return[0]=-1;
				logOut();
			}
			mysqli_close($myCon);
		}
	}else{
	
		$return[0]=1;
		
	}
	
	//Return cases:
	//$return[0]==0:  Session validated, continue as normal.
	//$return[0]==-1: Session invalid, logging out.
	//$return[0]==1:  Session does not exists/cookies are not allowed.
	return $return;
}

function logOut(){
	//Delete session
	session_destroy();
	//Set cookie to expire
	setcookie("token", "", time()-3600);
	setcookie("user", "", time()-3600);
	setcookie("email", "", time()-3600);
}

?>