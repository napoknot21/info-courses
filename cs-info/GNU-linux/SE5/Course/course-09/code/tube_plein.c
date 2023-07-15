#include <sys/types.h>
#include <unistd.h>
#include <stdio.h>
#include <stdlib.h>
#include <signal.h>
#include <limits.h>

#define SIZE 1 << 14
char buf[4*SIZE];

char *pere = "\033[34m[pere]\033[m";
char *fils = "\033[32m[fils]\033[m";

void filling(int fd, char *qui) {
  int n, total = 0;
  /*
  n = write(fd, buf, SIZE); total += n;
  printf("%s j'ai écrit %d caractères (total %d)\n", qui, n, total);
  n = write(fd, buf, PIPE_BUF/2); total += n;
  printf("%s j'ai écrit %d caractères (total %d)\n", qui, n, total);
  */
  while (1) {
    n = write(fd, buf, /*SIZE */ PIPE_BUF); total += n;
    printf("%s j'ai écrit %d caractères (total %d)\n", qui, n, total);
  }
}

int main(void){
  int pipefd[2];
  int n;

  if (pipe(pipefd) == -1) {
    perror("pipe");
    exit(1);
  }

  switch (fork()) {
  case -1 :
    perror("fork");
    exit(1);
  case 0 : /* écrivain */
    close(pipefd[0]);
    printf("%s pid écrivain = %d\n", fils, getpid());
    /* printf("capacité totale du tube : %d\n", 4*SIZE); */
    filling(pipefd[1], fils);
    printf("%s écriture finie", fils);
    break;
  default: /* lecteur */
    close(pipefd[1]);
    printf("%s pid lecteur = %d\n", pere, getpid());
    sleep(5);
    n = read(pipefd[0], buf, /* 4* */ SIZE);
    printf("%s j'ai lu %d caractères\n", pere, n);
    sleep(5);
    n = read(pipefd[0], buf, SIZE);
    printf("%s j'ai lu %d caractères\n", pere, n);
    sleep(5);
  }
}
