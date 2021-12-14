<!-- System de login HTML -->
<form action ="index.php" method="POST">
<h3> Veuillez entrer vos identifiants</h3>
  <p>
    <label>nom d'utilisateur: </label><input type = "text"  name = "username" />
    <label>mot de passe: </label><input type = "password" name = "password" />
    <br/>
  </p>
<input type = "submit" name="submit_btn" id = "submit" value = "se connecter"/>
<a href ="src/register.php" type = "button"  id = "register" value = "register">register.php</a>
</form>
