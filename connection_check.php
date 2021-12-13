<?php
//system de login,
//On decode le ficher JSON du bon user
//on verifie que les données entrer sont les même que dans le ficher
//on set le cookie pour recup les bonnes valeurs lorsqu'il est logged 

error_reporting(E_ALL ^ E_WARNING);

if(isset($_POST['submit_btn'])){
  $path = "user\\".$_POST["username"];
  $error = false;
  if(isset($_POST['username']) &&  $_POST['username'] == ""){
    echo " Le login ou le mot de passe n'est pas bon ! ";
    $error = true;
  }elseif(isset($_POST['password']) &&  $_POST['password'] == null){
    echo " Le login ou le mot de passe n'est pas bon ! ";
    $error = true;
  }elseif(!file_get_contents($path)){
    echo " Ce login n'existe pas! ";
    $error = true;
  }elseif($error == false){
    $user = json_decode(file_get_contents($path), true);
    if(strcmp($user["username"],$_POST["username"]) == 0 && strcmp( $user["password"],$_POST["password"]) == 0){
      $_SESSION["user"]["username"] = $user["username"];
    }else{
      echo " Le login ou le mot de passe n'est pas bon ! ";
    }
  }
}

?>