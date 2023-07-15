#include <unistd.h>
#include <fcntl.h>

int main() {
  int fd, nb;
  char buf[9];
  /* initialisation du fichier */
  fd = open("toto", O_WRONLY | O_CREAT | O_TRUNC, 0600);
  write(fd, "abcdefghi", 9);
  close(fd);

  fd = open("toto", O_RDWR);

  /* affichage du contenu de toto */
  nb = read(fd, buf, 9);
  write(1, buf, nb);
  write(1, "\n", 1);
  /* retour au début du fichier */
  lseek(fd, 0, SEEK_SET);
        
  nb = read(fd, buf, 3); write(1, buf, nb);
  write(fd, "DEF", 3);
  nb = read(fd, buf, 3); write(1, buf, nb);
  close(fd);
}
