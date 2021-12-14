<?php
	$recipe = $Recettes[$_GET["ID"]];

	if (isset($_SESSION["user"]["username"])) {
		$path = "user/".$_SESSION["user"]["username"];
		$user = json_decode(file_get_contents($path), true);

		// check if recette in favorite
		$in_favorite = in_array($_GET["ID"], $user["favorite"]);
	}
	else{
		$in_favorite = false;
	}
	

	$result = '
		<div class="detailRecipe">
			<div class="title">
				<p>'.$recipe['titre'].'</p>';

	if($in_favorite) {
		$button = '<button class="favoriteBtnOn" type="button" onClick="fav(this,'.$_GET["ID"].')"></button>';
	}
	else{
		$button = '<button class="favoriteBtnOff" type="button" onClick="fav(this,'.$_GET["ID"].')"></button>';
	}
	$result .= $button;
	
			

	$imgFormat = array('.png', '.jpg');
	foreach($imgFormat as $format)
	{
		$dirname = 'assets/Photos/'.str_replace(' ', '_', $recipe['titre']);
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
		$result = $result.'<li>'.$ingr.'</li>';
	}
			
	$result = $result.'</ul>
						</td>
						<td>
							<p>'.$recipe['preparation'].'</p>
						</td>
					</tr>
				</table>';
			
	$result = $result.'</div>';
			
			echo $result;
	?>