	<?php

		//creation de la chaine de caracteres des sous-categorie de la categorie courrante
		$disp_sous_cat = '
	<ul>';

		if(array_key_exists('sous-categorie', $Hierarchie[$current_root]))
		{
			foreach($Hierarchie[$current_root]['sous-categorie'] as $under_cat)
			{
				$disp_sous_cat = $disp_sous_cat.'
		<li><a href="?current_cat='.spaceToPlus($under_cat).'">'.$under_cat.'</a></li>';
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
