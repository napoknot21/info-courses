<?php
require_once 'config.php';

if (isset($_POST['prenom']) && isset($_POST['nom']) && isset($_POST['pseudo']) && isset($_POST['email']) && isset($_POST['jour']) && isset($_POST['mois']) && isset($_POST['annee']) && isset($_POST['password']) && isset($_POST['repassword']) && isset($_POST['sexe'])) {

  $name = htmlspecialchars($_POST['prenom']);
  $lastName = htmlspecialchars($_POST['nom']);
  $pseudo = htmlspecialchars($_POST['pseudo']);
  $email = htmlspecialchars($_POST['email']);
  $dd = intval(htmlspecialchars($_POST['jour']));
  $mm = intval(htmlspecialchars($_POST['mois']));
  $yy = intval(htmlspecialchars($_POST['annee']));
  $pwd = htmlspecialchars(hash('sha256',$_POST['password']));
  $repwd = htmlspecialchars(hash('sha256',$_POST['repassword']));
  $sex = htmlspecialchars($_POST['sexe']);


  if (strlen($name) <= 70) {

    if (strlen($lastName) <=70) {

      if (strlen($pseudo) <= 70) {

        $check = $connexion->prepare('SELECT * FROM users WHERE pseudo = ?');
        $check->execute(array($pseudo));
        $data = $check->fecth();
        $row = $check->rowCount();

        if ($row == 0) {

          if (strlen($email) <= 70) {

            if (filter_var($email,FILTER_VALIDATE_EMAIL)) {

              $check = $connexion->prepare('SELECT * FROM users WHERE email = ?');
              $check->execute(array($email));
              $data = $check->fecth();
              $row = $check->rowCount();

              if ($row == 0) {

                if (checkdate($mm,$dd,$yy)) {

                  if (strlen($_POST['password']) <= 70) {

                    if (strlen($_POST['repassword']) <= 70) {

                      if ($pwd == $repwd) {

                        $insert = $connexion->prepare('INSERT INTO users (privilege,prenom,nom,pseudo,email,password,anniversaire,sexe,date_inscription,pp) VALUES (:privilege,:prenom,:nom,:pseudo,:email,:password,:anniversaire,:sexe,:date_inscription,:pp)');
                        $insert->execute(array(
                          'privilege' => 0,
                          'prenom' => $prenom,
                          'nom' => $nom,
                          'pseudo' => $pseudo,
                          'email' => $email,
                          'password' => $pwd,
                          'anniversaire' => '$yy-$mm-$dd',
                          'sexe' => $sex,
                          'date_inscription' => now(),
                          'pp' => '../Styles/Profils/default.png'
                        ));

                        header('Location:inscription.php?form_err=succes');

                      } else {
                        header('Location:inscription.php?form_err=password_different');
                      }

                    } else {
                      header('Location:inscription.php?form_err=repassword_length');
                    }

                  } else {
                    header('Location:inscription.php?form_err=password_length');
                  }

                } else {
                  header('Locaiton:inscription.php?form_err=bithday_invalid');
                }

              } else {
                header('Location:inscription.php?form_err=email_already');
              }

            } else {
              header('Location:inscription.php?form_err=email_invalid');
            }

          } else {
            header('Location:inscription.php?form_err=email_length');
          }

        } else {
          header('Location:inscription.php?form_err=pseudo_already');
        }

      } else {
        header('Location:inscription.php?form_err=pseudo_length');
      }

    } else {
      header('Location:inscription.php?form_err=lastname_length');
    }
  } else {
    header('Location:inscripiton.php?form_err=name_length');
  }

} else {
  header('Location:inscription.php?form_err=empty');
}
?>
