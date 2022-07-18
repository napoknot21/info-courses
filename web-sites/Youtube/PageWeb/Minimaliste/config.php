<?php

$id = session_id();

$connexion = mysqli_connect('localhost', 'root', '', 'Projet_IO2');

if (!$connexion) {
    die("Pas de connexion au serveur");
}

mysqli_set_charset($connexion, 'utf8');

?>
