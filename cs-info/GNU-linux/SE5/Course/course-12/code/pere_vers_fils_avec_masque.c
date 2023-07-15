#include <stdio.h>
#include <unistd.h>
#include <stdlib.h>
#include <signal.h>
#include <sys/types.h>
#include <sys/wait.h>

char *pere = "\033[34m[pere]\033[m";
char *fils = "\033[32m[fils]\033[m";
char *moi;

void bip(int sig) {
  dprintf(STDOUT_FILENO, "%s bip\n", moi);
}

int main(int argc,char *argv[]) {
  int pid, status;
  sigset_t set;
  
  moi = pere;
  dprintf(STDOUT_FILENO, "==================================================\n");
  dprintf(STDOUT_FILENO, "%s lancement du processus %d\n", moi, getpid());

  /* déplaçable après le fork grâce au masquage */
  /*
  struct sigaction act = { 0 };
  act.sa_handler = bip;
  if (sigaction(SIGUSR1, &act, NULL)==-1) {
    perror("sigaction");
    exit(EXIT_FAILURE);
  }; 
  dprintf(STDOUT_FILENO, "%s mise en place du handler\n", moi);
  */

  /* masquage de SIGUSR1 */
  sigemptyset(&set);
  sigaddset(&set, SIGUSR1);
  if (sigprocmask(SIG_SETMASK, &set, NULL)==-1) {
    perror("sigprocmask");
    exit(EXIT_FAILURE);
  }
  dprintf(STDOUT_FILENO, "%s masquage de SIGUSR1\n", moi);

  /* par précaution, moi = cible -- l'émetteur aura le temps de modifier */
  moi = fils;

  switch (pid=fork()) {
    case -1 :
      exit(2);

    case 0 :
      dprintf(STDOUT_FILENO, "%s lancement du processus %d\n", moi, getpid());

      /* SIGUSR1 est-il pendant? e*/
      sigpending(&set);
      if (sigismember(&set, SIGUSR1)) 
        dprintf(STDOUT_FILENO, "%s signal SIGUSR1 pendant\n", moi);

      /* mise en place du handler */
      struct sigaction act = { 0 };
      act.sa_handler = bip;
      if (sigaction(SIGUSR1, &act, NULL)==-1) {
        perror("sigaction");
        exit(EXIT_FAILURE);
      }; 
      dprintf(STDOUT_FILENO, "%s mise en place du handler\n", moi);

      /* (levée du masque + pause) atomique via sigsuspend */
      dprintf(STDOUT_FILENO, "%s démasquage de SIGUSR1\n", moi);
      sigemptyset(&set);
      sigsuspend(&set);
      dprintf(STDOUT_FILENO, "%s signal bien reçu\n", moi);
      exit(0);

    default :
      moi = pere;
      dprintf(STDOUT_FILENO, "%s processus fils %d créé\n", moi, pid);

      /* envoi du père au fils */
      dprintf(STDOUT_FILENO, "%s envoi du signal SIGUSR1 au processus %d\n", moi, pid);
      kill(pid, SIGUSR1);

      /* vérification qu'il n'y a pas de signal pendant ici */
      sigpending(&set);
      if (sigismember(&set, SIGUSR1)) 
        dprintf(STDOUT_FILENO, "%s signal SIGUSR1 pendant\n", moi);

      wait(NULL);
  }

  return 0;
}

