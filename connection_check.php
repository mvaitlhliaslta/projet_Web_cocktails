<?php
//system de login,
//On decode le ficher JSON du bon user
//on verifie que les données entrer sont les même que dans le ficher
//on set le cookie pour recup les bonnes valeurs lorsqu'il est logged 

error_reporting(E_ALL ^ E_WARNING);

if(isset($_POST['submit_btn'])){
  $path = "user\\".$_POST["username"];
  $ok = false;
  if(isset($_POST['username']) &&  $_POST['username'] == null){
    echo " Le login ou le mot de passe n'est pas bon ! ";
    $ok = true;
  }elseif(isset($_POST['password']) &&  $_POST['password'] == null){
    echo " Le login ou le mot de passe n'est pas bon ! ";
    $ok = true;
  }elseif(!file_get_contents($path)){
    echo " Ce login n'existe pas! ";
    $ok = true;
  }elseif(!$ok){
    $user = json_decode(file_get_contents($path), true);
    if($user["username"] == $_POST["username"] && $user["password"] == $_POST["password"]){
      $_SESSION["username"] = $user["username"];
    }else{
      echo " Le login ou le mot de passe n'est pas bon ! ";
    }
  }
}

?>