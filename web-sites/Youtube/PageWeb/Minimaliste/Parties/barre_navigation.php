<header class="nav-window">
<div class="menu">
  <a title="ACM1PT" href="main.php"> <img class="img-logo" src="../Styles/Images/log.png" alt="ACM1PT" border="0"> </a>
</div>
<div class="recherche">
  <form method="post" action="results.php">
    <input id="search-champ" type="search" name="recherche" id="site-search" size="35" placeholder="Cherchez un utilisateur, un admin, etc..."  required>
    <boutton id="search-button" type="submit" name="search"> Search </boutton>
  </form>
</div>
<div class="navigation">
  <ul>
    <li><a title="Home" href="main.php"> Home </a> </li>
    <li><a title="Messagerie" href="messagerie.php"> Messagerie </a></li>
    <li><a title="<?php echo $_SESSION['user'];?>" href="profil.php?p=<?php echo $_SESSION['id']; ?>"> <?php echo $_SESSION['user'];?> </a></li>
    <li><a title="parametres" href="parametres.php?p=<?php echo $_SESSION['id']; ?>"> Parametres </a></li>
  </ul>
</div>
<div class="deconnexion">
  <a href="../deconnexion.php"> Se déconecter </a>
</div>
</header>
