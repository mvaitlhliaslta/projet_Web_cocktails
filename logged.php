<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logged</title> 
</head>
<body>
    <h1>TU EST LOGGED</h1>
    <p>Voic t'es information entrer</p>
    <?php
    // on recuper le ficher qui a le mot de l'users
    // on decode le ficher JSON
    $path = "user\\".$_COOKIE["username"];
    $user = json_decode(file_get_contents($path), true);
    
    //on echo tout les données 
    echo "Username: ".$user['username'];
    echo "<br>password: ".$user['password'];
    echo "<br>nom: ".$user['nom'];
    echo "<br>prenom: ".$user['prenom'];
    echo "<br>genre: ".$user['genre'];
    echo "<br>email: ".$user['email'];
    echo "<br>date_de_naissence: ".$user['date_de_naissence'];
    echo "<br>adresse: ".$user['adresse'];
    echo "<br>code_postal: ".$user['code_postal'];
    echo "<br>ville: ".$user['ville']; 

    ?>
    <br>
    <a href="logout.php">logout</a><br>
    <a href="register.php">register.php</a>
</body>
</html>