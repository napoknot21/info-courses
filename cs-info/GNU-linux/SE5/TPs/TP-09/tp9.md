TP nº9 : communication et synchronisation par tubes
=================================

**L3 Informatique - Système**


#### Exercice 1 : tubes et communication simple

Écrire un programme qui crée deux processus, un père et son fils. *Avant*
de se dupliquer, le père doit créer un tube (anonyme). *Après* la
duplication, il doit tirer un entier au hasard entre 0 et 100, l'afficher
sur la sortie standard puis le transmettre à son fils via le tube *sous
la forme d'un `int`* (et non de sa représentation décimale sous forme de
chaîne de caractères). Le fils doit alors afficher le nombre choisi par
son père.

#### Exercice 2 : tubes et redirection

* En utilisant un tube pour faire communiquer deux processus, écrire un
  programme qui simule la commande `ls | tail` (ie en utilisant
  `pipe()`, `fork()` et `exec()`, mais pas la fonctionnalité `|` de votre
  shell).

  Que se passe-t-il si vous oubliez de fermer les descripteurs superflus
  après le `fork()`? 

* Modifier le programme précédent pour simuler la commande `ls | (sleep 5
  ; head)`. Est-il indifférent que le processus père exécute `ls` ou
  `(sleep 5 ; head)`?

#### Exercice 3 : tubes et synchronisation

On a vu au TP précédent que `wait()` permet de synchroniser des processus;
plus précisément, `wait()` permet à un processus de se synchroniser sur ses
fils.

Le caractère bloquant des tubes peut être utilisé pour synchroniser deux
processus avec moins de contraintes sur la généalogie. Pour visualiser
cela, écrire un programme `synchro` créant deux processus, un père et son
fils, respectivement écrivain et lecteur d'un même tube; 

* le père doit attendre durant quelques secondes avant d'écrire un
  caractère quelconque dans le tube, afficher `Fini!` puis
  terminer (il a bien sûr le droit d'attendre la terminaison de son fils!); 

* pendant ce temps, le fils devra lire un caractère dans le tube, puis
  afficher `Moi aussi!` et terminer.

#### Exercice 4 : ping-pong

Écrire un programme qui crée deux processus, un père et son fils, qui
communiquent par tube(s). Le père envoie `ping` à son fils, qui répond
`pong`, auquel cas le père répond à nouveau `ping`, etc. Au bout de quelques
échanges de balles, l'un des deux processus affiche sur la sortie
standard `Dehors, j'ai gagné!` puis termine. L'autre processus affiche
alors `Bravo... une petite revanche?` avant de terminer à son tour.

Combien faut-il de tubes?


#### Exercice 5 : la patate chaude

Dans cet exercice, `N` processus `p1`, `p2`, `pN` forment un anneau :
`p1` est relié à `p2` par un tube, `p2` à `p3`, ..., et `pN` est relié à
`p1`. Un jeton (de type `int`), ou patate chaude, circule dans cet
anneau.

Chaque processus lit sur le tube qui le relie au processus précédent.
Quand il reçoit la patate chaude, il affiche un message du type `Mon PID
est 2048 et la patate vaut 17`, puis il incrémente la patate et la
transmet au processus suivant.

La ligne de commande doit récupérer deux paramètres : le premier est la
taille `N` de l'anneau, le deuxième est une valeur `patatmax` que la
patate ne doit pas dépasser.

Il faut donc créer l'anneau et les tubes avant de lancer la patate
(initialisée à 0) dedans. Attention, une seule patate doit circuler!
Quand la patate atteint `patatmax`, le processus qui la reçoit doit
afficher `Argh ! Je meurs !` puis se terminer. Faire en sorte que les
autres processus détectent la fin de la partie et terminent également.
