<?php 
	// used in <a href=$link> where $link isn't allowed to have " "
	function spaceToPlus($string){
		return str_replace(" ", "+", $string);
	}
	function plusToSpace($string){
		return str_replace("+", " ", $string);
	}

	function synthDisplay($recipeIndex)
		{
			global $Recettes;
			global $current_root;
			$recipe = $Recettes[$recipeIndex];
			if (isset($_SESSION["user"]["username"])) {
				$path = "user/".$_SESSION["user"]["username"];
				$user = json_decode(file_get_contents($path), true);

				// check if recette in favorite
				$in_favorite = in_array($recipeIndex, $user["favorite"]);
			}
			else{
				$in_favorite = false;
			}
			

			$result = '
				<div class="col-sm-4 border">
					<div class="title">
						<a href="?current_cat='.spaceToPlus($current_root).'&dispState=detail&ID='.$recipeIndex.'">'.$recipe['titre'].'</a>
					</div>';

			// check if recette in favorite
			if ($in_favorite) {
				$button = '<button class="favoriteBtnOn" type="button" onClick="fav(this,'.$recipeIndex.')"></button>';
			}
			else{
				$button = '<button class="favoriteBtnOff" type="button" onClick="fav(this,'.$recipeIndex.')"></button>';
			}

			$result .= $button;
			
			$imgFormat = array('.png', '.jpg');
			foreach($imgFormat as $format)
			{
				$dirname = 'Photos/'.str_replace(' ', '_', $recipe['titre']);
				$dirname = $dirname.$format;
				if(file_exists($dirname))
				{
					$result = $result.
					'<div class="photo">'.
						'<img src="'.$dirname.'" alt="Recipe Illustration">'.
					'</div>';
				}
			}
			
			$result = $result.'
					<div class=simpleIngrList>
						<ul>';
			
			foreach($recipe['index'] as $ingredient)
			{
				$result = $result.'
							<li>'.$ingredient.'</li>';
			}
			
			$result = $result.'
						</ul>
					</div>
				</div>
			
			';
				
			echo $result;
		}
		
	function findIngr($root)
		{
			global $Hierarchie;
			global $ingrList;
			
			if(!array_key_exists('sous-categorie', $Hierarchie[$root]))
			{
				$ingrList[] = $root;
			}
			else {
				foreach($Hierarchie[$root]['sous-categorie'] as $cat)
				{
					$ingrList[] = $root;
					findIngr($cat);
				}
			}
		}


	//fonction pour l'affichage du fil d'Ariane
	//$root => la categorie dans laquelle se trouve l'utilisateur		
	function init_ariane($root)
		{
			global $Hierarchie;
			$act_root = $root;
			$result = '
	<p>';
			
			while($act_root != 'Aliment')
			{		
				$upper_cat = $Hierarchie[$act_root]['super-categorie'][0];
				$result = substr_replace($result, " / ".'<a href="?current_cat='.spaceToPlus($upper_cat).'">'.$upper_cat.'</a>', 6, 0);
				$act_root = $upper_cat;
			}
			return $result." / ".'<a href="?current_cat='.spaceToPlus($root).'">'.$root.'</a></p>'."\n";
		}
?>