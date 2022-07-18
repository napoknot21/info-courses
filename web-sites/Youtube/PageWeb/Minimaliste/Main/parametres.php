<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('Location:../index.php');
}

$id = htmlspecialchars($_GET['p']);

if ($_SESSION['id'] != $id) {
  header('Location:main.php');
}

$title = "Parametres";
$style = "../Styles/parametres.css";
$logo = "../Styles/Images/Bananero_logo.png";

require_once '../Parties/head.php';
?>
<body>
  <?php require_once '../Parties/barre_navigation.php'; ?>

  <br><br><br><br>

  <section class="conteiner">

    <div class="title_par">
      <h1> Qu'est ce que vous voulez faire ? </h1>
    </div>
    <div class="options_par">
      <div class="profil_par">
        <p> <a href="info_conf.php?p=<?php echo $_SESSION['id']; ?>"> Modifiez vos informations personnelles </a> </p>
      </div>
      <div class="pwd_par">
        <p> <a href="pwd.php?p=<?php echo $_SESSION['id']; ?>"> Changez votre mot de passe </a> </p>
      </div>
      <div class="priv_par">
        <p> <a href="confid.php?p=<?php echo $_SESSION['id']; ?>"> Changer la confidentialité </a> </p>
      </div>
    </div>



  </section>

</body>
</html>
