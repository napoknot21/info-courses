<?php
session_start();
require_once '../config.php';

if (!isset($_SESSION['user'])) {
    header('Location:../index.php');
}

$title = "ACM1PT";
$style = "../Styles/Bienvenu.css";
$logo = "../Styles/Images/Bananero_logo.png";

require '../Parties/head.php';
?>
<body>
  <?php
    require_once('../Parties/barre_navigation.php');
  ?>
  <br><br><br>

  <section>
    <div class="container">
      <main class="block_m">
        <div class="redact">
          <div class="title-redact"><label> Publier du contenu </label></div>
            <form method="post" action="traitement_publications.php" enctype="multipart/form-data">
              <div class="input-group">
                <textarea type="text" name="publication" placeholder="Quoi de neuf, <?php echo $_SESSION['user'];?> ?"></textarea>
              </div>
              <div class="actions">
                <input type="file" name="photo"/>
                <button type="submit" name="publier" class="btn">Publier</button>
              </div>
           </form>
        </div>

        <br>
        <div class="pubs">


          <?php
            $req_post = "SELECT * FROM publications ORDER BY id_pub DESC LIMIT 10";
            $posts = mysqli_query($connexion,$req_post);
            while ($results = mysqli_fetch_array($posts,MYSQLI_ASSOC)) { ?>

              <div class="conteiner_pubs">

                <?php
                $req_author = "SELECT id_user,pp,pseudo FROM users WHERE id_user = '".$results['user']."'";
                $author = mysqli_query($connexion,$req_author);
                $table = mysqli_fetch_array($author,MYSQLI_ASSOC); ?>

                <div class="author_pub">

                  <div class="profil_author">
                    <img class="photo_profil_pub" src="../Styles/Images/Profil/<?php echo $table['pp']; ?>" alt=""/>
                  </div>
                  <div class="name_author">
                    <a href="profil.php?p=<?php echo $table['id_user']; ?>"> <?php echo $table['pseudo']; ?> </a>
                  </div>
                  <div class="date_author">
                    <?php echo "Publié le: ".$results['date']; ?>
                  </div>

                </div>

                <div class="media">
                  <?php if (isset($results['contenu'])) { ?>
                  <div class="contenu_media">
                      <?php echo $results['contenu']; ?>
                  </div>
                  <?php } ?>

                  <?php if (isset($results['image'])) { ?>
                  <div class="image_media">
                    <img class="image_post" src="Publications/<?php echo $results['image']; ?>" alt="">
                  </div>
                  <?php } ?>

                </div>

              </div>

            <?php } ?>

            <div id="fin"> <p> FIN DE PUBLICATIONS </p> </div>

        </div>
      </main>
      <aside class="block_a">
        <div class="title-redact"> Derniers arrivés ! </div>
        <div class="last_users">
          <?php
            $req = "SELECT id_user,pp,pseudo,date_inscription FROM users ORDER BY id_user DESC LIMIT 5";
            $inscrits = mysqli_query($connexion,$req);

            while ($reg = mysqli_fetch_array($inscrits,MYSQLI_ASSOC)) {
          ?>
              <div class="conteiner_profils">
                <div class="photo_last"> <img class="profil-photo" src="../Styles/Images/Profil/<?php echo $reg['pp']; ?>" alt="user_Image"> </div>
                <div class="name_last"> <a href="profil.php?p=<?php echo $reg['id_user']; ?>"> <?php echo $reg['pseudo']; ?> </a> </div>
              </div>
          <?php
            } ?>
        </div>
      </aside>
    </div>
  </section>

  <footer>  </footer>

</body>
</html>
