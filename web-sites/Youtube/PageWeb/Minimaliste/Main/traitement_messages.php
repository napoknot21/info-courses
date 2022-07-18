<?php
session_start();
require_once '../config.php';

if (!isset($_SESSION['user'])) {
    header('Location:main.php');
} 


$req = "INSERT INTO publication_$_POST['destinataire'] (pseudo, date, contenu) VALUES ('$POST['pseudo'], NOW(), $_POST['message'])";
$select = mysqli_query($connexion,$req);


?>