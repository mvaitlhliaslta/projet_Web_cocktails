<div class="navDisp">
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
			global $current_root;
			$recipe = $Recettes[$recipeIndex];
			$result = 
			'
				<div class="synthRecipe">
					<div class="title">
						<a href="?current_cat='.$current_root.'&dispState=detail&ID='.$recipeIndex.'">'.$recipe['titre'].'</a>
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
					<button class="favoriteBtnOff" type="button" onClick="fav(this)"></button>
				</div>
			
			';
				
			echo $result;
		}
				
		findIngr($current_root);
		$ingrList = array_unique($ingrList, SORT_STRING); //bug de la fonction unique qui marche pas RESOLUE : il fallait assigner une valeur au resultat de la fonction (comme la liste elle meme par exemple)
		
		
		if($disp == 'detail')
		{ 	
			$recipe = $Recettes[$_GET["ID"]];
			$result = '
			<div class="detailRecipe">
				<div class="title">
					<p>'.$recipe['titre'].'</p>
					<button class="favoriteBtnOff" type="button" onClick="fav(this)"></button>
				</div>';
				
			$imgFormat = array('.png', '.jpg');
			foreach($imgFormat as $format)
			{
				$dirname = 'Photos/'.str_replace(' ', '_', $recipe['titre']);
				$dirname = $dirname.$format;
				if(file_exists($dirname))
				{
					$result = $result.'
				<div class="photo">
					<img src="'.$dirname.'" alt="Recipe Illustration">
				</div>';
				}
			}
			
			$expIngrList = explode("|", $recipe['ingredients']);
			$result = $result.'
				<table class="recipePrep">
					<tr>
						<th>Liste des ingrédients</th>
						<th>Préparation</th>
					</tr>
					<tr>
						<td>
							<ul>
							';
			
			foreach($expIngrList as $ingr)
			{
				$result = $result.'<li>'.$ingr.'</li>
								';
			}
			
			$result = $result.'
							</ul>
						</td>
						<td>
							<p>'.$recipe['preparation'].'</p>
						</td>
					</tr>
				</table>';
			
			$result = $result.'
			</div>';
			
			echo $result;
		} 
		elseif($disp == 'synth')
		{
		?>
	<div class="synthDisp">
			<?php
				foreach($Recettes as $recipeIndex => $content)
				{
					foreach($content['index'] as $ingredient)
					{
						if(in_array($ingredient, $ingrList)) //si la recette contient un ingredient dans ingrList
						{
							synthDisplay($recipeIndex);
							break;
						}
					}
				}
			?>
	</div>
		<?php
		}
		?>
</div>