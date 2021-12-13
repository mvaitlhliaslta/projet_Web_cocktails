<?php
	session_start();
	
	include "Donnees.inc.php";
	include 'functions.inc.php';

	//on verifie si l'aliment courant est precisier dans l'entete
	//et on affecte sa valeur en fonction
	if(isset($_GET["current_cat"]))
	{
		$current_root = plusToSpace($_GET["current_cat"]);
	} else 
	{
		$current_root = 'Aliment';
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>	
	<meta charset="utf-8">
	<title>Gestion de cocktails</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<link rel="stylesheet" href="style.css">
</head>

<body>
<header>
	<!-- navigation button -->
	<input id="navBtn" type="button" value="Navigation" 
       onclick="window.location.href = '?'" />
	
	<!-- search engine -->
	<?php
		include 'search.php';
	?>

	<a href="?favDisp=<?php if(isset($_SESSION['user'])){ echo "true"; } else { echo "false"; } ?>">
		<button type="button">Recettes favorites</button>
	</a>

	<!-- Affichage d'un contenu differant si un user est connecter ou pas -->
	<?php
	// verification si un user est connecter 

	include "connection_check.php";
	if(isset( $_SESSION["user"]["username"])){
		include("logged.php");
	echo "
	<script>
		function fav(btn,recipeIndex)
		{
			if(btn.className == \"favoriteBtnOff\")
			{
				btn.className = \"favoriteBtnOn\"
				window.alert(\"recipeIndex\");
			}
			else
			{
				btn.className = \"favoriteBtnOff\";
			}
		}
	</script>
	";
	}else{
		include("connection.php");
	}
	?>

</header>

<!-- nav section only exists when no search query was sent -->
<?php 
	if (!(isset($_GET["search"]) || isset($_GET["favDisp"]))) { ?>
		<nav>
			<?php 
				include 'nav.php';
			?>
		</nav>
	<?php }
?>


<main>
	<?php
		if (isset($_GET["search"])){ // of search querry submitted
			include 'displays/displaySearch.php';
		}
		else if(isset($_GET["favDisp"])){
			include("displays/displayFavorite.php");
		}
		else
			include("displays/displayNav.php");	
	?>
</main>

</body>
</html>