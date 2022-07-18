<?php

  if (isset($_GET['log_err'])) {

    $log = htmlspecialchars($_GET['log_err']);

    switch ($log) {

      case 'empty':
        ?>
        <script type="text/javascript">
          alert("ERROR: L'utilisateur n'existe pas. Essayez de nouveau.");
        </script>
        <?php
        break;

      case 'password':
        ?>
        <script type="text/javascript">
          alert("ERROR: Votre mot de passe est incorrecte. Essayez de nouveau.");
        </script>
        <?php
        break;
    }

  }
?>
