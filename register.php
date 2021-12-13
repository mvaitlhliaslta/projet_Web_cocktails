<?php
session_start();

date_default_timezone_set('Europe/Paris');
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
	$incorrectFields = [];

	//checks if the form is submitted or not
	if (isset($_POST['submit_btn'])) {
       
        if(isset($_POST['username']) &&  $_POST['username'] == null){
            $incorrectFields[] = "Le login est obligatoire ! ";
        }
        
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

		if(isset($_POST['genre']) && $_POST['genre'] != null) {
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

		if(isset($_POST['phone']) && $_POST['phone'] != null) {
			if (!preg_match("/^0[0-9]{9}+$/", trim($_POST['phone']))) { 
				$incorrectFields[] = "Numéro de téléphone";
			}
		}

        $path = "user/".$_POST["username"];
        if(file_exists($path)){
            $incorrectFields[] = "Ce login exite déja";
        }

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
            $genre = $_POST['genre'];
            $email = $_POST['email'];
            $date_de_naissance = $_POST['date_de_naissance'];
            $adresse = $_POST['adresse'];
            $code_postal = $_POST['code_postal'];
            $ville = $_POST['ville'];
            $numero_de_telephone = $_POST['numero_de_telephone'];

            //controle si tout les données sont bien rentré (pas fini)
            //DEV ----- DEV


            //on stocke tout dans un array
            $user = array(
                "username" => $username,
                "password" => $password,
                "nom" => $nom,
                "prenom" => $prenom,
                "genre" => $genre,
                "email" => $email,
                "date_de_naissance" => $date_de_naissance,
                "adresse" => $adresse,
                "code_postal" => $code_postal,
                "ville" => $ville,
                "numero_de_telephone" => $numero_de_telephone,
                "favorite" => array()
            );

            //encodeage de l'array dans un ficher JSON

            file_put_contents($path, JSON_encode($user));
            header("Location:index.php");
        }
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
        <br><input type="date" name="date_de_naissance" /> <br>

        Adresse:
        <br><input type = "text"  name = "adresse" /><br>

        Code postal:
        <br><input type = "text"  name = "code_postal" /><br>

        Ville:
        <br><input type = "text"  name = "ville" /><br>

        Numero de téléphone:
        <br><input type = "text"  name = "numero_de_telephone" /><br>

        <br/>
        <br/>
     <input type = "submit" name="submit_btn" id = "submit" value = "submit"/>
    </form>
    <a href="index.php">index.php</a>
</body>
</html>