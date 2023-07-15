#include <stdio.h>
#include <stdlib.h>
#include <sys/types.h>
#include <unistd.h>

char *pere = "\033[34m[pere]\033[m";
char *fils = "\033[32m[fils]\033[m";

int M = 100;

int main() {
  int n = 1000;

  printf("%s adresse de M : %p\n", pere, &M);
  printf("%s adresse de n : %p\n", pere, &n);
  printf("%s valeur de M et de n : %d %d\n", pere, M, n);

  switch (fork()) {
    case -1 : 
      exit(2);
    case 0 :
      printf("%s adresse de M : %p\n", fils, &M);
      printf("%s adresse de n : %p\n", fils, &n);
      printf("%s valeur de M et de n : %d %d\n", fils, M, n);
      M *= 2; n*= 2;
      printf("%s ------ multiplication par 2 ------\n", fils);
      printf("%s valeur de M et de n : %d %d\n", fils, M, n);
      sleep(2);
      printf("%s valeur de M et de n : %d %d\n", fils, M, n);
      break;
    default :
      sleep(1);
      printf("%s valeur de M et de n : %d %d\n", pere, M, n);
      M *= 3; n*= 3;
      printf("%s ------ multiplication par 3 ------\n", pere);
      printf("%s valeur de M et de n : %d %d\n", pere, M, n);
      wait(NULL);
  }

  return 0;
}
