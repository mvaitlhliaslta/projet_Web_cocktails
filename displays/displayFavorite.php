<?php
<<<<<<< HEAD
	if($_GET["favDisp"] == true){
		
=======
	if (isset($_SESSION["user"]["username"])) {
		$path = "user/".$_SESSION["user"]["username"];
		$user = json_decode(file_get_contents($path), true);

		foreach ($user["favorite"] as $key => $id) {
			synthDisplay($id);
		}
>>>>>>> 9d9c95083c7dd9d0c4bac9987da215e1c1c6bdfe
	}
?>