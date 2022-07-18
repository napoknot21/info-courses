<?php
session_start();
require_once'../config.php';

if (!isset($_SESSION['user'])) {
    header('Location:../index.php');
}

$title = "Messages";
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
        <form method="post" action="traitement_messages.php" >
            <P>Sélectionnez votre destinataire : </p> 
	        <select class="form-group" name="destinataire" required>
		        <option value="0">--- Destinataire ---</option>
		        <?php
			        $pseudo = mysqli_real_escape_string($connexion, $_REQUEST['pseudo']);
			        $req = "SELECT * FROM ami_$pseudo";
			        $select = mysqli_query($connexion,$req_2);
			        while ($ligne=mysqli_fetch_assoc($resultat)) {
		                ?>
		                <option value="<?php echo $ligne['pseudo']; ?>"> <?php echo $ligne['pseudo']; ?> </option>
		            <?php } ?>
	        </select>
	        <br><br>
            <p> Ecrivez votre message : <br>
	        <textarea rows="5" cols="50" name="messages">Écrivez votre message ici.</textarea> <br><br>
            
            <input type="submit" value="Envoyer" name="send">
            <input type="reset" value="Effacer" name="clear"><br><br>
        </form>
      </main>
    </div>    
</body>