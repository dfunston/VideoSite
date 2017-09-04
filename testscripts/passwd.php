<?php
$pass=$_POST["pass"];
$hash=crypt($pass);
echo $hash . "<br>";
if(crypt($_POST["pass"], $hash)==$hash){
	echo "Verified.";
}
?>
<html>
<head>
<title>Pass</title>
</head>
<body>
<form method="post" action="passwd.php">
password:<input type="text" name="pass">
<input type="submit" name="submit" value="Submit">
</form>


</body>
</html>