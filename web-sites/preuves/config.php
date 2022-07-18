<?php

try {
  $connexion = new PDO ('mysql:host=127.0.0.1;dbname=preuve;charset=utf8','root','');
} catch (\Exception $e) {
  die($e->getMessage());
}

?>
