<?php
//system de login,
//On decode le ficher JSON du bon user
//on verifie que les données entrer sont les même que dans le ficher
//on set le cookie pour recup les bonnes valeurs lorsqu'il est logged 
  
if(isset($_POST['submit_btn'])){
  $path = "user\\".$_POST["username"];    
  $user = json_decode(file_get_contents($path), true);
  $user_name = $user["username"];
    if($user["username"] == $_POST["username"] && $user["password"] == sha1($_POST["password"])){
        $_SESSION["user"][$user_name] = 1;
    }else{
      echo "Mauvais login ou mot de passe";
    }
}
?>

