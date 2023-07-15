#include <sys/types.h>
#include <unistd.h>
#include <stdio.h>
#include <stdlib.h>
#include <sys/wait.h>

int main(void){
  int r, w, pid;

  r = fork();
  switch(r) {
    case -1 : 
      perror("fork");
      exit(EXIT_FAILURE);
    case 0 : // fils
      printf("je suis le fils, mon pid est %d, celui de mon père %d\n",
           getpid(), getppid());
      sleep(2);
      //exit(EXIT_SUCCESS);
      exit(37);
    default : // père
      printf("je suis le père, de pid %d, je viens de créer un fils de pid %d\n",
           getpid(), r);
      pid = wait(&w);
      printf("valeur de retour de %d : %d\n", pid, WEXITSTATUS(w));
//    sleep(42);
  }

  return 0;
}
