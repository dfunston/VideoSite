<?php
if(!isset($mysqlLoaded)){
	require 'src/mysql.php';
}
$vidLoc=$_GET['v'];
$query="SELECT * FROM `Video` WHERE `Identifier`='$vidLoc'";

$result=myConnect(0,0);
if($result[1]!=0){
	echo "Error: Failed to connect to MySQL. " . $result[2] . "<br>";
}
$myCon=$result[0];

$result = mysqli_query($myCon,$query);

while($row=mysqli_fetch_array($result)){

	$vidTitle=$row['Title'];
	$vidSrc=$row['Location'];
	$desc=$row['Description'];
	$auth=$row['Uploader'];
	$postDate=$row['Date'];
	$tagCloud=$row['Tags'];
	$rateCloud=$row['Rating'];
	$views=$row['Views'];
	
}

//Generate ratings:
$bFlag=false;
$rClEnd=strlen($rateCloud);
$y=0;
//echo $rateCloud . '<br>' . $rClEnd . '<br>';
for($i=1;$i<=5;$i++){
	while($bFlag==false && $y <= $rClEnd){
		$wChar=subStr($rateCloud, $y, 1);
		if($wChar==';'){
			$bFlag=true;
		}else{
			$rate[$i] = $rate[$i] . $wChar;
		}
		$y++;
	}
	$bFlag=false;
	//Debugging
	//echo 'rate ' . $i . ': ' . $rate[$i] . '<br>';
}

//Calculate Rating
$fullRating = ($rate[1] + ($rate[2] * 2) + ($rate[3] * 3) + ($rate[4] * 4) + ($rate[5] * 5)) / ($rate[1] + $rate[2] + $rate[3] + $rate[4] + $rate[5]);

$title = $vidTitle . " | Inebriated Studios Video Site Test";

require 'src/header.php';

?>
<div id='body'>
<h2 class='title'><? echo $vidTitle; ?></h2>
<div id='video'>
<video width="100%" height="100%" controls>
  	<source src="vid/<?php echo $vidLoc . ".mp4"; ?>" type="video/mp4">
	<!--<source src="vid/<?php echo $vidLoc . ".ogg"; ?>" type="video/ogg">-->
	Your browser does not support the video tag.
</video> 
</div>
<div id="stuff">
<div id='comments'>
<?php
	//TODO: handle comments here
	
	for($i=0; $i<100; $i++){
		?>
		<div class='comment'>
		<h7><?php echo "placeholder user"; ?></h7>
		<p><?php echo "placeholder comment"; ?></p>
		</div>
		<?php
	}
?>
</div>
<div id='related'>
<?php
	//TODO: handle related videos here
	for($i=0; $i<30; $i++){
		?>
		<div class='rvideo'>
		<?php
		echo 'Related video.<br>';
		?>
		</div>
		<?php
	}
?>
</div>
</div>

</div>

<?php

require 'src/footer.php';

//Close MySQL connection
mysqli_close($myCon);
?>