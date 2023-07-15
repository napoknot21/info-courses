#include <stdio.h>
#include <stdlib.h>
#include <signal.h>
#include <unistd.h>

static int status = 1;

void handler (int SIGNAL) {
    switch (SIGNAL) {
        case SIGUSR1: 
            printf("fuck la serbie\n");
            status = 0;
            break;
    }
}

int main (int argc, char **argv) {

    struct sigaction signal = {0};
    signal.sa_handler = handler;

    while(status) {
        pause();
    }

    return 0;
}
