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