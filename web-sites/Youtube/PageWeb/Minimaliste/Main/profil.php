<?php
session_start();
require_once '../config.php';

if (!isset($_SESSION['user'])) {
    header('Location:../index.php');
}

$nm_p = htmlspecialchars($_GET['p']);

$req = "SELECT * FROM users WHERE id_user = '$nm_p'";
$res = mysqli_query($connexion, $req);

if ($res) {
    $data = mysqli_fetch_array($res, MYSQLI_ASSOC);
} else {
    die("Problemes de connexion au serveur");
}

$friends = mysqli_query($connexion,"SELECT * FROM friends WHERE demandeur = '$nm_p' AND demandé = '".$_SESSION['id']."' OR demandeur = '".$_SESSION['id']."' AND demandé = '$nm_p'");
if ($friends) {
    $table = mysqli_fetch_array($friends,MYSQLI_ASSOC);
} else {
  die("Erreur de connexion au serveur");
}


$title = $data['pseudo'] . " | Profil";
$style = "../Styles/profil.css";
$logo = "../Styles/Images/Bananero_logo.png";

$id = $_SESSION['id'];

require_once '../Parties/head.php';

?>
<body>
  <?php require_once('../Parties/barre_navigation.php'); ?>
  <section>
  <br><br><br><br>

  <section>

    <div class="corps">
        <aside class="photo_aside">
          <img id="photo" src="../Styles/Images/Profil/<?php echo $data['pp']; ?>" alt="photo de profil">
        </aside>
        <header class="situation_compte">
          <div class="name_info">
            <h1> <?php echo $data['pseudo']; ?> </h1>
          </div>
          <?php if ($data['privilege'] == 1) { ?>
            <div class="admin_verified">
              <img id="verification" src="../Styles/Images/verified.png" alt="ADMIN">
            </div>
          <?php } ?>
            <div class="admin_info">
              <p class="box"> <?php if ($data['privilege'] == 1) { echo "ADMIN"; } else { echo "Compte classique";}?> </p>
            </div>

        </header>
    </div>


    <div class="info-complete">

        <div class="biography">
          <header class="block-title">
            <h2> Informations personnelles </h2>
          </header>
          <main class="block-content">
            <?php if (($data['privacité'] == 0 && $tab['etat'] == 1) || ($data['privacité'] == 1) || ($data['privacité'] == 0 && '$nm_p' == '$id')) { ?>
            <p>Prénom: <?php echo $data['prenom']; ?></p>
            <p>Nom: <?php echo $data['nom']; ?></p>
            <p>Adresse mail: <?php echo $data['email']; ?></p>
            <p>Anniversaire: <?php echo $data['anniversaire']; ?></p>
            <p>Sexe: <?php echo $data['sexe']; ?></p>
            <p>Membre depuis: <?php echo $data['date_inscription']; ?></p>
            <?php } else { echo "Compte privé."; } ?>
          </main>

        </div>

        <div class="relationship">
          <header class="block-title">
            Ami.e.s
          </header>
          <main class="block-content">
            <?php if (($data['privacité'] == 0 && $tab['etat'] == 1) || ($data['privacité'] == 1) || ($data['privacité'] == 0 && '$nm_p' == '$id') || ($_SESSION['privilege'] == 1)) { ?>
              <div class="">


                





              </div>

            <?php } else { echo "Compte privé."; } ?>
          </main>
        </div>

    </div>


  </section>
  <footer>
    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    <p>hola</p>
  </footer>
</body>
</html>
