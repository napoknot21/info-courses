#include <stdlib.h>
#include <unistd.h>
#include <string.h>

#define BUFFER_SIZE 1024

/* ./my-cat lit l'entrée standard et la recopie sur la sortie standard,
 * par blocs de taille BUFFER_SIZE. Termine avec le code 1 si une erreur
 * se produit, et le code 0 sinon. */
int main() { 
  int result; 
  char * buffer = NULL;

  /* TODO : allouer une zone mémoire de taille BUFFER_SIZE et mettre son
   * adresse dans buffer. En cas d'échec de l'allocation, terminer sur
   * une erreur (exit code : 1) */
  buffer = malloc(BUFFER_SIZE*sizeof(char));
  if (buffer == NULL) return 1;

  while(1) {
    /* TODO : lire un bloc de taille BUFFER_SIZE sur stdin, et mettre les
     * données lues dans buffer. En cas d'erreur de lecture, libérer
     * buffer et terminer sur une erreur (exit code : 1). En cas de fin
     * de fichier, sortir de la boucle. */
    
      //memset(buffer, 0x00, BUFFER_SIZE);
    
      int fd_in = read (STDIN_FILENO, buffer, BUFFER_SIZE);
      if (fd_in < 0)
      {
          free(buffer);
          return 1;
      } else if (fd_in == 0)
      {
          break;
      }

    /* TODO : écrire sur stdout les données qui viennent d'être lues. En
     * cas d'erreur de lecture, libérer buffer et terminer sur une erreur
     * (exit code : 1) */
      int fd_out = write (STDOUT_FILENO, buffer, fd_in);
      if (fd_out < 0) {
          free(buffer);
          return 1;
      }
  }
  /* TODO : Tout stdin a été correctement copié sur stdout : libérer
   * buffer et terminer avec l'exit code 0 */
  free(buffer);
  return 0;
}
