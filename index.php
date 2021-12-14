<?php
	session_start();

	include 'inc/Donnees.inc.php';
	include 'inc/Functions.inc.php';

	$connection_message = connection_check();
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
	<link rel="stylesheet" href="assets/style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  	<?php if(isset( $_SESSION["user"]["username"])){ ?>
  		<script src="assets/js/functions.js"></script>
	<?php } ?>
</head>

<body>
<header>
	<!-- Favorite button-->
	<input id="favBtn" type="button" value="Favoris" 
       onclick="window.location.href = '?favorites=1'" />

	<!-- navigation button -->
	<input id="navBtn" type="button" value="Navigation" 
       onclick="window.location.href = '?'" />

	<!-- search engine -->
	<?php
		include 'inc/search.php';
	?>

	<!-- Affichage d'un contenu differant si un user est connecter ou pas -->
	<?php
	// verification si un user est connecté
	//include "inc/connection_check.php";
	echo "$connection_message";
	if(isset( $_SESSION["user"]["username"])){
		include('inc/logged.php');
		?>
		
		<?php
	}else{
		// zone de saisie (username + password + login_button)
		include('inc/connection.php');
	}
	?>
	<div id="ajoutOuRetraitFav"></div>
</header>

<!-- nav section only exists when no search query was sent -->

<?php if (!isset($_GET["search"])) { ?>
		<nav>
			<?php include 'inc/nav.php'; ?>
		</nav>
<?php } ?>


<main>
	<?php if (isset($_GET["search"])){ // of search querry submitted
			include 'inc/displays/displaySearch.php';

		} elseif (isset($_GET["favorites"])) {
			include 'inc/displays/displayFavorite.php';
		} else {
			include('inc/displays/displayNav.php');	
		} 
	?>
</main>

</body>
</html>