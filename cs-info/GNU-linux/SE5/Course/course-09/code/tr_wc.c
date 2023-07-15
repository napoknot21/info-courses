#include <sys/types.h>
#include <unistd.h>

int main() {
  /* compte le nombre d'occurences de 'a' dans un texte en simulant
   * tr -d -C a | wc -c */
  int fd[2];

  if (pipe(fd)==-1) {
    perror("pipe");
    exit(1);
  }
  
  switch (fork()) {
    case -1 :
      perror("fork");
      exit(1);
    case 0 : /* écrivain : tr -d -C a */
      close(fd[0]);
      dup2(fd[1], 1);
      close(fd[1]);
      execlp("tr", "tr", "-d", "-C", "a", NULL);
      exit(1);
    default : /* lecteur : wc -c */
      close(fd[1]); /* indispensable */
      dup2(fd[0], 0);
      close(fd[0]);
      execlp("wc", "wc", "-c", NULL);
      exit(1);
  }
}
