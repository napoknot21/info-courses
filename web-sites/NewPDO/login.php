<?php
session_start();

require_once 'config.php';

if (isset($_SESSION['user'])) {
  header('Location:Main/main.php');
}

$title = "Log In";
$style = "Styles/login.css";
$icon = "Styles/Images/logo.png";
require_once 'Parts/head.php';
?>
<body>

  <div class="conteiner">

    <div class="logo_login">
      <img src="Styles/Images/acm1pt.png" alt="ACM1PT!">
    </div>

    <div class="connexion_login">
      <form class="" action="connexion.php" method="post">

        <div class="champs_login">
          <div class="pseudo_login">
            <input type="text" name="pseudo" placeholder="Pseudo">
          </div>
          <div class="pwd_login">
            <input type="text" name="password" placeholder="Mot de Passe" >
          </div>
        </div>

        <div class="buttons_login">
          <button type="submit" name=""> Se connecter ! </button>
        </div>

      </form>
    </div>

    <div class="redirections_login">
      <div class="pwd_forgot">
        <p><a href="#"> Mot de passe oublié ?</a></p>
      </div>
      <div class="incription_login">
        <p> Vous n'avez pas encore de compte ? <a href="inscription.php">Inscrivez-vous ici !</a></p>
      </div>
    </div>

  </div>

</body>
</html>
