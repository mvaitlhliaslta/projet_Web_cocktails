<?php 
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
	function init_ariane($root)
		{
			global $Hierarchie;
			$act_root = $root;
			$result = '
	<p>';
			
			while($act_root != 'Aliment')
			{		
				$upper_cat = $Hierarchie[$act_root]['super-categorie'][0];
				$result = substr_replace($result, " / ".'<a href="?current_cat='.$upper_cat.'">'.$upper_cat.'</a>', 6, 0);
				$act_root = $upper_cat;
			}
			return $result." / ".'<a href="?current_cat='.$root.'">'.$root.'</a></p>'."\n";
		}
?>