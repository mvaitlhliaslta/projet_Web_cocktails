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
<h2>Voici les données entrées</h2>
<?php
    // on recuper le ficher qui a le mot de l'user
    // on decode le ficher JSON
    $path = "../users/". $_SESSION["user"]["username"];
    $user = json_decode(file_get_contents($path), true);

    //on echo tout les données 



    // depart des verifications 
    if (isset($_POST['modification_btn'])) {
        
        if(isset($_POST['password']) &&  $_POST['password'] == null){
            $incorrectFields[] = "Le mot de passe est obligatoire ! ";
        }

		//Nom
		if(isset($_POST['nom']) && $_POST['nom'] != null) {
			if (!preg_match("/^[a-zA-Z' -]+$/", trim($_POST['nom']))) {
				$incorrectFields[] = "Nom";
			}
		}


		//Prénom
		if(isset($_POST['prenom']) && $_POST['prenom'] != null) {
			if (!preg_match("/^[a-zA-Z' -]+$/", trim($_POST['prenom']))) {
				$incorrectFields[] = "Prénom";
			}
		}

		//Sexe

		if(isset($_POST['genre'])) {
			if(($_POST['genre']) != ("male" || "female")) {
				$incorrectFields[] = "Genre";
			}
		}

		//Date de naissance

		if(isset($_POST['date_de_naissance']) && $_POST['date_de_naissance'] != null) {
			list($year, $month, $day) = explode("-", $_POST['date_de_naissance']);
			if (!checkdate($month, $day, $year)) { 
				$incorrectFields[] = "Date de naissance";
			} else {

				$birthDate = new Datetime($_POST['date_de_naissance']);
				$current_date = new Datetime();
                
                $diff = $birthDate->diff($current_date);

				if ($diff > 18) {
				} else {
					$incorrectFields[] = "Date de naissance";
				}
			}

		}


		//Adresse
		if(isset($_POST['adresse']) && $_POST['adresse'] != null) {
			//adresse ne peut pas être rempli sans le code postal et la ville qui vont avec
			//mis dans deux if différents parce qu'on peut par ex avoir rempli la ville et l'adresse mais pas le code postal
			//dans ce cas, code postal est ajouté dans incorrectFields à la fois dans ville et dans adresse 
			if ((isset($_POST['ville']) && $_POST['ville'] == null && !in_array("ville", $incorrectFields))) { 
				$incorrectFields[] = "Ville";				
			}
			if ((isset($_POST['code_postal']) && $_POST['code_postal'] == null && !in_array("code postal", $incorrectFields))) { 
				$incorrectFields[] = "Code postal";		
			}
		}


		//Code postal
		if(isset($_POST['code_postal']) && $_POST['code_postal'] != null) {
			//prend en compte les codes postaux de la Corse, le plus petit code postal existant (01000, celui de Bourg-en-Bresse) et le plus grand existant (99999, celui de la Poste)
			if (!preg_match("/^(0[1-9][0-9]{3})$|^([1-9][0-9]{4})$|^(2[AB][0-9]{3})$/", trim($_POST['code_postal']))) { 
				$incorrectFields[] = "Code postal";
			}
			//code postal ne peut pas être rempli sans l'adresse et la ville qui vont avec
			if ((isset($_POST['adresse']) && $_POST['adresse'] == null && !in_array("adresse", $incorrectFields))) { 
				$incorrectFields[] = "Adresse";
			}
			if ((isset($_POST['ville']) && $_POST['ville'] == null && !in_array("ville", $incorrectFields))) { 
				$incorrectFields[] = "Ville";
			}
		}


		//Ville
		if(isset($_POST['ville']) && $_POST['ville'] != null) {
			//ville ne peut pas être rempli sans le code postal et l'adresse qui vont avec
			if ((isset($_POST['code_postal']) && $_POST['code_postal'] == null && !in_array("code postal", $incorrectFields))) { 
				$incorrectFields[] = "Code postal";
			}
			if ((isset($_POST['adresse']) && $_POST['adresse'] == null && !in_array("adresse", $incorrectFields))) {
				$incorrectFields[] = "Adresse";
			}
		}

		//Numéro de téléphone

		if(isset($_POST['numero_de_telephone']) && $_POST['numero_de_telephone'] != null) {
			if (!preg_match("/^0[0-9]{9}+$/", trim($_POST['numero_de_telephone']))) { 
				$incorrectFields[] = "Numéro de téléphone";
			}
		}

        // on afficeh tout les champs dans les quels il y a des erreurs
        if(!empty($incorrectFields)){
            echo "<h3> voici les données mal renseignées</h3>";
            foreach($incorrectFields as $Fields)
                echo $Fields. "<br>";
        }else{
            //on recupere tout ($_POST)
            $username = $_POST['username'];
            $password = $_POST['password'];
            $nom = $_POST['nom'];
            $prenom = $_POST['prenom'];
            $genre = isset($_POST['genre']) ? $genre : "";
            $email = $_POST['email'];
            $date_de_naissance = $_POST['date_de_naissance'];
            $adresse = $_POST['adresse'];
            $code_postal = $_POST['code_postal'];
            $ville = $_POST['ville'];
            $numero_de_telephone = $_POST['numero_de_telephone'];
            $favorite = $user["favorite"];
            //controle si tout les données sont bien rentré (pas fini)


            //on stocke tout dans un array
            $user = array(
                "username" => $username,
                "password" => $password,
                "nom" => $nom,
                "prenom" => $prenom,
                "genre" => $genre ,
                "email" => $email,
                "date_de_naissance" => $date_de_naissance,
                "adresse" => $adresse,
                "code_postal" => $code_postal,
                "ville" => $ville,
                "numero_de_telephone" => $numero_de_telephone,
                "favorite" => $favorite,
            );

            //encodeage de l'array dans un ficher JSON
            //set cookie pour recup le nom de l'user 
            file_put_contents($path, JSON_encode($user));
        }
    }
    $user = json_decode(file_get_contents($path), true);
    echo "
    Username: ".$user['username'],"<br/>
    Password: ".$user['password'],"<br/>
    Nom: ".$user['nom'],"<br/>
    Prenom: ".$user['prenom'],"<br/>
    Genre: ".$user['genre'],"<br/>
    Email: ".$user['email'],"<br/>
    Date de naissance: ".$user['date_de_naissance'],"<br/>
    Adresse: ".$user['adresse'],"<br/>
    Code postal: ".$user['code_postal'],"<br/>
    Ville: ".$user['ville'],"<br>
    Numéro de telephone: ".$user['numero_de_telephone'];
?>

<h3>Modifiez les données souhaiter, puis appuyer sur le button modifier!</h3>
<form action="user_data.php" method="post" >
        Login Name:
        <br><input type = "text"  name = "username"  value="<?php echo $user['username'] ?>" readonly="readonly" required="required"/><br>

        Password:
        <br><input type = "text" name = "password" required="required" value="<?php echo $user['password'] ?>"/><br>

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
        <br><input type="date" name="date_de_naissance" value="<?php echo $user['date_de_naissance'] ?>"/> <br>

        Adresse:
        <br><input type = "text"  name = "adresse" value="<?php echo $user['adresse'] ?>"/><br>

        Code postal:
        <br><input type = "text"  name = "code_postal" value="<?php echo $user['code_postal'] ?>"><br>

        Ville:
        <br><input type = "text"  name = "ville" value="<?php echo $user['ville'] ?>"/><br>

        Numero de téléphone:
        <br><input type = "text"  name = "numero_de_telephone" value="<?php echo $user['numero_de_telephone'] ?>"/><br>

        <br/>
        <br/>
    <input type = "submit" name="modification_btn" id = "submit" value = "Modifier"/>
</form>
<a href="../index.php">Retour au menu principal</a>
</body>
</html>

