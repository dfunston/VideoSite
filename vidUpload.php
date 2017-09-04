<?php
//File upload script functions:
require 'src/upload.php';

$response=null;

require 'src/header.php';

if(!isset($mysqlLoaded)){
	require 'src/mysql.php';
}

if($_POST["submitted"]==true){
	$result=myConnect(0,0);
	if($result[1]!=0){
		$response += "Error: Failed to connect to MySQL. " . $result[2] . "<br>";
	}else{
		$myCon=$result[0];
		//debug
		echo "myssql connected. ";
		if(!isset($randLoaded)){require 'src/randhash.php';}
		
		$hFlag = false;
		while($hFlag == False){
			$vidID = lolzRandom(8);
			$query="SELECT * FROM `Video` WHERE 'Identifier'=$vidID";
			$hashResult=mysql_query($myCon, $query);
			echo "Generated hash. ";
			$response += mysqli_num_rows($hashResult) . "<br>";
			if(mysqli_num_rows($hashResult)==0){
				echo "Hash was ok. ";
				$hFlag=true;
				$response += $vidID . "<br>";
			}
		}

		$upResult = fileUpload($vidID);
		if($upResult[0] != 0)
		{
			echo "Error while up loading. ";
			//$response += $upResult[1] . "<br>";
			echo $upResult[1] . "<br>";
		}else{
			echo " Upload good. Continuing. ";
			$title=htmlspecialchars($_POST["title"]);
			$fileLoc=htmlspecialchars($upResult[2]);
			$desc=htmlspecialchars($_POST["desc"]);
			$username=$_SESSION["user"];
			$tags=htmlspecialchars($_POST["tags"]);
			$rate="0;0;0;0;0";
			$views="0";
			$query = "INSERT INTO `Video` (`Identifier`, `Title`, `Location`,
				`Description`, `Uploader`, `Tags`, `Rating`, `Views`) 
				VALUES ('$vidID', '$title', '$fileLoc', '$desc', '$username', '$tags', '$rate', '$views')";
			echo $query;
			if(mysqli_query($myCon, $query)==false){
				echo "ERROR: " . mysqli_error($myCon) . "<br>";
				echo " Error while inserting sql. ";
			}else{
				$response += "Video uploaded successfully!<br>";
				echo " Upload successful. ";
			}
		}
		mysqli_close($myCon);
	}	
		
	$result=myConnect(0,1);
	if($result[1]!=0){
		$response += "Error: Failed to connect to MySQL. " . $result[2] . "<br>";
	}
	$myCon=$result[0];
	$query = "CREATE TABLE `vid$vidID` (
		'vidID' text,
		'userID' text,
		'comment' text,
		'time' timestamp,
		'ID' int NOT NULL AUTO_INCREMENT,
		PRIMARY KEY(ID)
		)";
	if(mysqli_query($mycon, $query)==false){
		$response += "ERROR: " . mysqli_error($myCon);
	}else{
		$response += "Comment table created successfully!<br>";
	}
	mysqli_close($myCon);
}

$title = "Upload new video | Inebriated Studios Video Site Test";

//$self=htmlspecialchars($_SERVER['PHP_SELF']);

if($_SESSION['user']!=""){
?>

<div id='body'>

<p id='response'><?php echo $response; ?></p>

<form enctype="multipart/form-data" action="<?php echo $self; ?>" method="post" enctype="multipart/form-data">
	<table>
		<tr>
			<td>File: </td>
			<td><input type="file" name="file" id="file"></td>
		</tr>
		<tr>
			<td>Title: </td>
			<td><input type="text" width="100%" name="title"></td>
		</tr>
		<tr>
			<td>Description: </td>
			<td><textarea rows=5 cols=40 name="desc"></textarea></td>
		</tr>
		<tr>
			<td>Tags (separated by semicolon): </td>
			<td><textarea rows=5 cols=40 name="tags"></textarea></td>
		</tr>
		<tr>
			<td colspan=2 align="center">
				<input type="hidden" name="submitted" value="true">
				<input type="submit" name="submit" value="Submit">
			</td>
		</tr>
	</table>
</form>
</div>

<?php
}else{
?>
<div id='body'>
	<p>
		You need to be logged in to upload a video!  Please login or register above to continue!
	</p>
</div>
<?php
}

require 'src/footer.php';

?>