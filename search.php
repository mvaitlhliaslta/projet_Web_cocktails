<?php 
	//include 'Donnees.inc.php';
	if (isset($_GET["search"])) { // check if search entry was submitted
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
				
				$message = "";
				if (!empty($aliments_souhaites)) {
					$message .= "<p>aliments souhaités: ".implode(', ', $aliments_souhaites)."</p>\n";
				}
				if (!empty($aliments_non_souhaites)) {
					$message .= "<p>aliments non souhaités: ".implode(', ', $aliments_non_souhaites)."</p>\n";
				}
				if (!empty($aliments_non_reconnus)) {
					$message .= "<p>aliments non reconnus: ".implode(', ', $aliments_non_reconnus)."</p>\n";
				}
				// case: impossible display search
				if (empty($aliments_souhaites) && empty($aliments_non_souhaites)) {
					$message = "<p>Problème dans votre requête : recherche impossible</p>\n";
				}
			}
		}
	}
?>

<div class="search">
<p>Rechercher:</p>
<form method="get" action="#">
<input type="text" name="search_input">
<input type="submit" name="search" value="Valider" />
</form >
<?php
if (isset($_GET["submit"])){
	echo "$message";
}
?>
</div>
