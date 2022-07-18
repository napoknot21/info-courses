<?php

try {

  $connexion = new PDO ('mysql:host=localhost;dbname=SocialNetwork;charset=utf8','root','');

} catch (Exception $e) {

  die('Erreur de connexion : '.$e->getMessage());
}

?>
