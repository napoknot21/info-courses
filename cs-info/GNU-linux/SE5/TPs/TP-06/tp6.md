# TP nº6 : A Long Walk along The Filesystem

**L3 Informatique - Système**

Ce TP permet d'approfondir les parcours d'arborescences. Pour cela, nous
allons programmer une commande pour trouver un fichier à partir d'un
emplacement donné.

#### Instructions pour faire le TP

1. Mettez à jour le dépôt `git` du cours. Placez-vous dans le
   répertoire du cours et lancez la commande `git pull`.
2. Déplacez-vous dans le répertoire `TP/TP6/`.
3. Lancez la commande `make init` pour initialiser le répertoire de
   travail.
4. Déplacez-vous dans le répertoire `work` pour travailler.

#### Exercice 1 : `mystring`, mini-bibliothèque de chaînes de caractères

Pour l'exercice 2, vous aurez besoin d'effectuer les deux opérations
suivantes sur des chaînes de caractères :

 * Ajout de caractères supplémentaires à la fin,
 * Troncature, c'est-à-dire suppression d'un certain nombre de caractères à la fin.
 
Vous devez pour cela écrire une mini-bibliothèque de manipulation de chaînes de
caracères.

`TODO:` Déplacez-vous dans le répertoire `work/findp`. Dans le fichier
`mystring.c`, écrivez le code des quatre fonctions qui sont déclarées
dans `mystring.h` (chacune de ces déclarations est accompagnée d'une
description de ce que doit faire la fonction). Chaque fois que vous
terminez d'écrire une fonction, testez-la avec `make test`.


#### Exercice 2 : `findp`, trouver l'emplacement d'un fichier

Nous allons programmer une version simplifiée de la commande `find`, qui
se contentera d'une recherche selon le critère du nom (_basename_) : on
souhaite que `findp dir_name target_name` soit un équivalent de `find
dir_name -name target_name`.

Le principe de l'algorithme est simple. Intuitivement, il faut lister
toutes les entrées d'un répertoire, et pour chaque entrée, vérifier si
elle porte le nom cherché; par ailleurs, s'il s'agit d'un répertoire, il
faut poursuivre la recherche dedans.

Déplacez-vous dans le répertoire `work/findp`.

1. Complétez le `main` et la fonction `process_dir` de `findp.c` pour que le
   programme effectue la recherche de fichier uniquement dans le répertoire
   passé en paramètre (sections marquées `TODO[1]`).

2. Il faut maintenant implémenter la recherche récursive; pour cela, nous
   avons besoin de construire les chemins des sous-répertoires à
   explorer. Pour chercher dans un sous-répertoire, il faut concaténer
   son nom au chemin en cours d'inspection et le supprimer quand nous avons
   fini de le traiter. Sans cela, nous n'aurons pas le bon chemin pour
   inspecter les fichiers du sous-répertoire. Implémentez la recherche
   dans les sous-répertoires (point `TODO[2]`).

3. Assurez-vous que votre programme termine avec un code de retour de `0`
   s'il a trouvé des fichiers portant le nom cherché, et `1` sinon.
    
4. Testez votre code avec la commande `make test`.



#### Exercice 3 : un problème de ressources

Le code que vous avez écrit a (probablement) le problème suivant : il ouvre
simultanément autant de `DIR *` (et donc autant de descripteurs de fichiers)
que la profondeur de recherche. Cela peut poser problème si l'arborescence est
profonde et que le nombre de descripteurs de fichiers ouverts simultanément est
limité.

Testez votre programme avec `make test` : vous devriez voir les lignes suivantes :

```
Testing findp with limited descriptors (exercise 3)

Running ./findp . egg... OK
+ ulimit -n 6...
Running ./findp . egg... Failed
```

Ceci indique que votre programme est bien capable de trouver le fichier `egg`
dans le répertoire courant, mais que si l'on limite le nombre de descripteurs de
fichier ouverts simultanément (à l'aide de la commande `ulimit`), alors il
échoue.

`TODO:` Modifiez votre fonction `process_dir` pour corriger ce problème.
Autrement dit, votre fonction `process_dir` doit être capable de refermer
`dir` *avant* de s'appeler récursivement.


#### Exercice 4 (plus complexe) : un problème de taille

Le code que vous avez écrit a (probablement) encore un autre problème. En
effet, quand un appel système reçoit en argument un chemin (comme c'est
le cas de l'appel système `openat()`, sur lequel repose la fonction
`opendir()`)), il n'est pas possible de lui passer un chemin de longueur
supérieure à `PATH_MAX` (qui vaut par exemple 4096 sur lulu). Pourtant,
lorsque vous appelez `findp`, il est tout à fait possible que le chemin
vers le fichier que vous cherchez soit plus long que cela.

Modifiez votre programme pour corriger ce problème. Cela veut dire en
particulier que :
 
 1. Vous devrez monter et descendre dans l'arborescence répertoire par
    répertoire à l'aide des fonctions `openat()`, `fdopendir()`, et `dirfd()`.
    Si vous ne connaissez pas ces fonctions (qui n'ont pas été présentées en
    cours), n'hésitez pas à consulter leurs pages de manuel, et bien sûr à poser
    des questions aux encadrants.
    
 2. Vous devrez modifier la fonction `string_append()` pour qu'elle soit capable
    d'aggrandir le buffer en cas de risque de dépassement.
 
Assurez-vous que votre code passe toujours les tests des exercices
précédents. En particulier, faites attention à ne pas ré-introduire le
problème que vous avez corrigé dans l'exercice 3.
