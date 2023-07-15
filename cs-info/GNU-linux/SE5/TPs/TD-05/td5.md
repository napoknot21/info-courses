TD nº5 : le parcours de répertoire
==========================

**L3 Informatique - Système**


#### Exercice 1 : nom du répertoire courant

* Écrire la fonction `char *nom_du_repertoire()`  qui retourne le nom du
  répertoire courant dans une arborescence stockée sur un unique
  disque.

* Comment peut-on tester que deux chemins référencent le même fichier
  lorsqu'un SGF comporte des points de montage ?
<!-- mêmes numéros d'inœud et de disque. -->

* Modifier la fonction pour prendre en compte le fait que l'arborescence
  peut contenir plusieurs points de montage.

#### Exercice 2 : pwd

Le but de cet exercice est d'écrire un programme affichant la
référence absolue du répertoire courant à l'instar de la commande
`pwd -P` (référence absolue du répertoire courant en évitant les liens
symboliques), sans utiliser la fonction `getcwd()`.

- Comment peut-on tester qu'un chemin référence la racine du SGF ?
<!-- Une caractérisation de la racine `/` est qu'elle est son propre parent :
`.` et `..` ont donc les mêmes numéros d'inœud et de disque. -->

- Écrire la fonction `int est_racine()` qui teste si la valeur de la variable
  globale `char courant[PATH_MAX]` est une référence, relative au
  répertoire courant, de la racine du SGF.

- Écrire la fonction `void construit_chemin()` qui construit
  récursivement la référence absolue du répertoire courant en la
  stockant dans la variable globale `char pwd[PATH_MAX]`.
  Pour cela, on appliquera l'algotithme suivant :

	- récupérer l'inœud `n` et le disque (_device_) `d` du répertoire courant,
	- chercher dans son père le nom du lien qui correspond à l'inœud
    `n` du disque `d`,
	- concaténer ce nom et le chemin représentant la référence absolue
    du répertoire de départ,
	- recommencer récursivement sur le répertoire parent du répertoire
      courant, jusqu'à atteindre la racine `/` de l'arborescence.




