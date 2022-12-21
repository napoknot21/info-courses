<?php

  $x = 42;

  echo "The answer is $x\n";
  echo "The answer is $x+5\n";
  echo 'The answer is in $x\n';
  echo "\n";
  echo "TRUE = ", true, "\n";
  echo "FALSE = ", false, "\n";

  $var = (int)readline('Entrez un nombre pour la suite de fibonacci: ');

  function fibonacci ($var1) {
    if ($var1 === 0) {
      return 0;
    }
    if ($var1 === 1) {
      return 1;
    }
    return fibonacci($var1-1) + fibonacci($var1-2);
  }

  echo fibonacci($var),"\n";
?>
