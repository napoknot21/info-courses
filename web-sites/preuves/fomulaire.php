<?php
require 'config.php';
?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title> Formulaire </title>
  </head>
  <body>
    <form class="" action="traitement.php" method="post">
      <input type="text" name="nom" value="" placeholder="Votre nom">
      <input type="text" name="pseudo" value=""placeholder="Votre pseudonyme">
      <input type="password" name="mdp" value="" placeholder="votre mot de passe">
      <button type="submit" name="button"> S'INSCRIRE </button>
    </form>
  </body>
</html>
