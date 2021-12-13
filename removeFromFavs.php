<?php  
	include 'Donnees.inc.php';
	session_start();

	$path = "user/".$_SESSION["user"]["username"];
	$user = json_decode(file_get_contents($path), true);
	// remove from favorite array
	if (($key = array_search($_GET["ID"], $user["favorite"])) !== false) {
    	unset($user["favorite"][$key]);
	}
	$recette = $Recettes[$_GET["ID"]]["titre"];
	file_put_contents($path, JSON_encode($user));
	echo $recette." retiré des favoris!";
?>