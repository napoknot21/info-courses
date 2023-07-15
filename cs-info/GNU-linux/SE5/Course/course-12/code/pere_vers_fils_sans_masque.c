/* mort immédiate du fils si le handler n'est pas mis en place avant le
 * fork ; blocage quasi systématique car le fils reçoit le signal avant
 * d'avoir atteint la pause.
 */

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

  moi = pere;
  dprintf(STDOUT_FILENO, "==================================================\n");
  dprintf(STDOUT_FILENO, "%s lancement du processus %d\n", moi, getpid());

  /* à décommenter */
  /*
  moi = fils;
  struct sigaction act = { 0 };
  act.sa_handler = bip;
  sigaction(SIGUSR1, &act, NULL);
  */

  switch (pid=fork()) {
    case -1 :
      exit(2);

    case 0 :
      dprintf(STDOUT_FILENO, "%s lancement du processus %d\n", fils, getpid());

      /* à placer avant le fork, ici c'est trop tard! */
      moi = fils;
      struct sigaction act = { 0 };
      act.sa_handler = bip;
      sigaction(SIGUSR1, &act, NULL); 

      /* v1 : envoi du père au fils */
      pause();
      dprintf(STDOUT_FILENO, "%s signal bien reçu\n", moi);
      exit(0);

    default :
      moi = pere;
      dprintf(STDOUT_FILENO, "%s processus fils %d créé\n", moi, pid);

      /* v1 : envoi du père au fils */
      dprintf(STDOUT_FILENO, "%s envoi du signal SIGUSR1 au processus %d\n", moi, pid);
      kill(pid, SIGUSR1);
      wait(NULL);
  }

  return 0;
}

