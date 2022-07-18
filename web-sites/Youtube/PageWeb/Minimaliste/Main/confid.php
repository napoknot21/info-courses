<?php
session_start();
require_once '../config.php';

if (!isset($_SESSION['user'])) {
    header('Location:../index.php');
}

$id = htmlspecialchars($_GET['p']);

if ($_SESSION['id'] != $id) {
  header('Location:main.php');
}

$req = "SELECT * FROM users WHERE id_user = '$id'";
$res = mysqli_query($connexion, $req);

if ($res) {

  $data = mysqli_fetch_array($res,MYSQLI_ASSOC);

} else { die ("Erreur de connexion"); }

$title = "Parametres | confidentialité";
$style = "../Styles/confid.css";
$logo = "../Styles/Images/Bananero_logo.png";
require_once '../Parties/head.php';
?>
<body>
  <?php require_once '../Parties/barre_navigation.php'; ?>

  <br><br><br><br>
  <?php
  if ($data['privacité'] == 0) { ?>


    <div class="conteiner">

      <form action="" method="post">
        <div class="texte_post">
          <h1> Vous voulez rendre publique votre compte ?</h1>
        </div>
        <div class="button_post">
          <button type="button" name="confidentialite"> Oui </button>
        </div>
      </form>

    </div>

    <?php
    if (isset($_POST['confidentialite'])) {

      $requ = "UPDATE users SET privacité = '0' WHERE id_user =  '".$_SESSION['id']."'";
      $rest = mysqli_query($connexion,$requ);

      if ($rest) {

        header('Location.main.php');

      } else {
        die ("Erreur de connexion");
      }

    } ?>

  <?php } else { ?>

    <div class="conteiner">

      <form class="" action="" method="post">
        <div class="texte_post">
          <h1> Vous voulez rendre privé votre compte ?</h1>
        </div>
        <div class="button_post">
          <button type="button" name="confidentialite"> Oui </button>
        </div>
      </form>

    </div>

    <?php
    if (isset($_POST['confidentialite'])) {

      $requ = "UPDATE users SET privacité = '0' WHERE id_user =  '".$_SESSION['id']."'";
      $rest = mysqli_query($connexion,$requ);

      if ($rest) {

        header('Location.main.php');

      } else {
        die ("Erreur de connexion");
      }


    }

 ?>
  <?php } ?>
</body>
</html>
