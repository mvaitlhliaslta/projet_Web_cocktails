<?php
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
	?>