<!--<div class="navDisp">-->
	<?php
		// get display state (either "synthetic" or "detailed")
		if(isset($_GET["dispState"]))
		{
			$disp = $_GET["dispState"];
		} else
		{
			$disp = 'synth';
		}

		$ingrList = array($current_root);
				
		findIngr($current_root);
		$ingrList = array_unique($ingrList, SORT_STRING);
		
		if(strcmp($disp , 'detail') == 0)
		{ 	
			include 'displayDetailed.php';
		} 
		else//if($disp == 'synth')
		{
			include 'displaySynth.php';
		}?>
<!--</div>-->