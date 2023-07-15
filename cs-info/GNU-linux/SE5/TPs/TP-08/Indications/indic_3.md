_**Indication** : il s'agit ici, d'une part, d'obtenir une généalogie
linéaire, et d'autre part de faire en sorte que le premier processus
détecte la terminaison de **tous** ses descendants, bien qu'il ne
s'agisse pas de ses fils._

_Pour contrôler la généalogie, chaque processus (hormis le dernier) doit
avoir un fils, et un seul; il doit donc invoquer une seule fois la
fonction `fork`; autrement dit, il doit sortir de la boucle générale
après le retour de son appel à `fork` , alors que son fils continue._

_Pour que l'ancêtre détecte la terminaison de tous ses descendants,
chaque processus devra, dans l'ordre : effectuer son affichage, faire
appel à `fork`, puis attendre la terminaison de son fils. Comme le fils
en question attendra lui-même son propre fils, par transitivité chacun
attend tous ses descendants._

_Pour vous assurer que le premier processus détecte bien la terminaison
de l'ensemble, vous pouvez lui faire réaliser l'affichage des dernières
lignes du poème._

