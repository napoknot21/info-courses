#include <sys/types.h>
#include <unistd.h>
#include <sys/wait.h>
#include <stdlib.h>

char up(char c) {
  return (c>='a' && c<='z') ? c+'A'-'a' : c;
}


int main() {
  int fd[2];
  char c;
  int n;

  pipe(fd);

  if (fork()==0) { /* le fils recopie l'entrée standard sur le tube */
    close(fd[0]);
    while (read(STDIN_FILENO, &c, 1) > 0) 
      write(fd[1], &c, 1);
    close(fd[1]);
    exit(0);
    }
  } else {  /* le père recopie le tube sur la sortie standard */
    close(fd[1]);
    while ((n = read(fd[0], &c, 1)) > 0) {
      c = up(c);
      write(STDOUT_FILENO, &c, 1);
    }
    close(fd[0]);
    exit(0);
  }

}
