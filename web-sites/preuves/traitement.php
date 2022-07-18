<?php
require_once 'config.php';

if (isset($_POST['nom']) && isset($_POST['pseudo']) && isset($_POST['mdp'])) {

  $name = htmlspecialchars($_POST['nom']);
  $pseudo = htmlspecialchars($_POST['pseudo']);
  $mdp = htmlspecialchars(hash('sha256',$_POST['mdp']));

  if (strlen($name) < 71) {

    if (strlen($pseudo) < 71) {

      if (strlen($_POST['mdp']) < 71) {

        $req = $connexion->prepare('SELECT * FROM users WHERE pseudo=?');
        $req->execute(array($pseudo));
        $data = $req->fetch();
        $row = $data->rowCount();

        if ($row == 0) {

          $insert = $connexion->prepare('INSERT INTO users(name,pseudo,mdp) VALUES (:name,:pseudo,:mdp)');
          $insert->execute(array(
            'name' => $name,
            'pseudo' => $pseudo,
            'mdp' => $mdp
          ));

          header('Location:formulaire.php?log_err=succes');
          die();

        } else {
          header('Location:formulaire.php?log_err=pseudo_already');
        }

      } else {
        header('Location:formulaire.php?log_err=mdp_length');
      }
    } else {
      header('Location:formulaire.php?lof_err=pseudo_length');
    }
  } else {
    header('Location:fomulaire.php?log_err=name_length');
  }
} else {
  header('Location:formulaire.php?log_err=empty');
}



?>
