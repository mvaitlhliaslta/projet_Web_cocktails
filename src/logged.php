<?php
    // on recuper le ficher qui a le mot de l'user
    // on decode le ficher JSON
    $path = "users/".$_SESSION["user"]["username"];
    $user = json_decode(file_get_contents($path), true);

    //on echo tout les données 

    echo "Nom: ".$user['nom']. " Prenom: ".$user['prenom'];
?>
<br>
<input type="button" onclick="location.href='src/user_data.php'" value = "Mes Informations"/>
<input type="button" onclick="location.href='src/logout.php'" value = "Deconnexion"/>

