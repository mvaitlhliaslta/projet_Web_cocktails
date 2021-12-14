<?php 

	//session_start();
	if (isset($_SESSION["user"]["username"])) {
		$path = "users/".$_SESSION["user"]["username"];
		$user = json_decode(file_get_contents($path), true);
		foreach ($user["favorite"] as $key => $id) {
			synthDisplay($id);
		}
	}
 ?>