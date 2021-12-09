	<?php

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
				$result = substr_replace($result, " / ".'<a href="?current_cat='.$upper_cat.'">'.$upper_cat.'</a>', 6, 0);
				$act_root = $upper_cat;
			}
			return $result." / ".'<a href="?current_cat='.$root.'">'.$root.'</a></p>'."\n";
		}
		
		
		//creation de la chaine de caracteres des sous-categorie de la categorie courrante
		$disp_sous_cat = '
	<ul>';

		if(array_key_exists('sous-categorie', $Hierarchie[$current_root]))
		{
			foreach($Hierarchie[$current_root]['sous-categorie'] as $under_cat)
			{
				$disp_sous_cat = $disp_sous_cat.'
		<li><a href="?current_cat='.$under_cat.'">'.$under_cat.'</a></li>';
			}
		}
		
		$disp_sous_cat = $disp_sous_cat.'
	</ul>'."\n";
	?>

<!-- Affichage HTML des chaines de caracteres du fil d'Ariane et des sous-categories -->
	<div class="sidenav">
	<p><strong>Aliment Courant</strong></p>
	<?php echo(init_ariane($current_root)); ?>
	<p>Sous-catégories :</p>
	<?php echo $disp_sous_cat; ?>
	</div>
