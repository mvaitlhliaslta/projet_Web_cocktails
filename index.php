<?php
	include("Donnees.inc.php");
	//on verifie si l'aliment courant est precisier dans l'entete
	//et on affecte sa valeur en fonction de
	if(isset($_GET["current_cat"]))
	{
		$current_root = $_GET["current_cat"];
	} else 
	{
		$current_root = 'Aliment';
	}
	
	if(isset($_GET["dispState"]))
	{
		$disp = $_GET["dispState"];
	} else
	{
		$disp = 'synth';
	}
?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1">
	<title>Gestion de cocktails</title>
	<link rel="stylesheet" href="style.css">
</head>

<body>

<nav>
	<!-- INSERT : barre de recherche, button de navigation (nav, favorites, search), button de UserManagement -->
</nav>

<main>
	<?php
		include("displays/displayNav.php");
	?>
</main>

</body>

</html>