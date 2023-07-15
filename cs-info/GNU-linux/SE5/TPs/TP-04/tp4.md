TP nº4 : création d'archives tar
=====================

**L3 Informatique - Système**

Le premier exercice de ce TP est la suite du TP précédent et son but est d'écrire un outil permettant de créer une archive au format `tar` à partir d'un ensemble de fichiers ordinaires.

#### Complément sur le format des archives tar

La création d'une archive tar implique la création de l'entête pour chaque fichier de l'archive.

Voici quelques rappels et compléments d'information sur les champs de la structure décrite par le type `struct posix_header` qui vous seront utiles :

  - `char name[100]` : nom long du fichier (_ie_ sa référence relative au point d'archivage). On supposera ici que 100 caractères suffisent pour stocker ce nom. Les caractères inutilisés seront mis à `'\0'`.

  - `char mode[8]` : permissions du fichier, converties en entier. On pourra remplir ce champs avec un `sprintf(hd.mode, "%07o", ...)`.
  
  - `char size[12]` : taille du fichier. On pourra remplir ce champs avec un `sprintf(hd.size, "%011o", ...)`.
  
  - `char chksum[8]` : empreinte ("checksum") de ce bloc entête. Pour fabriquer un `tar` acceptable par GNU `tar` ce champ doit être correct. Pour cela, utiliser la fonction fournie `set_checksum()` de `tarutils.c` une fois que votre entête est prêt. Pour plus de détail, voir le commentaire devant `set_checksum()`.

  - `char typeflag` : il vaut `'0'` ou `'\0'` pour un fichier ordinaire.
 
  <!-- - `char magic[6]` : pour le format de `tar` que l'on utilise ici, ce champ devra être mis à `"ustar"` (vous pouvez utiliser la macro `TMAGIC` définie dans `tarutils.h` et valant `"ustar"`), et le champ suivant `version` être à `"00"` (sans terminateur). -->


#### Instructions générales

Mettez à jour le dépôt `git` du cours sur votre machine (en lançant la commande `git pull` depuis le dépôt cloné).

Déplacez-vous ensuite dans le répertoire `TP/TP4/` du dépôt git, et exécutez la commande `make init`.
Ceci crée un répertoire `TP/TP4/work/` contenant déjà une partie du code, que vous devrez compléter.

Vous devrez compléter le fichier `mktar.c` fourni dans le répertoire `TP/TP4/work/`, et effectuer des tests dans `/tmp` .

**Tous les accès en lecture/écriture aux différents fichiers manipulés**
devront être effectués à l'aide des fonctions de bas niveau. En revanche,
l'utilisation des fonctions de `stdio.h` est autorisée pour tous les
affichages sur la sortie ou l'erreur standard (`printf`, `fprintf`,
`perror`) ou pour le formatage des chaînes des caractères (`sprintf`,
`sscanf`). 


#### Exercice 1 : création d'une archive simple

Compléter `mktar.c` pour obtenir un programme `mktar` tel que l'appel à `mktar archive.tar fic1 ... ficn` crée l'archive `archive.tar` contenant les fichiers ordinaires `fic1` ... `ficn` (situés dans le répertoire courant). Ce fichier `archive.tar` devra pouvoir être lu avec l'utilitaire GNU `tar`. Cela signifie que certains champs doivent obligatoirement être renseignés : `typeflag`, `name`, `mode`, `size` et `checksum`. 

La fonction `stat()` sera nécessaire pour obtenir certaines de ces informations.

Utilisez `mktar` pour créer des archives, et vérifier que `tar` parvient à en lister et extraire le contenu sans erreur.

#### Exercice 2 : bas les masques

Pour cet exercice, on dira que le propirétaire d'un fichier est d'une catégorie supérieure au groupe propriétaire qui est lui-même d'une catégorie supérieure aux autres utilisateurs.

Compléter `droits.c` pour obtenir un programme `droits` tel que l'appel `droits action fic`  modifie les droits du fichier de nom `fic` de la façon suivante :

  - si action vaut `a`, ajoute les droits à `fic`  d'une catégorie inférieure vers une catégorie
  supérieure. Par exemple si un fichier `fic` à les droits `0461`  alors l'appel `droits a fic`
  donne les droits `0771` à `fic` car le groupe et le propriétaire gagnent le droit `x` des autres
  et le propriétaire gagne également le droit `w` du groupe.

  - si action vaut `r`, retire les droits  à une catégorie inférieure que ne possède pas
  une catégorie supérieure. Par exemple si un fichier `fic` à les droits `0561`  alors l'appel
  `droits r fic`  attribue les droits `0540` à `fic`.


Créer un fichier puis tester votre commande :

  - en mode `a` avec les droits et résultats suivants:

		- 0461 -> 0771

		- 0640 -> 0640

		- 0044 -> 0444

  - en mode `r` avec les droits et résultats suivants:

		- 0561 -> 0540

		- 0640 -> 0640

		- 0422 -> 0400
