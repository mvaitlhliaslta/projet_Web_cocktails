<?php opcache_reset();
	if (isset($_GET["submit"])) { // check if search entry was submitted
		if (isset($_GET["search_input"])) { // check if search_input exists
			

			$aliments_souhaites = array();
			$aliments_non_souhaites = array();
			$aliments_non_reconnus = array();

			$invalid_entry = false;

			$user_entry = $_GET["search_input"];
			
			// count if number of " is pair
			if (substr_count($user_entry, "\"") % 2 == 1) { // incorrect number of "
				$invalid_entry = true;
				$message = "Problème de syntaxe dans votre requête : nombre impair de double-quotes";
			}
			
			if (!$invalid_entry) {
				// divide user input in $matches	
				// magic regex, it works, don't question it.
				$pattern = '#([-\+]?"[a-zA-Z\'\s]+")|([-\+]?[a-zA-Z\'-]+)#i'; 
				//				+		d'orange 		-		zae-az
				// preg_match_all returns a lot of stuff, we only need the first key
				preg_match_all($pattern, $user_entry, $matches);
				$matches = array_reverse($matches);
				$matches = array_pop($matches);
				include 'Donnees.inc.php';
				
				foreach ($matches as $key => $aliment) {
					
					if (strcmp(substr($aliment, 0, 1), '-') == 0) { // add to aliments non souhaités
						$quote = array('"',"-");
						$replace  = "";
						$aliment = str_replace($quote, "", $aliment);
							if (array_key_exists($aliment, $Hierarchie)) {
							$aliments_non_souhaites[] = $aliment;
						} else {
							$aliments_non_reconnus[] = $aliment;
						}
					}
					else{
						$quote = array('"',"+");
						$replace  = "";
						$aliment = str_replace($quote, "", $aliment);
							if (array_key_exists($aliment, $Hierarchie)) {
							$aliments_souhaites[] = $aliment;
						} else {
							$aliments_non_reconnus[] = $aliment;
						}
					}
				}
				//array_push($_GET, $aliments_souhaites);
				$_GET["aliments_souhaites"] = $aliments_souhaites;
				$_GET["aliments_non_souhaites"] = $aliments_non_souhaites;
				$_GET["aliments_non_reconnus"] = $aliments_non_reconnus;
				$message = "";
				if (!empty($_GET["aliments_souhaites"])) {
					$message .= "aliments souhaités: ".implode(', ', $_GET["aliments_souhaites"])."<br>";
				}
				if (!empty($_GET["aliments_non_souhaites"])) {
					$message .= "aliments non souhaités: ".implode(', ', $_GET["aliments_non_souhaites"])."<br>";
				}
				if (!empty($_GET["aliments_non_reconnus"])) {
					$message .= "aliments non reconnus: ".implode(', ', $_GET["aliments_non_reconnus"])."<br>";
				}
				if (empty($_GET["aliments_souhaites"]) && empty($_GET["aliments_souhaites"])) {
					$message = "Problème dans votre requête : recherche impossible<br>";
				}
			}
			echo "$message";
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>yes</title>
</head>
<body>

Rechercher:
<form method="get" action="#">
<input type="text" name="search_input">
<input type="submit" name="submit" value="Valider" />
</form >

</body>
</html>
