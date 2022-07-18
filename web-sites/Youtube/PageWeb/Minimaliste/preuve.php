<?php

$servername = "localhost";
$username = "root";
$password = "";

$conn = new mysqli($servername,$username,$password);

if ($conn->connect_error) {
    die("Erreur : " . $conn->connect_error);
}

echo "connexion réussie";

$val = "INSERT INTO Utilisateurs (Prenom,Nom,)"


?>