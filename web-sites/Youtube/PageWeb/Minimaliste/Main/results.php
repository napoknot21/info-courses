<?php
session_start();
require_once'../config.php';

if (!isset($_SESSION['user'])) {
    header('Location:../index.php');
}

$title = "Résultats de ".$_POST['recherche'];
$style = "../Styles/Bienvenu.css";
$logo = "../Styles/Images/Bananero_logo.png";

require_once'../Parties/head.php';
?>

<body>

<?php require_once'../Parties/barre_navigation.php'; ?>

<?php
if (isset($_POST['search'])) {

    $texte = mysqli_real_escape_string($connexion,$_POST['recherche']);

    $req1 = "SELECT * FROM users WHERE pseuso LIKE '%".'$texte'."%'";
    $requete = mysqli_query($connexion,$req1);

    if ($requete) {

      $data = mysqli_fetch_array($requete,MYSQLI_ASSOC);

      $nombre = mysqli_num_rows($requete);

    } else {
        die("Problemes de connexion au serveur");
    }
}

?>

<br><br><br>

  <section>
    <div class="container">
      <h1> <?php echo $nombre ?> Admin/utilisateurs trouvés ! </h1>
    </div>
      <?php while ($data) { ?>
        <div>
          <div class="">
            <img src="../Styles/Images/Profil/<?php echo $data['pp']; ?>" alt="">
          </div>
          <div class="">
            <a href="profil.php?p=<?php echo $data['id_user']; ?>"> <?php $data['pseudo']; ?></a>
          </div>
        </div>
      <?php } ?>
    </div>
  </section>

</body>
