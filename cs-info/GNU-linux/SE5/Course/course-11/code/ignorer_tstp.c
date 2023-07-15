#include <signal.h>
#include <sys/types.h>
#include <unistd.h>
#include <string.h>
#include <stdio.h>

int cpt;        /* mieux (cf cours 12) : volatile sig_atomic_t cpt; */

void compteur(int sig) {
  if (sig == SIGTSTP) cpt ++;
  dprintf(STDIN_FILENO, "j'ai reçu %d fois le signal %d\n", cpt, sig);
}

void affiche(int sig) {
  dprintf(STDIN_FILENO, "%d bien reçu, mais je continue\n", sig);
}


int main(void){
  struct sigaction action;
  memset(&action, 0, sizeof(struct sigaction));
  action.sa_handler = SIG_IGN;
  action.sa_handler = affiche;
  action.sa_handler = compteur;

  dprintf(STDERR_FILENO, "processus de pid %d lancé\n", getpid());

  sigaction(SIGTSTP, &action, NULL);
 
  while(1)
    pause();
}
