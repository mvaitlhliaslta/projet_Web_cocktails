<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>


<?php
if(isset($_POST['submit_btn'])){
    //on recupere tout ($_POST)
    $username = $_POST['username'];
    $password = $_POST['password'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $genre = $_POST['genre'];
    $email = $_POST['email'];
    $date_de_naissence = $_POST['date_de_naissence'];
    $adresse = $_POST['adresse'];
    $code_postal = $_POST['code_postal'];
    $ville = $_POST['ville'];

    //controle si tout les données sont bien rentré (pas fini)
    //DEV ----- DEV
    $path = "user\\".$_POST["username"];
    if(file_exists($path)){
        echo "Ce login exite déja";
        exit(); 
    }
    
    //on stocke tout dans un array
    $user = array(
        "username" => $username,
        "password" => sha1($password),
        "nom" => $nom,
        "prenom" => $prenom,
        "genre" => $genre,
        "email" => $email,
        "date_de_naissence" => $date_de_naissence,
        "adresse" => $adresse,
        "code_postal" => $code_postal,
        "ville" => $ville,
    );
    //encodeage de l'array dans un ficher JSON
    //set cookie pour recup le nom de l'user 
    file_put_contents($path, JSON_encode($user));
    setcookie("username", $username);
    header("Location:index.php");
}
?>

<body>

<!-- Syteme pour s'inscrire HTML -->
    <form action="register.php" method="post" >
    <h1> Please enter your information to register</h1>
        Login Name:
        <br><input type = "text"  name = "username" require/><br>

        Password:
        <br><input type = "password" name = "password" require/><br>

        Nom:
        <br><input type = "text"  name = "nom" /><br>

        Prénom:
        <br><input type = "text"  name = "prenom" /><br>

        Genre:<br>
        <input type="radio" name="genre" value="female">Female<br>
        <input type="radio" name="genre" value="male" >Male<br>

        Email:
        <br><input type="email" name="email" /> <br>

        Date de naissence:
        <br><input type="date" name="date_de_naissence" /> <br>

        Adresse:
        <br><input type = "text"  name = "adresse" /><br>

        Code postal:
        <br><input type = "text"  name = "code_postal" /><br>

        Ville:
        <br><input type = "text"  name = "ville" /><br>

        <br/>
        <br/>
     <input type = "submit" name="submit_btn" id = "submit" value = "submit"/>
    </form>
    <a href="index.php">index.php</a>
</body>
</html>