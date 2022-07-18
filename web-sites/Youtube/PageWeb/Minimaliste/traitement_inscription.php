<?php

require_once 'config.php';

if (isset($_POST['name']) && isset($_POST['lastName']) && isset($_POST['pseudo']) && isset($_POST['email']) && isset($_POST['jour']) && isset($_POST['mois']) && isset($_POST['annee']) && isset($_POST['sexe'])
 && isset($_POST['password']) && isset($_POST['repPassword'])) {

    $name = mysqli_real_escape_string($connexion, $_POST['name']);
    $lastName = mysqli_real_escape_string($connexion, $_POST['lastName']);
    $pseudo = mysqli_real_escape_string($connexion, $_POST['pseudo']);
    $email = mysqli_real_escape_string($connexion, $_POST['email']);
    $sex = htmlspecialchars($_POST['sexe']);
    $pwd = htmlspecialchars(hash('sha256', $_POST['password']));
    $rePwd = htmlspecialchars(hash('sha256', $_POST['repPassword']));

    $dd = intval($_POST['jour']);
    $mm = intval($_POST['mois']);
    $yy = intval($_POST['annee']);

    if (strlen($name) <= 70) {
        if (strlen($lastName) <= 70) {
            if (strlen($email) <= 70 && filter_var($email, FILTER_VALIDATE_EMAIL)) {
                if (checkdate($mm, $dd, $yy)) {
                    if (strlen($pwd) <= 70) {
                        if (strlen($rePwd) <= 70) {
                            if ($pwd == $rePwd) {
                                $req_1 = "SELECT * FROM users WHERE pseudo = '$pseudo'";

                                $select = mysqli_query($connexion, $req_1);

                                if ($select) {
                                    if (mysqli_num_rows($select) == 0) {
                                        $req_2 = "SELECT * FROM users WHERE email = '$email'";

                                        $select = mysqli_query($connexion, $req_2);

                                        if ($select) {
                                            if (mysqli_num_rows($select) == 0) {
                                                $req_3 = "INSERT INTO users (privilege,prenom,nom,pseudo,email,password,anniversaire,sexe,date_inscription,pp,privacité) VALUES (0,'$name','$lastName','$pseudo','$email','$pwd','$yy-$mm-$dd','$sex',now(),'pp.png','1')";

                                                $select = mysqli_query($connexion, $req_3);

                                                if ($select) {
                                                    header('Location:inscription.php?reg_err=success');
                                                } else {
                                                    die(mysqli_error($connexion));
                                                }
                                            } else {
                                                header('Location:inscription.php?reg_err=email_already');
                                            }
                                        } else {
                                            die(mysqli_error($connexion));
                                        }
                                    } else {
                                        header('Location:inscription.php?reg_err=pseudo_already');
                                    }
                                } else {
                                    die(mysqli_error($connexion));
                                }
                            } else {
                                header('Location:inscription.php?reg_err=passwords');
                            }
                        } else {
                            header('Location:inscription.php?reg_err=repPassword_length');
                        }
                    } else {
                        header('Location:inscription.php?reg_err=password_length');
                    }
                } else {
                    header('Location:inscription.php?reg_err=anniversaire');
                }
            } else {
                header('Location:inscription.php?reg_err=email');
            }
        } else {
            header('Location:inscription.php?reg_err=lastName_length');
        }
    } else {
        header('Location:inscription.php?reg_err=name_length');
    }
} else {
    header('Location:inscription.php');
}

mysqli_close($connexion);
