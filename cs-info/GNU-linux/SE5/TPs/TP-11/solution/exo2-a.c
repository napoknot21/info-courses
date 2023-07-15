#include <stdio.h>
#include <stdlib.h>
#include <signal.h>
#include <unistd.h>

int main (int argc, char **argv) {
    
    struct sigaction signal = {0};
    signal.sa_handler = SIG_IGN;

    for (int i = 1; i < 32; i++) {
        sigaction(i, &signal, NULL);
    }
    pause();
    return 0;
}
