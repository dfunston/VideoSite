<?php

//require 'src/mysql.php';

//In future, add email verification
//Put a $_GET in up here to check if verify=true and get verification code if so.

if($_POST["submitted"]==true){
	//Get code for use in following steps
	if(!isset($mySQLImported)){
		require 'mysql.php';
	}
	
	$success=true;
	$errors="";
	
	$user=htmlspecialchars($_POST["username"]);
	$email=htmlspecialchars($_POST["email1"]);

	$return=myConnect(0,0);
	
	if($return[1]!=0){
		echo "Error connecting to MySQL. " . $return[2];
	}
	
	$myCon=$return[0];
	
	$queryUser="SELECT Username, Email FROM Users WHERE Username=$user";
	$queryEmail="SELECT Username, Email FROM Users WHERE Email=$email";
	
	$userResults=mysqli_query($myCon, $queryUser);
	$emailResults=mysqli_query($myCon, $queryEmail);
	
	//echo "User results: " . $userResults . "<br> Email results: " . $emailResults;
	
	if($emailResults!=NULL){
		//Suggest forgot password page
		$success=false;
		$error="Email address has already been used. Have you <a href='forgotpass.php'>forgotten your password?</a>";
	}else if($userResults!=NULL){
		//Error:  Username already taken
		$success=false;
		$error="Sorry, this username has already been used!";
	}
	
	if($success==true){
		//Insert all data into the table
		//$date=time();
		$passHash=htmlspecialchars(crypt($_POST["password1"]));
		$avatar="placeholder";
		//$token="0";
		if($_POST["desc"]!=""){
			$desc=htmlspecialchars($_POST["desc"]);
			$query="INSERT INTO `Users` (`Username`, `Passhash`, `Email`, `Description`)
				VALUES ('$user', '$passHash', '$email', '$desc')";
		}else{
			//$desc=NULL;
			$query="INSERT INTO `Users` (`Username`, `Passhash`, `Email`)
			VALUES ('$user', '$passHash', '$email')";
		}
		
		
		$results=mysqli_query($myCon, $query);
		//var_dump $results;
		if($results===FALSE){
			echo "Error: " . mysqli_error();
		}else{
			echo "Registered successfully!";
		}
		echo $query;
		//echo $results;
	}
	
	mysqli_close($myCon);
	
}

?>

<html>
<head>
<title>Register new account</title>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

<style>

	.label{
		text-align: right;
	}
	
	.user{
		text-align: right;
	}
	
	.pass{
		text-align: right;
	}
	
	.email{
		text-align: right;
	}

</style>

</head>
<body>

<?php

if($_POST["submitted"]==true && $success==true){
	/*
	echo $_POST["username"];
	echo $_POST["password1"];
	echo $_POST["email1"];
	echo $_POST["description"];
	*/
	
	
	
	//this will be a confirmation page eventually
	//Perhaps have an email verification page here as well.
//}else if($_POST["submitted"]==true $$ $success==false){

	

}else{

//TODO: Create javascript verification of entered information
//TODO: Avatar.  I guess.
?>
	<div id="regform">
	<p id="error">
	
	<?php
		if($errors!=""){
			echo $errors;
		}
	?>
	
	</p>
	<table>

		<form id="regForm" method="Post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
	
			<tr>
				<td class="user">Username:</td>
				<td><input type="text" id="username" name="username" /></td>
			</tr>
			
			<tr>
				<td class="pass">Password:</td>
				<td><input type="password" id="password1" name="password1" /></td>
			</tr>
			
			<tr>
				<td class="pass">Repeat password:</td>
				<td><input type="password" id="password2" name="password2" /></td>
			</tr>
			
			<tr>
				<td class="email">Email:</td>
				<td><input type="text" id="email1" name="email1" /></td>
			</tr>
			
			<tr>
				<td class="email">Repeat email:</td>
				<td><input type="text" id="email2" name="email2" /></td>
			</tr>
			
			
			
			<!--
			
			'<tr>
				<td>Avatar:</td>
				<td><input type="hidden" name="avatar" value="placeholder.jpg" /></td>
			</tr>'
			
			-->
			
			<tr>
				<td class='label'>Bio:</td>
				<td><textarea rows="5" columns="40" name="desc"></textarea></td>
			</tr>
			
			<tr>
				<td colspan="2" align="center"><input type=button onClick="verify()" value="Submit" /></td>
			</tr>
		
			<input type="hidden" name="submitted" value="true" />
		
		</form>
	
	</table>
	
	</div>

<?php
}
?>

<script type="text/javascript">

	var verify = function()
	{
	
		//TODO: Get more checks in place
		/*
		
			Ideas for checks:
			
			*Verify email address is valid (account for periods and + text in email)
			*Password rulesets (min length, possibly rules for numbers, letters, and symbols)
			*Verify username and password are not identical
			
		
		*/

		var subFlag=true;
		var err="";
			
		var user=document.getElementById("username");
		var pass1=document.getElementById("password1");
		var pass2=document.getElementById("password2");
		var email1=document.getElementById("email1");
		var email2=document.getElementById("email2");

		if(user.value==""){
			err+="Please enter a username!<br>";
			//document.getElementsByClassName("user").style.color="red";
			$('td.user').css('color','red');
			subFlag=false;
		}
				
		if(pass1.value!=pass2.value){
			err+="Passwords do not match!<br>";
			//document.getElementsByClassName("pass").style.color="red";
			$('td.pass').css('color','red');
			subFlag=false;
		}else if(pass1.value==""){
			err+="Please enter a password!<br>";
			$('td.pass').css('color','red');
		} //TODO: check for password length here
				
		if(email1.value!=email2.value){
			err+="Emails do not match!<br>";
			//document.getElementsByClassName("email").style.color="red";
			$('td.email').css('color','red');
			subFlag=false;
		}else if(email1.value==""){
			err+="Please enter an email address!<br>";
			$('td.email').css('color','red');
		} //TODO: Verify email here
			
		console.log(subFlag);			
		console.log(err);
			
		if(subFlag==true){
			//document.getElementById("regForm").submit;
			$('#regForm').submit();
		}else{
			$('p#error').html(err);
			console.log('Errors should be updated.');
		}
		
		//return 0;
	
	}

</script>

</body>
</html>