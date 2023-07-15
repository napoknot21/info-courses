#include <sys/types.h>
#include <sys/stat.h>
#include <fcntl.h>
#include <unistd.h>
#include <stdlib.h>

int main(void){
  int fd1 = open("toto", O_WRONLY | O_CREAT | O_TRUNC, S_IRUSR | S_IWUSR), fd2, fd3;
  char c = '#';
  int i;
  
  if(fork()==0) c = '.';
 
  fd2 =   open("tutu", O_WRONLY | O_CREAT /* | O_TRUNC */ , S_IRUSR | S_IWUSR);
  fd3 =   open("tata", O_WRONLY | O_CREAT /* | O_TRUNC */ | O_APPEND, S_IRUSR | S_IWUSR);

  for(i=0; i<1e5; i++){
    write(fd1, &c, sizeof(char));
  /*  lseek(fd2, 0, SEEK_END);
    write(fd2, &c, sizeof(char));
    write(fd3, &c, sizeof(char)); */
  }
  
  close(fd1);
  close(fd2);
  close(fd3);

  return 0;
}

