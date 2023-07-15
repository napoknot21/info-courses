#include <sys/types.h>
#include <sys/stat.h>
#include <fcntl.h>
#include <unistd.h>
#include <stdio.h>
#include <stdlib.h>

int main(void) {
  int fd[2];
  char c;

  if(pipe(fd)==-1){
    perror("pipe");
    exit(1);
  }

  write(fd[1], "a", 1);
  // close(fd[1]);
  read(fd[0], &c, 1);
}
