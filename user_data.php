<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User_info</title>
</head>
<body>
<h1>Modification de données</h1>
<h2>Voici les données entré</h2>
<?php
    // on recuper le ficher qui a le mot de l'user
    // on decode le ficher JSON
    $path = "user\\".$_SESSION["username"];
    $user = json_decode(file_get_contents($path), true);

    //on echo tout les données 
    echo "
    Username: ".$user['username'],"<br/>
    Password: ".$user['password'],"<br/>
    Nom: ".$user['nom'],"<br/>
    Prenom: ".$user['prenom'],"<br/>
    Genre: ".$user['genre'],"<br/>
    Email: ".$user['email'],"<br/>
    Date de naissence: ".$user['date_de_naissence'],"<br/>
    Adresse: ".$user['adresse'],"<br/>
    Code postal: ".$user['code_postal'],"<br/>
    Ville: ".$user['ville'],"<br>
    Numéro de telephone: ".$user['numero_de_telephone'];

if(isset($_POST['modification_btn'])){
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
    $numero_de_telephone = $_POST['numero_de_telephone'];
    //controle si tout les données sont bien rentré (pas fini)
    //DEV ----- DEV
    $path = "user\\".$_POST["username"];
    
    //on stocke tout dans un array
    $user = array(
        "username" => $username,
        "password" => $password,
        "nom" => $nom,
        "prenom" => $prenom,
        "genre" => $genre,
        "email" => $email,
        "date_de_naissence" => $date_de_naissence,
        "adresse" => $adresse,
        "code_postal" => $code_postal,
        "ville" => $ville,
        "numero_de_telephone" => $numero_de_telephone,

    );
    //encodeage de l'array dans un ficher JSON
    //set cookie pour recup le nom de l'user 
    file_put_contents($path, JSON_encode($user));
    header("Location:index.php");
}
?>

<h3>Modifiez les données souhaiter, puis appuyer sur le button modifier!</h3>
<form action="user_data.php" method="post" >
        Login Name:
        <br><input type = "text"  name = "username"  value="<?php echo $user['username'] ?>" readonly="readonly" require/><br>

        Password:
        <br><input type = "text" name = "password" require value="<?php echo $user['password'] ?>"/><br>

        Nom:
        <br><input type = "text"  name = "nom" value="<?php echo $user['nom'] ?>"/><br>

        Prénom:
        <br><input type = "text"  name = "prenom" value="<?php echo $user['prenom'] ?>"/><br>

        Genre:<br>
        <input type="radio" name="genre" value="female">Female<br>
        <input type="radio" name="genre" value="male" >Male<br>

        Email:
        <br><input type="email" name="email" value="<?php echo $user['email'] ?>"/> <br>

        Date de naissence:
        <br><input type="date" name="date_de_naissence" value="<?php echo $user['date_de_naissence'] ?>"/> <br>

        Adresse:
        <br><input type = "text"  name = "adresse" value="<?php echo $user['adresse'] ?>"/><br>

        Code postal:
        <br><input type = "text"  name = "code_postal" value="<?php echo $user['code_postal'] ?>"><br>

        Ville:
        <br><input type = "text"  name = "ville" value="<?php echo $user['ville'] ?>"/><br>

        <br/>
        <br/>
    <input type = "submit" name="modification_btn" id = "submit" value = "Modifier"/>
</form>

</body>
</html>

