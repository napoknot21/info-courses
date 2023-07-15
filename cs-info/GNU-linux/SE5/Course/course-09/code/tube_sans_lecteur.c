#include <unistd.h>
#include <stdlib.h>
#include <stdio.h>
#include <errno.h>
#include <signal.h>

int main(void){
  int fd[2];
  long int n;

  /* pour ignorer le signal SIGPIPE (vu plus tard dans le semestre) */
  struct sigaction act = {0};
  act.sa_handler = SIG_IGN;
  sigaction(SIGPIPE, &act, NULL);
  
  pipe(fd);
  close(fd[0]);

  n = write(fd[1], "c", 1);

  if (n == -1) perror("write");
  else printf("retour de write : %d\n", n);
 
  return 0;
}
