#include <sys/types.h>
#include <unistd.h>
#include <stdio.h>
#include <stdlib.h>

int main(void){
  int r;

  printf("mon pid : %d\n", getpid());

  r = fork();
  if (r == -1) { perror("fork"); exit(1); }
  printf("mon pid : %d\tretour de fork (1) : %d\n", getpid(), r);

/*  if (r==0) { */
    r = fork();
    if (r == -1) { perror("fork"); exit(1); }
    printf("mon pid : %d\tretour de fork (2) : %d\n", getpid(), r);
  
/*    if (r==0) { */
      r = fork();
      if (r == -1) { perror("fork"); exit(1); }
      printf("mon pid : %d\tretour de fork (3) : %d\n", getpid(), r);
/*    } */
/*  }   */

  while(1)  pause();

  return 0;
}
