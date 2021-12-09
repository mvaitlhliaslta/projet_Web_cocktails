<?php
session_start();
include "connection_check.php";
if(isset($_SESSION["user"][$user_name]){
	$_SESSION["user"][$user_name] = 0;
}
header("location: index.php");
?>