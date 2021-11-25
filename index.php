<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Homepage</title>
</head>
<body>
	<header></header>
	<nav>
		<h1>Aliment courrant:</h1>
		<!-- insert Path -->
		Sous-catégories : <br>
		<?php 
		include 'Donnees.inc.php';
		$active = $Hierarchie["Aliment"];
		$list = $active["sous-categorie"];

		echo "<ul>";
		foreach ($list as $key => $value) {
			echo "<li>$value</li><br>\n";
		}
		echo "</ul>";

		?>
		<!-- insert categories -->
	</nav>
	<main>
		
	</main>

	<!-- jsp s'il nous faut un footer -->
	<footer></footer>
</body>
</html>