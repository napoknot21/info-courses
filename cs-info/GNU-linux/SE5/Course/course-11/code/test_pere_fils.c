#include <stdio.h>
#include <unistd.h>
#include <stdlib.h>
#include <signal.h>
#include <sys/types.h>
#include <sys/wait.h>

char *pere = "\033[34m[pere]\033[m";
char *fils = "\033[32m[fils]\033[m";

int main(int argc,char *argv[]) {
  int pid, status;

  dprintf(STDOUT_FILENO, "%s lancement du processus %d\n", pere, getpid());

  switch (pid=fork()) {
    case -1 :
      exit(2);

    case 0 :
      dprintf(STDOUT_FILENO, "%s lancement du processus %d\n", fils, getpid());
      while(1) {
        dprintf(STDOUT_FILENO, "%s zzz...\n", fils);
        sleep(1);
      }
      exit(1);

    default :
      dprintf(STDOUT_FILENO, "%s processus fils %d créé\n", pere, pid);
      sleep(5);
      dprintf(STDOUT_FILENO, "%s envoi du signal SIGUSR1 au processus %d\n", pere, pid);
      kill(pid, SIGUSR1);
  }

  return 0;
}

