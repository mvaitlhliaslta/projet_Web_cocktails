<?php  
	include 'Donnees.inc.php';
	session_start();

	$path = "user/".$_SESSION["user"]["username"];
	$user = json_decode(file_get_contents($path), true);
	$user["favorite"][] = $_GET["ID"];
	$recette = $Recettes[$_GET["ID"]]["titre"];
	file_put_contents($path, JSON_encode($user));
	echo $recette." ajouté aux favoris!";
?>