<?php
session_start();

require_once 'config.php';

if (isset($_SESSION['user'])) {
  header('Location:Main/index.php');
}

$title = "Bienvenu !";
$style = "Styles/inscription.css";
$icon = "Styles/Images/logo.png";

require 'Parts/head.php';
?>
<body>
<div class="conteiner">
  <div class="logo_inscription">
    <img src="Styles/Images/acm1pt.png" alt="ACM1PT!" title="ACM1PT!">
  </div>

  <div class="formulaire_inscription">
    <form action="traitement.php" method="post">

      <div class="champs_inscription">
        <div class="input_inscription">
          <input type="text" name="prenom" placeholder="Prénom" required>
        </div>
        <div class="input_inscription">
          <input type="text" name="nom" placeholder="Nom" required>
        </div>
        <div class="input_inscription">
          <input type="text" name="pseudo" placeholder="Pseudo"required>
        </div>
        <div class="input_inscription">
          <input type="email" name="email" placeholder="Email" required>
        </div>
        <div class="anniversaire_inscription">
          <div class="indication_inscription">
            <p> Votre date de naissance </p>
          </div>
          <div class="date_inscription">
            <div class="jour_inscription">
              <select class="" name="jour" required>
                <option value="">Jour</option>
                <?php for ($i=1; $i<=31;$i++) { ?>
                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                <?php } ?>
              </select>
            </div>
            <div class="mois_inscription">
              <select name="mois" required>
                <option value="">Mois</option>
                <option value="01">Janvier</option>
                <option value="02">Février</option>
                <option value="03">Mars</option>
                <option value="04">Avril</option>
                <option value="05">Mai</option>
                <option value="06">Juin</option>
                <option value="07">Juillet</option>
                <option value="08">Aout</option>
                <option value="09">Septembre</option>
                <option value="10">Octobre</option>
                <option value="11">Novembre</option>
                <option value="12">Décembre</option>
              </select>
            </div>
            <div class="annee_inscription">
              <select name="annee" required>
                <option value="">Année</option>
                <?php for ($i=2021;$i>1909;$i--) { ?>
                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
              <?php } ?>
              </select>
            </div>
          </div>

        </div>
        <div class="input_inscription">
          <input type="password" name="password" placeholder="Mot de Passe" required>
        </div>
        <div class="input_inscription">
          <input type="password" name="repassword" placeholder="Confirmer" required>
        </div>
        <div class="sexe_inscription">
          <div class="indication_inscription">
            <p> Votre sexe :</p>
          </div>
          <div class="options_inscription">
            <div class="homme_inscription">
              <input type="radio" name="sexe" value="Homme" required>Homme
            </div>
            <div class="femme_inscription">
              <input type="radio" name="sexe" value="Femme">Femme
            </div>
            <div class="autre_inscription">
              <input type="radio" name="sexe" value="Autre">Autre
            </div>
          </div>
        </div>
      </div>
      <div class="buttons_inscription">
        <div class="conditions_inscription">
          <input type="checkbox" name="conditions" value="1" required> J'accepte les <a href="#">conditions d'utilisation</a>
        </div>
        <div class="submit_inscription">
          <button type="submit" name="register"> S'inscrire ! </button>
        </div>
      </div>
    </form>
  </div>
  <div class="redirections_inscription">
    <p> <a href="login.php">Se connecter à un compte existent</a></p>
  </div>
</div>
</body>
</html>
