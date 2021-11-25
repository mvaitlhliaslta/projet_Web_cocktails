<?php
	include("Donnees.inc.php");
	if(isset($_GET["current_cat"]))
	{
		$current_root = $_GET["current_cat"];
	} else 
	{
		$current_root = 'Aliment';
	}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Les cocktails les cocktails !</title>
	<meta charset="utf-8" />
</head>

<body>

	<?php		
		function init_ariane($root)
		{
			global $Hierarchie;
			
			$act_root = $root;
			$result = '
	<p>Aliment ';
			
			while($act_root != 'Aliment')
			{		
				foreach($Hierarchie as $categorie => $content)
				{
					if($categorie == $act_root)
					{
						if($content['super-categorie'][0] != 'Aliment') 
						{
							$result = substr_replace($result, " / ".$content['super-categorie'][0], 13, 0);
						}
						$result = $result." / ".$categorie;
						$act_root = $content['super-categorie'][0];
						break;
					}
				}
			}
			return $result.'</p>'."\n";
		}
		
		$disp_sous_cat = '
	<ul>';
	
		foreach($Hierarchie as $categorie => $content)
		{
			foreach($content as $cat_type => $cat)
			{
				if($cat_type == 'super-categorie' && current($cat) == $current_root)
				{
					$disp_sous_cat = $disp_sous_cat.'
		<li><a href="?current_cat='.$categorie.'">'.$categorie.'</a></li>';
				}
			}
		}
		$disp_sous_cat = $disp_sous_cat.'
	</ul>';
	?>
	
	<p><strong>Aliment Courant</strong></p>
	<?php echo(init_ariane($current_root)); ?>
	<p>Sous-catégories :</p>
	<?php echo $disp_sous_cat; ?>
	
</body>
</html>