#include <unistd.h>
#include <stdlib.h>
#include <stdio.h>
#include <fcntl.h>
#include <sys/types.h>
#include <sys/stat.h>

int main() {
  char buf[32];
  int nb, fd = open("toto", O_RDWR);
  if (fd < 0) {
    perror("problème d'ouverture");
    exit(1);
  }
  /* suppression de tous les droits d'accès */
  chmod("toto", 0);

  /* affichage des droits */
  struct stat s;
  fstat(fd, &s);
  printf("%o\n", s.st_mode);

  if ((nb=read(fd, buf, 32)) < 0) {
    perror("problème de lecture");
    exit(1);
  }
  write(1, buf, nb);

  if ((nb=write(fd, buf, nb)) < 0) {
   perror("problème d'écriture");
   exit(1);
  }

  /* rétablissement des droits */
  chmod("toto", 0600);
  close(fd);
}
