<?php

if(!isset($_SESSION["numLoads"])){
	session_start();
	//$_SESSION["set"]=true;
	//$_SESSION["numLoads"]=0;
}

?>

<html>
<head>
<title>Variable source test</title>
</head>
<body>

<?php
echo $_SESSION["numLoads"];

if($_SESSION["numLoads"]==0){

?>
<h1>This page has not loaded before</h1>
<p>This is some sample text for the unloaded page.</p>
<?php

$_SESSION["numLoads"]+=1;
}else{

?>
<h2>This page has been loaded at least once</h2>
<p>If the page has loaded before, you will see this.</p>
<?php
$_SESSION["numLoads"]=0;
}

echo $_SESSION["numLoads"];
?>

</body>
</html>