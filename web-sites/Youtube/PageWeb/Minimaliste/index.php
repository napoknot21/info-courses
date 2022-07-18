<?php
session_start();

if (isset($_SESSION['user'])) {
  header('Location:Main/main.php');
}

$title = "Log In";
$style = "Styles/login.css";
$logo = "Styles/Images/Bananero_logo.png";
require 'Parties/head.php';

?>

<body>
  <br>
  <div class="tete">
    <tr>
      <td> <a title="ACM1PT" href="index.php"> <img src="Styles/Images/log.png" style="width:306px;height:63px;" alt="ACM1PT" border="0"></a>
    </tr>
  </div>

  <br><br><br><br>

  <div id="conteiner_1">
    <header>
      <h2> Se connecter </h2>
    </header>

    <section id="content">
      <form method="post" action="connexion.php">
        <div class="form-group">
          <p><input type="text" name="pseudo" size="30" placeholder="Utilisateur" value="" required></p>
        </div>
        <div class="form-group">
          <p><input type="password" name="password" size="30" placeholder="Mot de Passe" value="" required></p>
        </div>
        <div class="form-group">
          <button type="submit" name="login" class="btn">Login</button>
        </div>
      </form>
    </section>

    <footer>
      <p> Pas encore de compte? <a id="lien" href="inscription.php">Inscrivez-vous ici!</a> </p>
    </footer>

</body>
</html>
