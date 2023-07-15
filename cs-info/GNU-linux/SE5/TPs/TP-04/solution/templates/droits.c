#include <stdio.h>
#include <stdlib.h>
#include <unistd.h>
#include <sys/types.h>
#include <sys/stat.h>
#include <fcntl.h>
#include <string.h>
#include <sys/param.h>


/* ajout de droits; retourne 0 en cas de succès, 1 en cas
 * d'échec */
int ajout_droits(char * filename) {
  struct stat st;
  mode_t droits_autres, droits_grp;

  /* TODO : récupérer les informations de l'inoeud du fichier */

  

  /* TODO : récupérer les droits des autres et du groupe */

  

  /* TODO : ajouter les droits des autres au groupe et ceux du groupe au propriétaire */
 

  return 0;
}

/* restriction de droits; retourne 0 en cas de succès, 1 en cas
 * d'échec */
int retire_droits(char * filename) {
  struct stat st;
  mode_t droits_proprio, droits_grp;

  /* récupérer les informations de l'inoeud du fichier */


  /* récupérer les droits du propriétaire et du groupe */


  /* retirer au groupe les droits que le propriétaire n'a pas et aux autres
     ceux que le groupe propriétaire et le propriétaire n'ont pas */


  return 0;
}
    

int main(int argc, char **argv){

  if(argc != 3){
    printf("usage : droits action fic\n");
    exit(1);
  }

  if(strcmp(argv[1], "a") == 0)
    return ajout_droits(argv[2]);

  if(strcmp(argv[1], "r") == 0)
    return retire_droits(argv[2]);

  return 1;
}
