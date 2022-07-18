<?php

session_start();

if (isset($_SESSION['user'])) {
  header('Location:Main/main.php');
}

$title = "Bienvenu !";
$style = "Styles/formulaire.css";
$logo = "Styles/Images/Bananero_logo.png";

require 'Parties/head.php';

?>
<body>
  <br>
  <div class="tete">
    <tr>
      <td> <a title="ACM1PT" href="Main/main.php"> <img src="Styles/Images/log.png" alt="ACM1PT" style="width:306px;height:63px;" border="0"></a> </td>
    </tr>
  </div>

  <br>

  <div id="conteiner_1">
    <header>
        <?php require_once 'Parties/alert.php'; ?>
        <h1> Inscrivez vous, c'est gratuit ! </h1>
    </header>

    <section id="content">
        <form action="traitement_inscription.php" method="post">
            <div class="formulaire">
                <div class="form-group">
                    <input class="block" type="text" autocapitalize="word" size="45" name="name" placeholder="Prénom" required>
                </div>
                <div class="form-group">
                    <p><input class="block" type="text" autocapitalize="word" size="45" name="lastName" placeholder="Nom" required></p>
                </div>
                <div class="form-group">
                    <p><input class="block" type="text" name="pseudo" size="45" placeholder="Utilisateur" required></p>
                </div>
                <div class="form-group">
                    <p><input class="block" type="email" name="email" size="45" placeholder="Adresse email" require></p>
                </div>
                <div class="form-group">
                    <label class="txt"> Date de Naissance</label><br>
                    <table>
                        <td>
                            <tr>
                                <select class="form-group" name="jour" required>
                                    <option value="0">Jour</option>
                                    <?php for ($j = 1; $j < 32; $j++): ?>
                                    <option value="<?php echo $j ?>"><?php echo $j ?></option>
                                    <?php endfor ?>
                                </select>
                            </tr>
                            <tr>
                                <select class="form-group" name="mois" required>
                                    <option value="0">Mois</option>
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
                            </tr>
                            <tr>
                                <select class="form-group" name="annee" value="" required>
                                    <option value="0">Année</option>
                                    <?php for ($i = 2021; $i >1919;$i--): ?>
                                    <option value="<?php echo $i ?>"><?php echo $i ?></option>
                                    <?php endfor ?>
                                </select>
                            </tr>
                        </td>
                    </table>
                </div>
                <div class="form-group">
                    <p><input class="block" type="password" name="password" size="45" placeholder="Mot de Passe" value="" required></p>
                </div>
                <div class="form-group">
                    <p><input class="block" type="password" name="repPassword" size="45" placeholder="Confirmer"value="" required></p>
                </div>
                <div class="form-group">
                    <p><label class="txt"> Vous êtes : </label>
                    <input type="radio" name="sexe" value="Homme" required>Homme
                    <input type="radio" name="sexe" value="Femme">Femme
                    <input type="radio" name="sexe" value="Autre">Autre</p>
                </div>
                <div class="boutons">
                    <div class="checkBox">
                        <input type="checkbox" name="check"required> J'accepte les <a href="Parties/Reglement.php">Conditions Génerales d'Utlisation</a>.
                    </div>
                    <div class="actions">
                        <p><button type="submit" name="register"> S'inscrire ! </button></p>
                    </div>
                </div>
            </div>
        </form>
    </section>
    <footer>
      <p> <a href="index.php"> Se connecter à une compte existante </a> </p>
    </footer>
  </div>
  <br><br><br>
  <footer>
    <div>
    </div>
  </footer>

</body>
</html>
