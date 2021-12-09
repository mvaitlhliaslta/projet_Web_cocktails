	<?php
		include("nav.php");
	
		$ingrList = array($current_root);
		
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
		
		function synthDisplay($recipeIndex)
		{
			global $Recettes;
			$recipe = $Recettes[$recipeIndex];
			$result = 
			'<li>
				<div class="wrapper">
					<div class="title">
						<p>'.$recipe['titre'].'</p>
					</div>';
			
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
			</li>
			';
				
			echo $result;
		}
		
		findIngr($current_root);
		$ingrList = array_unique($ingrList, SORT_STRING); //bug de la fonction unique qui marche pas RESOLUE : il fallait assigner une valeur au resultat de la fonction (comme la liste elle meme par exemple)
		//print_r($ingrList);
	?>
	
	<div class="synthDisp">
		<ul>
			<?php
				foreach($Recettes as $recipe => $content)
				{
					foreach($content['index'] as $ingredient)
					{
						if(in_array($ingredient, $ingrList)) //si la recette contient un ingredient dans ingrList
						{
							synthDisplay($recipe);
							break;
						}
					}
				}
			?>
</ul>
	</div>
		