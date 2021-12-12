<?php
session_start();
	include "connection_check.php";
	$status = false;
	if(isset($_COOKIE["$user_name"])){
		$status = $_COOKIE["$user_name"]; 
	}
	
?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>Gestion de cocktails</title>
</head>

<body>

<nav>
	<?php
	if($status == true){
		include("logged.php");
	}else{
		include("connection.php");
	}
	include("nav.php");
	?>
</nav>

</body>

</html>