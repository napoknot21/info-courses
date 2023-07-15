#include <stdio.h>
#include <stdlib.h>
#include <sys/types.h>
#include <unistd.h>

char *pere = "\033[34m[pere]\033[m";
char *fils = "\033[32m[fils]\033[m";

int main() {

  printf("%s bonjour fiston! ", pere);
  /* printf("%s bonjour fiston!\n", pere);
  fflush(stdout);*/

  switch (fork()) {
    case -1 : 
      exit(2);
    case 0 :
      printf("%s bonjour papa! \n", fils);
      break;
    default :
      wait(NULL);
      printf("\n%s passe une bonne journée!\n", pere);
      /* printf("%s passe une bonne journée!\n", pere); */
  }

  return 0;
}
