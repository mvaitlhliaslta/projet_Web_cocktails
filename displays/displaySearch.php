<?php 
	
	
	$sorted_recettes = array();
	$valide_recette = true;

	foreach ( $aliments_souhaites as $key => $aliment) {
		// aliment souhaite in recette 
		foreach ($Recettes as $recipe_key => $arr_content) {
			if (in_array($aliment, array_values($arr_content["index"]))) { 

				//recette has no aliment in aliment_non_souhaites
				foreach ($aliments_non_souhaites as $key => $aliment_non_souhaite) {
					if (in_array($aliment_non_souhaite, array_values($arr_content["index"]))) {
						$valide_recette = false;
					}
				}

				if($valide_recette){

					$title = $arr_content["titre"];
					// add to sorted_recettes if not already in it
					if (!array_key_exists($title , $sorted_recettes)) {
					// set number of matches by 1 / first match
						$sorted_recettes[$title] = 1;
					}

					else { // increment the number of matches by 1
						$sorted_recettes[$title] += 1;
					}
				}
			}

			$valide_recette = true;
		
		}
	}

	// sort array
	arsort($sorted_recettes);
	//print_r($sorted_recettes);
	// display
	echo "<p>Recettes contenant les aliments souhaités</p>";
	foreach ($sorted_recettes as $recette => $occurence) {
		foreach ($Recettes as $recipe_key => $arr_content) {
			if (strcmp($arr_content["titre"], $recette) == 0){
				synthDisplay($recipe_key);
			}
		}
	}

	// display
	echo "<p>Recettes ne contenant pas les aliments non souhaités:</p>";
	
	$recettes_sans_aliment_non_souhaites = array();
	foreach ($aliments_non_souhaites as $key => $aliment_non_souhaite) {
		foreach ($Recettes as $recipe_key => $arr_content) {
			if(!in_array($aliment_non_souhaite, array_values($arr_content["index"]))) {
				synthDisplay($recipe_key);
			}
		}
	}

?>








