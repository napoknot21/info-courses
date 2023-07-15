#include <fcntl.h>
#include <unistd.h>
#include <errno.h>
#include <string.h>

char usage[] = " prend un paramètre\n";

int main(int argc, char **argv) {

    int fd, nb, flags;
    char buf[32];
  
    if (argc <= 1) {
        write(STDERR_FILENO, argv[0], strlen(argv[0]));
        write(STDERR_FILENO, usage, strlen(usage));
        return 1;
    }

    /* définition des flags d'ouverture du fichier à remplir */
    flags = O_RDWR | O_TRUNC | O_CREAT;

    /* adaptation au cas O_APPEND */
    #ifdef APPEND
        flags |= O_APPEND;
    #endif

    /* ouverture du fichier */
    fd = open(argv[1], flags, 0644);
    if (fd < 0) return 1;

    /* initialisation du contenu avec abc...xyz */
    write(fd, "abcdefghijklmnopqrstuvwxyz", 26);

    /* replacement de la tête de lecture/écriture au début du fichier */
    lseek(fd, 0, SEEK_SET);

    /* tentative de lecture puis affichage de 5 caractères */

    // TODO : à compléter
    nb = read (fd, buf, 5);
    if (nb < 0) {
        return 1;
    }
    write (STDOUT_FILENO, buf, nb);

    /* écriture de FGHIJ */
  
    // TODO : à compléter
    write (fd, "FGHIJ", 5);

    /* tentative de lecture puis affichage de 5 caractères */
  
    // TODO : à compléter
    nb = read (fd, buf, 5);
    if (nb < 0) {
        return 1;
    }
    write (STDOUT_FILENO, buf, nb);

    /* écriture de PQRST */

    // TODO : à compléter
    write (fd, "PQRST", 5);

    /* fermeture */
    close(fd);

}
