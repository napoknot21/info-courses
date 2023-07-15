#include <stdio.h>
#include <stdlib.h>
#include <sys/types.h>
#include <unistd.h>

int main(void){
  int nb, fd[2];
  char buf[32];
  
  if (pipe(fd) == -1) {
    perror("pipe");
    exit(1);
  }

  switch (fork()) {
    case -1 : 
      perror("fork");
      exit(1);
    case 0 : /* écrivain */
      close(fd[0]);
      write(fd[1], "Salut papa !", 13);  // strlen + 1
/*    
      write(fd[1], "Salut papa !", 13);  // strlen + 1
      write(fd[1], "Salut papa !", 13);  // strlen + 1
      write(fd[1], "Salut papa !", 13);  // strlen + 1
      write(fd[1], "Salut papa !", 13);  // strlen + 1
*/
      close(fd[1]);
      break;
    default : /* lecteur */
      close(fd[1]);     /* indispensable */
      while((nb = read(fd[0], buf, 32)) > 0) {
        printf("message lu : %s\n", buf);
/*
        write(STDOUT_FILENO, buf, nb);
        write(STDOUT_FILENO, "\n", 1);
*/
      }
  }
}
