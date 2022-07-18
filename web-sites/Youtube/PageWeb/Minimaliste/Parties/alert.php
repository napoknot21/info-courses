<?php

    if (isset($_GET['reg_err'])) {

        $err = htmlspecialchars($_GET['reg_err']);

        switch ($err) {

            case 'name_length':
                ?>
                <script type="text/javascript">
                  alert("ERROR: Votre prénom ne doit pas dépasser les 70 caractères.");
                </script>
                <?php
                break;

            case 'lastName_length':
                ?>
                <script type="text/javascript">
                  alert("ERROR: Votre nom ne doit pas dépasser les 70 caractères.");
                </script>
                <?php
                break;

            case 'email':
                ?>
                <script type="text/javascript">
                  alert("ERROR: Votre email est trop large, essayez de nouveau.");
                </script>
                <?php
                break;

            case 'anniversaire':
                ?>
                <script type="text/javascript">
                    alert("ERROR: Votre date de naissance n'existe pas. Essayez de nouveau.");
                </script>
                <?php
                break;

            case 'password_length':
                ?>
                <script type="text/javascript">
                  alert("ERROR: Votre mot de passe ne doit pas dépasser les 60 caractères.");
                </script>
                <?php
                break;

            case 'repPassword_length':
                ?>
                <script type="text/javascript">
                  alert("ERROR: Votre mot de passe ne doit pas dépasser les 60 caractères.");
                </script>
                <?php
                break;

            case 'passwords':
                ?>
                <script type="text/javascript">
                  alert("ERROR: Les mots de passent ne sont pas identiques.");
                </script>
                <?php
                break;

            case 'email_already':
                ?>
                <script type="text/javascript">
                  alert("ERROR: L'email est déjà inscrit sur le site. Essayez de nouveau.");
                </script>
                <?php
                break;

            case 'pseudo_already':
                ?>
                <script type="text/javascript">
                  alert("ERROR: L'utilisateur est déjà inscrit sur le site. Essayez de nouveau.");
                </script>
                <?php
                break;

            case 'success':
                ?>
                <script type="text/javascript">
                  alert("Votre inscription a été effectué! Conectez vous dès maintenant!");
                </script>
                <?php
                break;
        }
    }
?>
